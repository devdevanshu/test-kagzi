<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Pricing;
use App\Services\ProductImageSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Purchase;

class ProductController extends Controller
{
    // Display all products (Admin)
    public function index(Request $request)
    {
        // Force web view - reject API requests
        if ($request->is('api/*') || $request->wantsJson()) {
            abort(404, 'Use API routes for JSON responses');
        }
        
        $query = Product::with(['pricings', 'purchases'])
                          ->withCount(['purchases as total_sales' => function ($query) {
                              $query->where('status', 'completed');
                          }]);
        
        // Apply search filter
        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%')
                  ->orWhere('description', 'LIKE', '%' . request('search') . '%');
        }
        
        // Apply status filter
        if (request('status') === 'active') {
            $query->where('is_active', true);
        } elseif (request('status') === 'inactive') {
            $query->where('is_active', false);
        }
        
        $products = $query->oldest()->paginate(10);
        return view('products.index', compact('products'));
    }

    // Public showcase: display active products
    public function showcase()
    {
        $products = Product::where('is_active', true)->get();
        return view('sections.showcase', compact('products'));
    }

    // Show add product form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        // Debug: Log the incoming request
        Log::info('Product store request received', [
            'data' => $request->all(),
            'files' => $request->hasFile('images') ? 'Has files' : 'No files'
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'project_url' => 'nullable|url|max:500',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max per image
            'plans' => 'nullable|array',
            'plans.*.name' => 'required|string|max:255',
            'plans.*.price' => 'required|numeric|min:0',
            'plans.*.region' => 'required|in:D,I',
            'plans.*.credits' => 'nullable|in:yes,no',
            'plans.*.credit_value' => 'nullable|numeric|min:0',
        ]);

        try {
            $imagePaths = [];
            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products', $imageName, 'public');
                    $imagePaths[] = $imagePath;
                    
                    // Sync image to JobAway frontend storage
                    ProductImageSync::syncImage($imagePath);
                }
            }

            // Check if product exists by name
            $product = Product::where('name', $request->name)->first();
            if (!$product) {
                // Create product if not exists
                $product = Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'project_url' => $request->project_url,
                    'images' => $imagePaths,
                    'region' => $request->region,
                    // 'sku' => $request->sku, // Commented out - not important
                    'is_active' => true
                ]);
            }

            // Handle pricing data if provided
            if ($request->has('plans') && is_array($request->plans)) {
                Log::info('Processing plans', ['plans' => $request->plans]);
                $position = Pricing::where('product_id', $product->id)->count() + 1;
                foreach ($request->plans as $key => $planData) {
                    Log::info('Processing plan', ['key' => $key, 'planData' => $planData]);
                    if (!empty($planData['name']) && !empty($planData['price'])) {
                        // Determine if credit is enabled and get credit value
                        $creditType = 'unit'; // default type
                        $creditValue = null;

                        // Only set credits if explicitly enabled
                        if (isset($planData['credits']) && $planData['credits'] === 'yes') {
                            $creditType = 'credit';
                            $creditValue = isset($planData['credit_value']) && !empty($planData['credit_value']) 
                                ? (int)$planData['credit_value'] 
                                : null;
                        }

                        $pricingData = [
                            'product_id' => $product->id,
                            'title' => $planData['name'],
                            'price' => $planData['price'],
                            'type' => $creditType,
                            'type_value' => $creditValue, // Can be null if credits not enabled
                            'region' => $planData['region'] ?? 'D',
                            'position' => $position++
                        ];

                        Log::info('Creating pricing', ['data' => $pricingData]);

                        Pricing::create($pricingData);

                        Log::info('Pricing created successfully');
                    } else {
                        Log::info('Skipping plan due to missing name or price', ['planData' => $planData]);
                    }
                }
            } else {
                Log::info('No plans data found', ['has_plans' => $request->has('plans'), 'plans' => $request->plans]);
            }

            Log::info('Product created or updated successfully', ['product_id' => $product->id]);

            return redirect()->route('products.index')
                           ->with('success', '🎉 Product created successfully!');

        } catch (\Exception $e) {
            Log::error('Error creating product', ['error' => $e->getMessage()]);

            return redirect()->back()
                           ->withInput()
                           ->with('error', '❌ Error creating product: ' . $e->getMessage());
        }
    }

    // Show single product by slug for public view
    public function show(Request $request, $slug)
    {
        // Force web view - reject API requests
        if ($request->is('api/*') || $request->wantsJson()) {
            abort(404, 'Use API routes for JSON responses');
        }
        
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('products.show', compact('product'));
    }

    // Show edit product form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'product_type' => 'required|in:credit,plan',
            'credit_value' => 'required_if:product_type,credit|nullable|integer|min:1',
            'project_url' => 'nullable|url|max:500',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'stock_quantity' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'existing_images' => 'nullable|array',
            'existing_images.*' => 'string',
            'is_active' => 'nullable|boolean',
            'pricings' => 'nullable|array',
            'pricings.*.id' => 'nullable|integer',
            'pricings.*.plan_name' => 'nullable|string|max:255',
            'pricings.*.price' => 'nullable|numeric|min:0',
            'pricings.*.credits' => 'nullable|string|max:255'
        ]);

        try {
            // Start with existing images that are still selected
            $imagePaths = $request->existing_images ?? [];

            // Handle new image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products', $imageName, 'public');
                    $imagePaths[] = $imagePath;
                    
                    // Sync image to JobAway frontend storage
                    ProductImageSync::syncImage($imagePath);
                }
            }

            // Update product
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'product_type' => $request->product_type,
                'credit_value' => $request->product_type === 'credit' ? $request->credit_value : null,
                'project_url' => $request->project_url,
                'images' => $imagePaths,
                'stock_quantity' => $request->stock_quantity ?? 0,
                'sku' => $request->sku,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ]);

            // Update pricing plans if present
            $pricings = $request->input('pricings', []);
            foreach ($pricings as $pricingData) {
                if (!empty($pricingData['plan_name']) && !empty($pricingData['price'])) {
                    if (isset($pricingData['id']) && !empty($pricingData['id'])) {
                        // Update existing pricing
                        $pricing = Pricing::find($pricingData['id']);
                        if ($pricing) {
                            $pricing->title = $pricingData['plan_name'];
                            $pricing->price = $pricingData['price'];
                            $pricing->type_value = $pricingData['credits'] ?? null;
                            $pricing->region = $pricingData['region'] ?? $pricing->region;
                            $pricing->save();
                        }
                    } else {
                        // Create new pricing
                        Pricing::create([
                            'product_id' => $product->id,
                            'title' => $pricingData['plan_name'],
                            'price' => $pricingData['price'],
                            'type' => !empty($pricingData['credits']) ? 'credit' : 'unit',
                            'type_value' => $pricingData['credits'] ?? null,
                            'region' => $pricingData['region'] ?? 'D',
                            'position' => Pricing::where('product_id', $product->id)->count() + 1
                        ]);
                    }
                }
            }

            return redirect()->route('products.index')
                           ->with('success', 'Product updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    // Delete product
    public function destroy(Product $product)
    {
        try {
            // Delete associated images
            if (!empty($product->images)) {
                foreach ($product->images as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            $product->delete();

            return redirect()->route('products.index')
                           ->with('success', 'Product deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    // Toggle product status
    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        $status = $product->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Product {$status} successfully!");
    }

    // Remove specific image
    public function removeImage(Product $product, $imageIndex)
    {
        try {
            $images = $product->images ?? [];

            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                
                // Delete file from admin storage
                Storage::disk('public')->delete($imagePath);
                
                // Delete file from JobAway frontend storage
                ProductImageSync::deleteImage($imagePath);

                // Remove from array
                unset($images[$imageIndex]);

                // Reindex array
                $images = array_values($images);

                // Update product
                $product->update(['images' => $images]);

                return response()->json(['success' => true, 'message' => 'Image removed successfully!']);
            }

            return response()->json(['success' => false, 'message' => 'Image not found!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error removing image: ' . $e->getMessage()]);
        }
    }

}
