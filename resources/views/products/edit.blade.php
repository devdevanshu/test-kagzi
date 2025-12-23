@extends('layouts.admin')

@section('title', 'Edit Product - Admin Panel')
@section('page-title', 'Edit Product')
@section('page-description', 'Update product information')

@section('content')

<div class="flex items-center justify-center min-h-scree">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl p-10 mb-8">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Edit Product</h3>
            <p class="text-gray-500">Fill in the details below to update your product information.</p>
        </div>
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="name">
                        <i class="fas fa-tag mr-2 text-blue-500"></i>Product Name
                    </label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $product->name) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                           placeholder="Enter product name">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="product_type">
                        <i class="fas fa-cog mr-2 text-purple-500"></i>Product Type
                    </label>
                    <select name="product_type" id="product_type" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                           onchange="toggleCreditField()">
                        <option value="plan" {{ old('product_type', $product->product_type) === 'plan' ? 'selected' : '' }}>Plan-based Product</option>
                        <option value="credit" {{ old('product_type', $product->product_type) === 'credit' ? 'selected' : '' }}>Credit-based Product</option>
                    </select>
                </div>
            </div>
            
            <div id="credit-field" class="mb-6" style="display: {{ old('product_type', $product->product_type) === 'credit' ? 'block' : 'none' }};">
                <label class="block text-gray-700 font-medium mb-2" for="credit_value">
                    <i class="fas fa-coins mr-2 text-yellow-500"></i>Credit Value
                </label>
                <input type="number" name="credit_value" id="credit_value" min="1"
                       value="{{ old('credit_value', $product->credit_value) }}"
                       class="w-full md:w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200"
                       placeholder="Enter credit value (e.g., 100)">
                <p class="mt-2 text-sm text-gray-600">For credit-based products, specify how many credits the user will receive upon purchase.</p>
            </div>
            <div class="mt-6">
                <label class="block text-gray-700 font-medium mb-2">
                Pricing Plans
                </label>
                <div id="pricing-container" class="space-y-2">
                    @php
                        $domesticPlans = $product->pricings->where('region', 'D');
                        $internationalPlans = $product->pricings->where('region', 'I');
                        $planIndex = 0;
                    @endphp
                    <div class="space-y-4">
                        <div>
                            <span class="font-bold text-blue-700 mb-3 block">Domestic Plans</span>
                            @if($domesticPlans->count())
                                @foreach($domesticPlans as $pricing)
                                    <div class="pricing-row flex items-center gap-2 mb-4" data-index="{{ $planIndex }}">
                                        <input type="hidden" name="pricings[{{ $planIndex }}][id]" value="{{ $pricing->id }}">
                                        <input type="hidden" name="pricings[{{ $planIndex }}][region]" value="D">
                                        <input type="text" name="pricings[{{ $planIndex }}][plan_name]" value="{{ old('pricings.'.$planIndex.'.plan_name', $pricing->title) }}" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Plan Name" required>
                                        <div class="relative w-1/4">
                                            <span class="absolute left-2 top-2 text-blue-700 font-bold">₹</span>
                                            <input type="number" step="0.01" min="0" name="pricings[{{ $planIndex }}][price]" value="{{ old('pricings.'.$planIndex.'.price', $pricing->price) }}" class="pl-6 pr-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" placeholder="Price" required>
                                        </div>
                                        <input type="number" min="0" name="pricings[{{ $planIndex }}][credits]" value="{{ old('pricings.'.$planIndex.'.credits', $pricing->type_value) }}" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Credit Value">
                                        <button type="button" onclick="removePricingRow(this)" class="w-1/4 px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                                            <i class="fas fa-trash mr-1"></i>Remove
                                        </button>
                                    </div>
                                    @php $planIndex++; @endphp
                                @endforeach
                            @else
                                <div class="text-gray-500">No domestic plans available</div>
                            @endif

                            <button type="button" id="addDomesticPlanBtn" class="mt-3 inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i>Add New Domestic Pricing Plan
                            </button>
                        </div>
                        <div>
                            <span class="font-bold text-green-700 mb-3 block">International Plans</span>
                            @if($internationalPlans->count())
                                @foreach($internationalPlans as $pricing)
                                    <div class="pricing-row flex items-center gap-2 mb-4" data-index="{{ $planIndex }}">
                                        <input type="hidden" name="pricings[{{ $planIndex }}][id]" value="{{ $pricing->id }}">
                                        <input type="hidden" name="pricings[{{ $planIndex }}][region]" value="I">
                                        <input type="text" name="pricings[{{ $planIndex }}][plan_name]" value="{{ old('pricings.'.$planIndex.'.plan_name', $pricing->title) }}" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Plan Name" required>
                                        <div class="relative w-1/4">
                                            <span class="absolute left-2 top-2 text-green-700 font-bold">$</span>
                                            <input type="number" step="0.01" min="0" name="pricings[{{ $planIndex }}][price]" value="{{ old('pricings.'.$planIndex.'.price', $pricing->price) }}" class="pl-6 pr-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" placeholder="Price" required>
                                        </div>
                                        <input type="number" min="0" name="pricings[{{ $planIndex }}][credits]" value="{{ old('pricings.'.$planIndex.'.credits', $pricing->type_value) }}" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Credit Value">
                                        <button type="button" onclick="removePricingRow(this)" class="w-1/4 px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                                            <i class="fas fa-trash mr-1"></i>Remove
                                        </button>
                                    </div>
                                    @php $planIndex++; @endphp
                                @endforeach
                            @else
                                <div class="text-gray-500">No international plans available</div>
                            @endif

                            <button type="button" id="addInternationalPlanBtn" class="mt-3 inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i>Add New International Pricing Plan
                            </button>
                        </div>
                    </div>
                    @if($planIndex === 0)
                        <!-- Default empty row if no pricing exists -->
                        <div class="pricing-row flex items-center gap-2 mb-4" data-index="0">
                            <input type="hidden" name="pricings[0][id]" value="">
                            <input type="text" name="pricings[0][plan_name]" value="{{ old('pricings.0.plan_name') }}" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Plan Name" required>
                            <input type="number" step="0.01" min="0" name="pricings[0][price]" value="{{ old('pricings.0.price') }}" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Price" required>
                            <input type="number" min="0" name="pricings[0][credits]" value="{{ old('pricings.0.credits') }}" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Credit Value">
                            <button type="button" onclick="removePricingRow(this)" class="w-1/4 px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                                <i class="fas fa-trash mr-1"></i>Remove
                            </button>
                        </div>
                    @endif
                </div>
                {{-- <button type="button" onclick="addPricingRow()" class="mt-3 inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>Add New International Pricing Plan
                </button> --}}
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="description">
                    <i class="fas fa-align-left mr-2 text-purple-500"></i>Description
                </label>
                <textarea name="description" id="description" rows="4" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                          placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
            </div>
            
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="project_url">
                    <i class="fas fa-link mr-2 text-green-500"></i>Project URL
                </label>
                <input type="url" name="project_url" id="project_url"
                       value="{{ old('project_url', $product->project_url) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="Enter project URL (e.g., https://example.com)">
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-gray-700 font-medium">
                        Product is active
                    </span>
                </label>
            </div>
            <!-- Current Images Section -->
            @if($product->images && count($product->images) > 0)
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="text-lg font-medium text-gray-800 mb-4">
                    <i class="fas fa-images mr-2 text-blue-500"></i>Current Images
                </h4>
                <div id="current-images" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($product->images as $index => $image)
                        <div class="relative group" data-image-index="{{ $index }}">
                            <img src="{{ asset('storage/' . $image) }}"
                                 alt="Product Image {{ $index + 1 }}"
                                 class="w-full h-32 object-cover rounded-lg shadow-md">
                            <div class="absolute top-2 right-2">
                                <button type="button"
                                        onclick="removeCurrentImage({{ $index }})"
                                        class="w-6 h-6 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors duration-200 flex items-center justify-center text-xs">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="images">
                    <i class="fas fa-image mr-2 text-red-500"></i>Add New Images
                </label>
                <div class="space-y-3">
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <button type="button" id="addMoreImages" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>Add More Images
                    </button>
                </div>
            </div>
            <!-- Display New Uploaded Images -->
            <div class="py-4">
                <h4 class="text-lg font-medium text-gray-800">New Images to Upload</h4>
                <div id="uploaded-images" class="flex flex-wrap gap-4 mt-2">
                    <!-- Images will be displayed here -->
                </div>
            </div>
            <div class="border-t pt-6 pb-4">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('products.index') }}" class="btn bg-gray-600 text-white hover:bg-gray-700">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Image upload preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('images');
        const uploadedImagesContainer = document.getElementById('uploaded-images');
        const addMoreImagesBtn = document.getElementById('addMoreImages');
        let allSelectedFiles = []; // Array to store all selected files
        let imageCounter = 0; // Counter for unique image IDs

        // Handle initial file input change
        imageInput.addEventListener('change', function(event) {
            handleFileSelection(event.target.files);
        });

        // Handle "Add More Images" button click
        addMoreImagesBtn.addEventListener('click', function() {
            // Create a temporary file input
            const tempInput = document.createElement('input');
            tempInput.type = 'file';
            tempInput.multiple = true;
            tempInput.accept = 'image/*';

            tempInput.addEventListener('change', function(event) {
                handleFileSelection(event.target.files);
            });

            tempInput.click();
        });

        function handleFileSelection(files) {
            if (files.length > 0) {
                Array.from(files).forEach((file) => {
                    if (file.type.startsWith('image/')) {
                        // Add file to our array with unique ID
                        const fileObj = {
                            file: file,
                            id: Date.now() + Math.random(), // Unique ID
                            index: imageCounter++
                        };
                        allSelectedFiles.push(fileObj);

                        // Create preview for this file
                        createImagePreview(fileObj);
                    }
                });

                // Update the main file input with all selected files
                updateMainFileInput();
            }
        }

        function createImagePreview(fileObj) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'relative group inline-block mr-4 mb-4';
                imageDiv.setAttribute('data-file-id', fileObj.id);

                imageDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${fileObj.index + 1}"
                         class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                    <div class="absolute top-2 right-2">
                        <button type="button" onclick="removeImage('${fileObj.id}')"
                                class="w-6 h-6 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors duration-200 flex items-center justify-center text-xs">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="absolute top-2 left-2">
                        <span class="bg-green-600 text-white text-xs px-2 py-1 rounded">New</span>
                    </div>
                    <p class="text-xs text-gray-600 mt-1 max-w-32 break-all">${fileObj.file.name}</p>
                `;

                uploadedImagesContainer.appendChild(imageDiv);
            };

            reader.readAsDataURL(fileObj.file);
        }

        function updateMainFileInput() {
            // Create a new DataTransfer object to update the file input
            const dt = new DataTransfer();

            allSelectedFiles.forEach(fileObj => {
                dt.items.add(fileObj.file);
            });

            imageInput.files = dt.files;
        }

        // Global function to remove new images (accessible from onclick)
        window.removeImage = function(fileId) {
            // Remove from our array
            allSelectedFiles = allSelectedFiles.filter(fileObj => fileObj.id !== fileId);

            // Remove from DOM
            const imageDiv = document.querySelector(`[data-file-id="${fileId}"]`);
            if (imageDiv) {
                imageDiv.remove();
            }

            // Update the main file input
            updateMainFileInput();

            // Show message if no images left
            if (allSelectedFiles.length === 0) {
                uploadedImagesContainer.innerHTML = '<p class="text-gray-500 text-sm">No new images selected</p>';
            }
        };

        // Global function to remove current images
        window.removeCurrentImage = function(index) {
            if (confirm('Are you sure you want to remove this image?')) {
                const imageDiv = document.querySelector(`[data-image-index="${index}"]`);
                if (imageDiv) {
                    imageDiv.remove();
                }
            }
        };

        // Pricing management functions
        let pricingIndex = {{ $product->pricings ? $product->pricings->count() : 1 }};

        function addPricingRow(region) {
            let btnId = region === 'D' ? 'addDomesticPlanBtn' : 'addInternationalPlanBtn';
            let addBtn = document.getElementById(btnId);
            let newRow = document.createElement('div');
            newRow.className = 'pricing-row flex items-center gap-2 mb-4';
            newRow.setAttribute('data-index', pricingIndex);

            let currency = region === 'I' ? '$' : '₹';
            let ringColor = region === 'I' ? 'focus:ring-green-500' : 'focus:ring-blue-500';
            let colorClass = region === 'I' ? 'text-green-700' : 'text-blue-700';

                newRow.innerHTML = `
                    <input type="hidden" name="pricings[${pricingIndex}][id]" value="">
                    <input type="hidden" name="pricings[${pricingIndex}][region]" value="${region}">
                    <input type="text" name="pricings[${pricingIndex}][plan_name]" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ${ringColor}" placeholder="Plan Name" required>
                    <div class="relative w-1/4">
                        <span class="absolute left-2 top-2 font-bold ${colorClass} pointer-events-none">${currency}</span>
                        <input type="number" step="0.01" min="0" name="pricings[${pricingIndex}][price]" class="pl-6 pr-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ${ringColor} w-full" placeholder="Price" required>
                    </div>
                    <input type="number" min="0" name="pricings[${pricingIndex}][credits]" class="w-1/4 px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ${ringColor}" placeholder="Credit Value">
                    <button type="button" onclick="removePricingRow(this)" class="w-1/4 px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                        <i class="fas fa-trash mr-1"></i>Remove
                    </button>
                `;

            addBtn.parentNode.insertBefore(newRow, addBtn);
            pricingIndex++;
        }

        document.getElementById('addDomesticPlanBtn').onclick = function() { addPricingRow('D'); };
        document.getElementById('addInternationalPlanBtn').onclick = function() { addPricingRow('I'); };

        window.removePricingRow = function(button) {
            const row = button.closest('.pricing-row');
            // Count all pricing rows in the container
            const allRows = document.querySelectorAll('#pricing-container .pricing-row');
            if (allRows.length > 1) {
                row.remove();
            } else {
                alert('At least one pricing plan is required.');
            }
        };
        
        // Toggle credit field based on product type
        window.toggleCreditField = function() {
            const productType = document.getElementById('product_type').value;
            const creditField = document.getElementById('credit-field');
            const pricingContainer = document.getElementById('pricing-container').parentElement;
            
            if (productType === 'credit') {
                creditField.style.display = 'block';
                pricingContainer.style.display = 'none';
                document.getElementById('credit_value').setAttribute('required', 'required');
            } else {
                creditField.style.display = 'none';
                pricingContainer.style.display = 'block';
                document.getElementById('credit_value').removeAttribute('required');
            }
        };
        
        // Initialize on page load
        toggleCreditField();
    });
</script>
@endsection
