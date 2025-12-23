<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    /**
     * Get all active products with their pricing
     */
    public function index(Request $request): JsonResponse
    {
        $products = Product::with(['pricings'])
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products retrieved successfully'
        ]);
    }

    /**
     * Get a single product by ID or slug
     */
    public function show($identifier): JsonResponse
    {
        // Try to find by ID first, then by slug
        $product = Product::with(['pricings'])
            ->where('id', $identifier)
            ->orWhere('slug', $identifier)
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product retrieved successfully'
        ]);
    }

    /**
     * Create a new product
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sku' => 'nullable|string|unique:products,sku',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->is_active = $request->is_active ?? true;
        $product->sku = $request->sku;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        // Handle image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
            $product->images = $imagePaths;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'data' => $product->load('pricings'),
            'message' => 'Product created successfully'
        ], 201);
    }

    /**
     * Update an existing product
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->is_active = $request->is_active ?? $product->is_active;
        $product->sku = $request->sku;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        // Handle image uploads
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images) {
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
            $product->images = $imagePaths;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'data' => $product->load('pricings'),
            'message' => 'Product updated successfully'
        ]);
    }

    /**
     * Delete a product
     */
    public function destroy(Product $product): JsonResponse
    {
        // Delete associated images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    /**
     * Toggle product status (active/inactive)
     */
    public function toggleStatus(Product $product): JsonResponse
    {
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product status updated successfully'
        ]);
    }

    /**
     * Get product pricing plans
     */
    public function pricing(Product $product): JsonResponse
    {
        $pricings = $product->pricings()->orderBy('position')->get();

        return response()->json([
            'success' => true,
            'data' => $pricings,
            'message' => 'Product pricing retrieved successfully'
        ]);
    }

    /**
     * Add pricing to a product
     */
    public function addPricing(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'region' => 'required|in:I,D',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string',
            'type_value' => 'required|integer|min:1',
            'position' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $pricing = new Pricing();
        $pricing->product_id = $product->id;
        $pricing->region = $request->region;
        $pricing->title = $request->title;
        $pricing->price = $request->price;
        $pricing->type = $request->type;
        $pricing->type_value = $request->type_value;
        $pricing->position = $request->position ?? 0;
        $pricing->save();

        return response()->json([
            'success' => true,
            'data' => $pricing,
            'message' => 'Pricing added successfully'
        ], 201);
    }

    /**
     * Get sales statistics for products
     */
    public function statistics(): JsonResponse
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'inactive_products' => Product::where('is_active', false)->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Statistics retrieved successfully'
        ]);
    }
}