@extends('layouts.app')

@section('content')
<!-- page-title -->
<section class="page-title centred">
    <div class="bg-layer parallax-bg" data-parallax='{"y": 100}' style="background-image: url('{{ asset('assets/images/background/page-title.jpg') }}')"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Checkout</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('frontend.products.showcase') }}">Products</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
</section>
<!-- page-title end -->

<!-- checkout-section -->
<section class="checkout-section pt_120 pb_90">
    <div class="auto-container">
        <div class="sec-title centred mb_60">
            <h2>Complete Your Purchase</h2>
            <p>Fill in your details to proceed with the payment</p>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="checkout-form">
                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Customer Information -->
                        <div class="form-group-title">
                            <h3>Customer Information</h3>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label>Full Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="error-text" style="color: #dc3545; font-size: 14px;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="error-text" style="color: #dc3545; font-size: 14px;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <label>Phone Number *</label>
                                <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                    <span class="error-text" style="color: #dc3545; font-size: 14px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Plan Selection -->
                        @if($product->pricings->count() > 0)
                            <div class="form-group-title" style="margin-top: 40px;">
                                <h3>Select Plan</h3>
                            </div>
                            
                            <div class="pricing-plans">
                                @foreach($product->pricings as $pricing)
                                    <div class="pricing-option" style="margin-bottom: 15px; border: 2px solid #e9ecef; border-radius: 8px; overflow: hidden; transition: all 0.3s;">
                                        <label style="display: block; padding: 20px; cursor: pointer; margin: 0;" class="pricing-label">
                                            <input type="radio" name="plan_id" value="{{ $pricing->id }}" {{ old('plan_id', $product->pricings->first()->id) == $pricing->id ? 'checked' : '' }} style="margin-right: 15px;">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <h4 style="margin-bottom: 5px; color: #333;">{{ $pricing->title }}</h4>
                                                    <p style="color: #666; margin: 0; font-size: 14px;">{{ $pricing->type }} - {{ $pricing->type_value }}</p>
                                                </div>
                                                <div>
                                                    <span style="font-size: 24px; font-weight: bold; color: #ff6b35;">{{ $pricing->formatted_price }}</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('plan_id')
                                <span class="error-text" style="color: #dc3545; font-size: 14px;">{{ $message }}</span>
                            @enderror
                        @endif

                        <!-- Payment Method Selection -->
                        <div class="form-group-title" style="margin-top: 40px;">
                            <h3>Payment Method</h3>
                        </div>
                        
                        <div class="payment-methods">
                            <div class="payment-option" style="margin-bottom: 15px; border: 2px solid #e9ecef; border-radius: 8px; overflow: hidden;">
                                <label style="display: block; padding: 15px; cursor: pointer; margin: 0;">
                                    <input type="radio" name="payment_method" value="paypal" {{ old('payment_method', 'paypal') == 'paypal' ? 'checked' : '' }} style="margin-right: 15px;">
                                    <div>
                                        <strong>PayPal</strong>
                                        <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">Pay securely with PayPal</p>
                                    </div>
                                </label>
                            </div>

                            <div class="payment-option" style="margin-bottom: 15px; border: 2px solid #e9ecef; border-radius: 8px; overflow: hidden;">
                                <label style="display: block; padding: 15px; cursor: pointer; margin: 0;">
                                    <input type="radio" name="payment_method" value="stripe" {{ old('payment_method') == 'stripe' ? 'checked' : '' }} style="margin-right: 15px;">
                                    <div>
                                        <strong>Credit/Debit Card</strong>
                                        <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">Pay with Stripe (Visa, MasterCard, etc.)</p>
                                    </div>
                                </label>
                            </div>

                            <div class="payment-option" style="margin-bottom: 15px; border: 2px solid #e9ecef; border-radius: 8px; overflow: hidden;">
                                <label style="display: block; padding: 15px; cursor: pointer; margin: 0;">
                                    <input type="radio" name="payment_method" value="cashfree" {{ old('payment_method') == 'cashfree' ? 'checked' : '' }} style="margin-right: 15px;">
                                    <div>
                                        <strong>Cashfree</strong>
                                        <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">UPI, Net Banking, Cards</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('payment_method')
                            <span class="error-text" style="color: #dc3545; font-size: 14px;">{{ $message }}</span>
                        @enderror

                        <!-- Submit Button -->
                        <div class="btn-box" style="margin-top: 40px;">
                            <button type="submit" class="theme-btn btn-one" style="width: 100%; text-align: center; padding: 15px 30px; font-size: 16px;">
                                Proceed to Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="checkout-sidebar">
                    <div class="sidebar-widget order-summary">
                        <div class="widget-title">
                            <h3>Order Summary</h3>
                        </div>
                        <div class="widget-content">
                            <!-- Product Info -->
                            <div class="product-info" style="margin-bottom: 25px;">
                                @if($product->images && count($product->images) > 0)
                                    <figure class="product-image" style="margin-bottom: 15px;">
                                        <img src="{{ asset($product->images[0]) }}" alt="{{ $product->name }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;" onerror="this.src='{{ asset('assets/images/service/service-1.jpg') }}'">
                                    </figure>
                                @endif
                                
                                <h4 style="color: #333; margin-bottom: 8px;">{{ $product->name }}</h4>
                                @if($product->sku)
                                    <p style="color: #666; font-size: 14px; margin: 0;">SKU: {{ $product->sku }}</p>
                                @endif
                            </div>

                            <div style="border-top: 1px solid #eee; padding-top: 20px;">
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Selected plan pricing will be shown here after selection.</p>
                                
                                <!-- This will be updated via JavaScript when plan is selected -->
                                <div id="selected-plan-info" class="hidden">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <span style="color: #666;">Subtotal:</span>
                                        <span id="subtotal" style="font-weight: 500;">-</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; border-top: 1px solid #eee; padding-top: 15px; color: #ff6b35;">
                                        <span>Total:</span>
                                        <span id="total">-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Info -->
                            <div style="margin-top: 25px; padding: 15px; background: #f0f8f0; border-radius: 8px; border-left: 4px solid #10b981;">
                                <div style="display: flex; align-items: flex-start;">
                                    <i class="icon-27" style="color: #10b981; margin-right: 10px; font-size: 18px;"></i>
                                    <div>
                                        <h5 style="color: #10b981; margin-bottom: 5px; font-size: 14px;">Secure Payment</h5>
                                        <p style="color: #666; font-size: 12px; margin: 0; line-height: 1.4;">Your payment information is encrypted and secure.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const planRadios = document.querySelectorAll('input[name="plan_id"]');
    const planInfo = document.getElementById('selected-plan-info');
    const subtotal = document.getElementById('subtotal');
    const total = document.getElementById('total');
    
    const pricingData = {!! json_encode($product->pricings->keyBy('id')) !!};
    
    function updateOrderSummary() {
        const selectedPlan = document.querySelector('input[name="plan_id"]:checked');
        if (selectedPlan && pricingData[selectedPlan.value]) {
            const pricing = pricingData[selectedPlan.value];
            const currency = pricing.region === 'I' ? '$' : '₹';
            const price = currency + parseFloat(pricing.price).toFixed(2);
            
            subtotal.textContent = price;
            total.textContent = price;
            planInfo.classList.remove('hidden');
        }
    }
    
    planRadios.forEach(radio => {
        radio.addEventListener('change', updateOrderSummary);
    });
    
    // Initialize on page load
    updateOrderSummary();
});
</script>
@endpush
@endsection

