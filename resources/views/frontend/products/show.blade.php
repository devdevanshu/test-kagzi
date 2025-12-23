@extends('frontend.layouts.layout')

@section('title', $product->name)

@php 
$title = $product->name;
$subTitle = 'Product Details';
$css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/service-details.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')
<!-- Product Details Section -->
<section class="service-details pt_50 pb_90">
    <div class="auto-container">
        <!-- Project Information Section -->
        <div class="row clearfix mb_50">
            <div class="col-12">
                <div class="project-info-section centred">
                    <h2 class="mb_20">Project Information</h2>
                    <div class="project-url">
                        <strong>Project URL: </strong>
                        <a href="{{ $product->project_url ?? '#' }}" target="_blank" class="theme-color">{{ $product->project_url ?? 'Not Available' }}</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-2 col-md-12 col-sm-12"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="service-details-content">
                    <!-- Product Images -->
                    <div class="content-one mb_50">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <figure class="image-box mb_30">
                                    <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" id="main-image" style="width: 100%; height: 350px; object-fit: cover; border-radius: 10px;">
                                </figure>
                                
                                @if($product->images && count($product->images) > 1)
                                <div class="image-gallery">
                                    <div class="row">
                                        @foreach($product->image_urls as $key => $image)
                                        <div class="col-3 mb_15">
                                            <img src="{{ $image }}" alt="{{ $product->name }}" 
                                                 class="img-thumbnail gallery-thumb" 
                                                 style="height: 70px; object-fit: cover; cursor: pointer;"
                                                 onclick="changeMainImage('{{ $image }}')">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-lg-6 col-md-12">
                                <div class="content-box" style="background: var(--light-bg, #f8f9fa); padding: 40px; border-radius: 15px; border: 1px solid var(--border-color, #e0e0e0);">
                                    <h2 style="margin-bottom: 15px;">{{ $product->name }}</h2>
                                    @if($product->sku)
                                    <p class="sku" style="margin-bottom: 25px;"><strong>SKU:</strong> {{ $product->sku }}</p>
                                    @endif
                                    
                                    <div class="text mb_30">
                                        <h4 class="mb_15">Description</h4>
                                        <p>{{ $product->description }}</p>
                                    </div>
                                    
                                    <!-- Product Type Display -->
                                    @if($product->product_type === 'credit')
                                        <div class="credit-info mb_30 p-4" style="background: linear-gradient(135deg, #f7f9fc 0%, #eef2f7 100%); border-radius: 12px; border-left: 4px solid var(--theme-color);">
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                <i class="fas fa-coins" style="font-size: 24px; color: var(--theme-color);"></i>
                                                <div>
                                                    <h4 style="margin: 0; color: var(--title-color); font-size: 18px; font-weight: 700;">Credit-based Product</h4>
                                                    <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">Purchase this product to get <strong style="color: var(--theme-color);">{{ $product->credit_value }} credits</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Buy Now Button -->
                                    @if(($product->product_type === 'credit' && $product->credit_value) || ($product->product_type === 'plan' && $product->pricings && $product->pricings->count() > 0))
                                    <div class="btn-box mb_30">
                                        @if($product->product_type === 'credit')
                                            <!-- Credit-based product: Show fixed price from first plan -->
                                            @php $firstPlan = $product->pricings->first(); @endphp
                                            @if($firstPlan)
                                                <button type="button" class="theme-btn btn-one" onclick="buyCredits({{ $firstPlan->id }})" style="padding: 12px 30px; font-size: 16px; font-weight: 600; width: 100%; max-width: 300px;">
                                                    <i class="fas fa-coins mr_10"></i>Buy {{ $product->credit_value }} Credits - 
                                                    @if($firstPlan->region == 'I')
                                                        ${{ number_format($firstPlan->price, 2) }}
                                                    @else
                                                        ₹{{ number_format($firstPlan->price, 2) }}
                                                    @endif
                                                </button>
                                            @endif
                                        @else
                                            <!-- Plan-based product: Go directly to checkout with first plan -->
                                            @php $firstPlan = $product->pricings->first(); @endphp
                                            @if($firstPlan)
                                                <button type="button" class="theme-btn btn-one" onclick="directCheckout({{ $firstPlan->id }})" style="padding: 12px 30px; font-size: 16px; font-weight: 600; width: 100%; max-width: 250px;">
                                                    <i class="fas fa-shopping-cart mr_10"></i>Buy Now 
                                                    {{-- @if($firstPlan->region == 'I')
                                                        ${{ number_format($firstPlan->price, 2) }}
                                                    @else
                                                        ₹{{ number_format($firstPlan->price, 2) }}
                                                    @endif --}}
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                    @else
                                    <div class="alert alert-info mb_30">
                                        <p>This product is not available for purchase at the moment.</p>
                                        <a href="{{ route('contact.index') }}" class="theme-btn btn-one mt_15">Contact Us</a>
                                    </div>
                                    @endif
                                    
                                    @if($product->product_type === 'plan' && $product->pricings && $product->pricings->count() > 0)
                                    <!-- Hidden Pricing Plans for Popup -->
                                    <div class="pricing-plans mb_30" style="display: none;" id="pricing-data">
                                        <form id="plan-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            
                                            @foreach($product->pricings as $pricing)
                                            <div class="pricing-option mb_15" style="border: 2px solid var(--border-color); border-radius: 12px; padding: 20px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 15px;">
                                                <input class="form-check-input" type="radio" 
                                                       name="plan_id" value="{{ $pricing->id }}" 
                                                       id="plan-{{ $pricing->id }}"
                                                       data-price="{{ $pricing->price }}"
                                                       data-currency="{{ $pricing->region == 'I' ? 'USD' : 'INR' }}"
                                                       style="width: 24px; height: 24px; cursor: pointer; accent-color: var(--theme-color);"
                                                       {{ $loop->first ? 'checked' : '' }}>
                                                <label class="form-check-label" for="plan-{{ $pricing->id }}" style="cursor: pointer; margin: 0; flex: 1;">
                                                    <div class="plan-details" style="display: flex; justify-content: space-between; align-items: flex-start; width: 100%;">
                                                        <div class="plan-left">
                                                            <h5 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: var(--title-color);">{{ $pricing->title }}</h5>
                                                            @if($pricing->type && $pricing->type_value)
                                                            <p class="plan-type" style="margin: 0; font-size: 13px; color: var(--theme-color); font-weight: 600;">{{ ucfirst($pricing->type) }}: <strong>{{ $pricing->type_value }}</strong></p>
                                                            @endif
                                                        </div>
                                                        <div class="plan-right" style="text-align: right;">
                                                            <span class="price" style="display: block; font-size: 18px; font-weight: 700; color: var(--theme-color); margin-bottom: 5px;">
                                                                @if($pricing->region == 'I')
                                                                    ₹{{ number_format($pricing->price, 2) }}
                                                                @else
                                                                    ${{ number_format($pricing->price, 2) }}
                                                                @endif
                                                            </span>
                                                            <span style="font-size: 12px; color: #999;">
                                                                @if($pricing->region == 'I')
                                                                    INR
                                                                @else
                                                                    USD
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            @endforeach
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Features -->
                    @if($product->meta_description)
                    <div class="content-two mb_50">
                        <h3>Product Features</h3>
                        <div class="text">
                            <p>{{ $product->meta_description }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-2 col-md-12 col-sm-12"></div>
        </div>
    </div>
</section>

@if($product->product_type === 'plan' && $product->pricings && $product->pricings->count() > 0)
<!-- Modal structure removed - Plans now shown in checkout page -->
@endif
<!-- Product Details Section End -->

<!-- Checkout Popup Removed - Now using dedicated checkout page -->
        
        
    </div>
</div>

<script>
function changeMainImage(imageUrl) {
    document.getElementById('main-image').src = imageUrl;
}

function buyCredits(planId) {
    // Direct purchase for credit-based products
    const productId = {{ $product->id }};
    window.location.href = `/checkout?product_id=${productId}&plan_id=${planId}&type=credit`;
}

function directCheckout(planId) {
    // Direct checkout for plan-based products (skip plan selection modal)
    const productId = {{ $product->id }};
    window.location.href = `/checkout?product_id=${productId}&plan_id=${planId}&type=plan`;
}

function closePlansModal() {
    // Deprecated - no longer needed
    console.log('Modal function deprecated');
}

function selectPlanAndProceed() {
    // Deprecated - use directCheckout instead
    console.log('Proceed function deprecated');
}

function updateSelectedPlanPrice() {
    const selectedPlan = document.querySelector('input[name="plan_id"]:checked');
    const priceDisplay = document.getElementById('selectedPlanPrice');
    
    if (selectedPlan && priceDisplay) {
        const price = selectedPlan.dataset.price;
        const currency = selectedPlan.dataset.currency;
        const symbol = currency === 'USD' ? '$' : '₹';
        priceDisplay.textContent = `${symbol}${parseFloat(price).toFixed(2)}`;
    }
}

// Add event listeners for plan selection
document.addEventListener('DOMContentLoaded', function() {
    const planRadios = document.querySelectorAll('input[name="plan_id"]');
    planRadios.forEach(radio => {
        radio.addEventListener('change', updateSelectedPlanPrice);
        
        // Add click listener to parent div for better UX
        const parentDiv = radio.closest('.pricing-option');
        if (parentDiv) {
            parentDiv.addEventListener('click', function() {
                radio.checked = true;
                updateSelectedPlanPrice();
                
                // Remove active class from all options
                document.querySelectorAll('.pricing-option').forEach(opt => {
                    opt.style.borderColor = 'var(--border-color)';
                    opt.style.backgroundColor = '#fff';
                });
                
                // Add active class to selected option
                this.style.borderColor = 'var(--theme-color)';
                this.style.backgroundColor = 'rgba(var(--theme-color-rgb), 0.05)';
            });
        }
    });
    
    // Initialize first plan selection
    updateSelectedPlanPrice();
    
    // Click outside modal to close
    window.onclick = function(event) {
        const modal = document.getElementById('plansModal');
        if (event.target === modal) {
            closePlansModal();
        }
    }
});

// Legacy function for backward compatibility
function redirectToCheckout() {
    @if($product->product_type === 'credit')
        const firstPlan = @json($product->pricings->first());
        if (firstPlan) {
            buyCredits(firstPlan.id);
        }
    @else
        showPlansModal();
    @endif
}
</script>
</script>

<style>
/* Modal Animation */
@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Project Info Section */
.project-info-section {
    padding: 30px;
    background: var(--light-bg);
    border-radius: 10px;
    margin-bottom: 30px;
}

.project-info-section h2 {
    color: var(--title-color);
    font-weight: 600;
}

.project-url {
    font-size: 16px;
}

.project-url a {
    color: var(--theme-color);
    text-decoration: none;
}

.project-url a:hover {
    text-decoration: underline;
}

/* Gallery Styles */
.gallery-thumb {
    border: 2px solid transparent;
    transition: border-color 0.3s ease;
    border-radius: 8px;
}

.gallery-thumb:hover {
    border-color: var(--theme-color);
}

/* Button Styles */
/* .btn-box {
    margin-top: 20px;
} */

.btn-box .theme-btn {
    background: var(--theme-color);
    color: white;
    border: none;
    /* border-radius: 8px; */
}

.btn-box .theme-btn:hover {
    background: var(--theme-color-dark);
    color: white;
}

.alert {
    padding: 20px;
    border-radius: 8px;
    background: var(--light-bg);
    border: 1px solid var(--theme-color);
    color: #333;
}

/* Payment Gateway Styles */
.payment-gateway-card {
    padding: 20px;
    border: 1px solid var(--border-color, #e0e0e0);
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.payment-gateway-card h5 {
    color: var(--title-color);
    margin-bottom: 10px;
    font-weight: 600;
}

.payment-gateway-card p {
    color: #666;
    margin-bottom: 15px;
}

.paypal-button-container {
    margin: 15px 0;
}

.paypal-button {
    cursor: pointer;
    transition: opacity 0.3s ease;
    max-width: 150px;
    height: auto;
}

.paypal-button:hover {
    opacity: 0.8;
}

.cashfree-pay-btn {
    background: #00d4aa;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}

.cashfree-pay-btn:hover {
    background: #00b894;
}

.loading-payment-methods {
    text-align: center;
    padding: 20px;
    color: #666;
}

.payment-method-item {
    padding: 12px;
    border: 1px solid var(--border-color, #e0e0e0);
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-method-item:hover {
    background: var(--light-bg, #f9f9f9);
    border-color: var(--theme-color, #59c542);
}

.payment-method-item.active {
    background: var(--light-bg, #f9f9f9);
    border-color: var(--theme-color, #59c542);
}

.payment-label {
    cursor: pointer;
    font-weight: 500;
    color: var(--title-color);
}

/* Checkout Popup Styles - Theme Compatible */
.checkout-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
}

.popup-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 10px;
    width: 95%;
    max-width: 1200px;
    max-height: 95vh;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    border-bottom: 1px solid var(--border-color, #e0e0e0);
    background: var(--light-bg, #f9f9f9);
    border-radius: 10px 10px 0 0;
}

.popup-header h3 {
    margin: 0;
    color: var(--title-color, #333);
    font-size: 24px;
    font-weight: 600;
}

.close-btn {
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: #666;
    padding: 5px;
    line-height: 1;
}

.close-btn:hover {
    color: var(--theme-color, #59c542);
}

.popup-body {
    padding: 15px 30px;
}

/* Product Image in Popup */
.product-image-box {
    text-align: center;
    margin-bottom: 30px;
}

.popup-product-image {
    width: 100%;
    max-width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid var(--border-color, #e0e0e0);
}

/* Form Styles using theme classes */
.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--title-color, #333);
    font-size: 16px;
}

.theme-input-style {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid var(--border-color, #e0e0e0);
    border-radius: 8px;
    font-size: 16px;
    background: var(--light-bg, #f9f9f9);
    transition: all 0.3s ease;
}

.theme-input-style:focus {
    outline: none;
    border-color: var(--theme-color, #59c542);
    background: white;
    box-shadow: 0 0 0 3px rgba(89, 197, 66, 0.1);
}

.phone-input-wrapper {
    display: flex;
    align-items: center;
    background: var(--light-bg, #f9f9f9);
    border: 2px solid var(--border-color, #e0e0e0);
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.phone-input-wrapper:focus-within {
    border-color: var(--theme-color, #59c542);
    background: white;
    box-shadow: 0 0 0 3px rgba(89, 197, 66, 0.1);
}

.country-code-badge {
    padding: 15px 15px;
    background: var(--theme-color, #59c542);
    color: white;
    font-weight: 600;
    font-size: 16px;
    white-space: nowrap;
    border: none;
    flex-shrink: 0;
}

.phone-number-input {
    border: none !important;
    background: transparent !important;
    border-radius: 0 !important;
    flex: 1;
}

.payment-methods-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
}

.payment-method-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border: 2px solid var(--border-color, #e0e0e0);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-method-item:hover {
    border-color: var(--theme-color, #59c542);
    background: var(--light-bg, #f9f9f9);
}

.payment-radio {
    margin-right: 10px;
    accent-color: var(--theme-color, #59c542);
    transform: scale(1.2);
}

.payment-label {
    font-weight: 500;
    color: var(--title-color, #333);
    cursor: pointer;
    margin: 0;
}

/* Plan Selection Styles */
.plan-selection-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.plan-selection-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border: 2px solid var(--border-color, #e0e0e0);
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.plan-selection-item:hover {
    border-color: var(--theme-color, #59c542);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(89, 197, 66, 0.15);
}

.plan-selection-item.active {
    border-color: var(--theme-color, #59c542);
    background: rgba(89, 197, 66, 0.05);
}

.plan-credits-text {
    font-weight: 600;
    color: var(--title-color, #333);
    font-size: 16px;
}

.plan-price-text {
    font-size: 18px;
    font-weight: bold;
    color: var(--theme-color, #59c542);
}

.plan-radio {
    margin-left: 15px;
    accent-color: var(--theme-color, #59c542);
    transform: scale(1.3);
}

.payment-summary-box {
    border-top: 2px solid var(--border-color, #e0e0e0);
    padding-top: 20px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 16px;
}

.summary-label {
    color: var(--text-color, #666);
}

.summary-value {
    font-weight: 600;
    color: var(--title-color, #333);
}

.total-item {
    font-weight: bold;
    font-size: 20px;
    border-top: 2px solid var(--border-color, #e0e0e0);
    padding-top: 12px;
    margin-top: 10px;
}

.total-item .summary-value {
    color: var(--theme-color, #59c542);
}

/* Responsive Design */
@media (max-width: 991px) {
    .popup-content {
        width: 95%;
        max-width: none;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
    }
    
    .popup-body {
        padding: 30px 20px;
    }
}

@media (max-width: 768px) {
    .popup-content {
        width: 100%;
        height: 100%;
        max-height: 100vh;
        border-radius: 0;
        left: 0 !important;
        top: 0 !important;
        transform: translate(0, 0) !important;
    }
    
    .popup-header {
        padding: 15px 20px;
        border-radius: 0;
    }
    
    .popup-header h3 {
        font-size: 20px;
    }
    
    .popup-body {
        padding: 20px 15px;
    }
    
    .payment-methods-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .plan-selection-item {
        padding: 15px;
    }
    
    .close-btn {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .popup-body {
        padding: 15px 10px;
    }
    
    .theme-input-style,
    .country-code-badge {
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .plan-price-text {
        font-size: 16px;
    }
    
    .plan-credits-text {
        font-size: 14px;
    }
}
</style>

@endsection

