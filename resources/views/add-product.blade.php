@extends('layouts.admin')

@section('title', 'Add Product - Admin Panel')
@section('page-title', 'Add Product')
@section('page-description', 'Add new products to your store')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="card p-6">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg" role="alert">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="name">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           required
                           class="input w-full"
                           placeholder="Enter product name"
                           value="{{ old('name') }}">
                </div>

                {{-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="sku">
                        SKU
                    </label>
                    <input type="text" 
                           name="sku" 
                           id="sku"
                           class="input w-full"
                           placeholder="Enter product SKU"
                           value="{{ old('sku') }}">
                </div> --}}
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="description">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                         id="description" 
                         rows="4" 
                         required
                          class="input w-full"
                          placeholder="Enter product description">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="project_url">
                    Project URL
                </label>
                <input type="url" 
                       name="project_url" 
                       id="project_url"
                       class="input w-full"
                       placeholder="Enter project URL (e.g., https://example.com)"
                       value="{{ old('project_url') }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Region
                    </label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="region" 
                                   value="domestic" 
                                   id="region_domestic" 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" 
                                   checked>
                            <label for="region_domestic" class="ml-2 text-sm text-gray-700">
                                Domestic
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="region" 
                                   value="international" 
                                   id="region_international" 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <label for="region_international" class="ml-2 text-sm text-gray-700">
                                International
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="plan_count">
                        Number of Plans <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           min="1" 
                           max="20" 
                           id="plan_count" 
                           name="plan_count"
                           class="input w-32"
                           placeholder="Enter number"
                           value="{{ old('plan_count', 1) }}">
                    <p class="text-xs text-gray-500 mt-1">You can add 1-20 plans</p>
                </div>
            </div>
            <div class="mb-8">
                <div id="dynamic-plan-fields" class="flex flex-col gap-4"></div>
            </div>

            <div>
                <label class="bloc <span class="text-gray-500">(Optional - Upload any number of images)</span>
                </label>
                <div class="space-y-3">
                    <input type="file" 
                           name="images[]" 
                           id="images" 
                           multiple 
                           accept="image/*"
                           class="input w-full">
                    <p class="text-xs text-gray-500">You can select multiple images at once. Supported formats: JPG, PNG, GIF (Max 10MB per image)</p>
                </div>
            </div>

            <!-- Display Uploaded Images -->
            <div id="preview-section" class="hidden">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Images</h4>
                <div id="uploaded-images" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4mages</h4>
                <div id="uploaded-images" class="flex flex-wrap gap-4 mt-2">
                    <!-- Images will be displayed here -->
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            class="btn bg-gray-600 text-white hover:bg-gray-700"
                            onclick="window.history.back()">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>Add Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dynamic plan fields
        const planCountInput = document.getElementById('plan_count');
        const dynamicPlanFields = document.getElementById('dynamic-plan-fields');
        planCountInput.addEventListener('input', function() {
            let count = parseInt(planCountInput.value);
            const regionDomestic = document.getElementById('region_domestic').checked;
            const currency = regionDomestic ? '₹' : '$';
            const currencyName = regionDomestic ? 'Rupees' : 'USD';
            dynamicPlanFields.innerHTML = '';
            if (!isNaN(count) && count > 0 && count <= 10) {
                let grid = document.createElement('div');
                grid.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
                for (let i = 0; i < count; i++) {
                    let card = document.createElement('div');
                    card.className = 'relative bg-white2border border-gray-200 rounded-xl shadow-md p-6 flex flex-col group hover:shadow-lg transition';
                    card.innerHTML = `
                        <div class="flex items-center gap-2 mb-4">
                            <span class="inline-block w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">${i + 1}</span>
                            <span class="font-semibold text-blue-700 text-lg">Plan #${i + 1}</span>
                        </div>
                        <button type="button" class="absolute top-2 right-2 w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center opacity-0 group-hover:opacity-100 transition" title="Remove Plan" data-remove-plan="${i}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                        <div class="mb-3">
                            <label class="block text-gray-700 text-sm font-medium mb-1">Plan Name</label>
                            <input type="text" name="plans[${i}][name]" placeholder="Plan name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        </div>
                        <div class="mb-3">
                            <label class="block text-gray-700 text-sm font-medium mb-1">Price (${currencyName})</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500 font-semibold">${currency}</span>
                                <input type="number" name="plans[${i}][price]" step="0.01" placeholder="Plan price" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500 text-sm" />
                            </div>
                        </div>
                        <input type="hidden" name="plans[${i}][region]" value="${regionDomestic ? 'D' : 'I'}" />
                        <input type="hidden" name="plans[${i}][currency]" value="${regionDomestic ? 'INR' : 'USD'}" />
                        <div class="mb-3">
                            <label class="block text-gray-700 text-sm font-medium mb-1">Credits</label>
                            <div class="flex flex-row gap-4 mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="plans[${i}][credits]" value="yes" class="form-radio text-blue-600 plan-credits-yes" id="plan_credits_yes_${i}" />
                                    <span class="ml-1 text-gray-700 text-xs">Yes</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="plans[${i}][credits]" value="no" class="form-radio text-blue-600 plan-credits-no" id="plan_credits_no_${i}" checked />
                                    <span class="ml-1 text-gray-700 text-xs">No</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-2 plan-credit-value" style="display:none">
                            <label class="block text-gray-700 text-sm font-medium mb-1">Credit Value</label>
                            <input type="number" name="plans[${i}][credit_value]" step="1" placeholder="Credit value" class="w-40 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm" />
                        </div>
                    `;
                    grid.appendChild(card);
                    // Only touch this logic: show/hide credit value
                    const yesRadio = card.querySelector('.plan-credits-yes');
                    const noRadio = card.querySelector('.plan-credits-no');
                    const creditValueDiv = card.querySelector('.plan-credit-value');
                    if (yesRadio && noRadio && creditValueDiv) {
                        yesRadio.addEventListener('change', function() {
                            if (yesRadio.checked) {
                                creditValueDiv.style.display = '';
                            }
                        });
                        noRadio.addEventListener('change', function() {
                            if (noRadio.checked) {
                                creditValueDiv.style.display = 'none';
                            }
                        });
                        // Initial state
                        creditValueDiv.style.display = noRadio.checked ? 'none' : '';
                    }
                }
                dynamicPlanFields.appendChild(grid);
                // Remove plan logic
                dynamicPlanFields.querySelectorAll('[data-remove-plan]').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        let idx = parseInt(btn.getAttribute('data-remove-plan'));
                        let newCount = grid.children.length - 1;
                        if (newCount < 1) return;
                        // Remove the card
                        grid.removeChild(grid.children[idx]);
                        // Re-render all cards with new indices
                        planCountInput.value = newCount;
                        planCountInput.dispatchEvent(new Event('input'));
                    });
                });
            }
        });

        // Update plans when region changes
        document.getElementById('region_domestic').addEventListener('change', function() {
            if (planCountInput.value) {
                planCountInput.dispatchEvent(new Event('input'));
            }
        });
        document.getElementById('region_international').addEventListener('change', function() {
            if (planCountInput.value) {
                planCountInput.dispatchEvent(new Event('input'));
            }
        });

        // ...existing code for image upload preview and other scripts...
        // Image upload preview functionality (existing)
        const imageInput = document.getElementById('images');
        const actualImageInput = document.getElementById('actualImages');
        const uploadedImagesContainer = document.getElementById('uploaded-images');
        conImage upload preview - Simplified version
        const imageInput = document.getElementById('images');
        const uploadedImagesContainer = document.getElementById('uploaded-images');
        const previewSection = document.getElementById('preview-section');
        
        imageInput.addEventListener('change', function(event) {
            const files = event.target.files;
            uploadedImagesContainer.innerHTML = '';
            
            if (files.length > 0) {
                previewSection.classList.remove('hidden');
                
                Array.from(files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imageDiv = document.createElement('div');
                            imageDiv.className = 'relative group';
                            imageDiv.innerHTML = `
                                <img src="${e.target.result}" alt="Preview ${index + 1}"
                                     class="w-full h-24 object-cover rounded-lg border-2 border-gray-200">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <span class="text-white text-xs text-center px-2">${file.name.substring(0, 20)}</span>
                                </div>
                            `;
                            uploadedImagesContainer.appendChild(imageDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                previewSection.classList.add('hidden');
            }
        })