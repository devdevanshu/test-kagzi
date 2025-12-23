@extends('frontend.layouts.layout')

@section('title', 'Checkout')

@php 
$title = 'Checkout';
$subTitle = 'Secure Payment Process';
$css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/contact.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

<!-- Checkout Section -->
<section class="contact-section pt_120 pb_90">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <!-- Customer Details -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                    <div class="form-inner">
                    <div class="content-title">
                        <h2 style="    margin-bottom: 20px;">Billing Details</h2>
                        {{-- <p>Please provide your information to complete the purchase.</p> --}}
                    </div>
                    
                    <form id="checkout-form" method="post" action="{{ route('checkout.process') }}">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id ?? '' }}">
                        <input type="hidden" id="pricing_id" name="plan_id" value="{{ $pricing->id ?? '' }}">
                        
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label style="font-size: 14px; font-weight: 600; color: var(--title-color); margin-bottom: 8px; display: block;">Full Name <span style="color: var(--theme-color);">*</span></label>
                                <input type="text" name="name" placeholder="Enter your full name" required style="width: 100%; padding: 12px 15px; border: 2px solid var(--border-color); border-radius: 8px; font-size: 14px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--theme-color-light)'" onmouseout="this.style.borderColor='var(--border-color)'">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label style="font-size: 14px; font-weight: 600; color: var(--title-color); margin-bottom: 8px; display: block;">Email Address <span style="color: var(--theme-color);">*</span></label>
                                <input type="email" name="email" placeholder="Enter your email" required style="width: 100%; padding: 12px 15px; border: 2px solid var(--border-color); border-radius: 8px; font-size: 14px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--theme-color-light)'" onmouseout="this.style.borderColor='var(--border-color)'">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label style="font-size: 14px; font-weight: 600; color: var(--title-color); margin-bottom: 8px; display: block;">Phone Number <span style="color: var(--theme-color);">*</span></label>
                                <input type="tel" name="phone_number" placeholder="Enter your phone number" required style="width: 100%; padding: 12px 15px; border: 2px solid var(--border-color); border-radius: 8px; font-size: 14px; transition: all 0.3s ease;" onmouseover="this.style.borderColor='var(--theme-color-light)'" onmouseout="this.style.borderColor='var(--border-color)'">
                            </div>
                        </div>

                        <!-- Payment Gateway Selection -->
                        <div class="payment-section">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label style="font-size: 16px; font-weight: 700; color: var(--title-color); margin-bottom: 15px; display: block;">Select Payment Method <span style="color: var(--theme-color);">*</span></label>
                                <div class="payment-methods">
                                    <div id="payment-gateways" class="row">
                                        <!-- Payment gateways will be loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                            <button type="submit" class="theme-btn btn-one" id="place-order-btn" name="submit-form" style="width: 100%; padding: 15px 30px; font-size: 16px; font-weight: 700; border-radius: 8px;">
                                <i class="fas fa-lock mr_10"></i>
                                Place Order & Pay
                            </button>
                        </div>
                        
                        <!-- Hidden field for payment method -->
                        <input type="hidden" name="payment_method" id="selected_payment_method" value="">
                        
                    </form>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="sidebar-widget order-summary">
                        <div class="widget-title">
                            <h3>Order Summary</h3>
                        </div>
                        <div class="widget-content">
                            @if(isset($product) && isset($pricing))
                            
                            <!-- Plan Selection Section (Small Box at Top) -->
                            @if($product->product_type === 'plan' && $product->pricings && $product->pricings->count() > 0)
                            <div class="plan-selection-compact mb_20" style="background: var(--light-bg); padding: 15px; border-radius: 10px; border: 2px solid var(--border-color);">
                                <h4 style="font-size: 13px; font-weight: 700; color: var(--title-color); margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="fas fa-list" style="color: var(--theme-color); margin-right: 5px;"></i>Choose Your Plan
                                </h4>
                                <div class="plans-dropdown" style="display: flex; flex-direction: column; gap: 8px;">
                                    @foreach($product->pricings as $plan)
                                    <!-- Debug: Plan data - Title: {{ $plan->title }}, Price: {{ $plan->price }}, Region: {{ $plan->region }} -->
                                    <label style="display: flex; align-items: center; padding: 8px 10px; background: white; border-radius: 6px; cursor: pointer; border: 1px solid var(--border-color); transition: all 0.2s ease;" class="plan-option">
                                        <input type="radio" 
                                               name="plan_selection" 
                                               value="{{ $plan->id }}" 
                                               class="plan-radio"
                                               data-plan-id="{{ $plan->id }}"
                                               data-plan-title="{{ $plan->title }}"
                                               data-plan-price="{{ $plan->price }}"
                                               data-plan-region="{{ $plan->region }}"
                                               data-plan-type="{{ $plan->type }}"
                                               data-plan-value="{{ $plan->type_value }}"
                                               style="width: 16px; height: 16px; cursor: pointer; accent-color: var(--theme-color); margin-right: 10px;"
                                               {{ $plan->id == $pricing->id ? 'checked' : '' }}>
                                        <div style="flex: 1;">
                                            <span style="font-size: 12px; font-weight: 600; color: var(--title-color);">{{ $plan->title }}</span>
                                            <span style="font-size: 11px; color: #999; margin-left: 8px;">
                                                @if($plan->region == 'D')
                                                    ₹{{ number_format($plan->price, 2) }}
                                                @else
                                                    ${{ number_format($plan->price, 2) }}
                                                @endif
                                            </span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <!-- Product Details -->
                            <div class="order-item" style="display: flex; gap: 15px; padding-bottom: 15px; border-bottom: 2px solid var(--border-color); margin-bottom: 20px;">
                                <div class="item-image">
                                    <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid var(--border-color);">
                                </div>
                                <div class="item-details" style="flex: 1;">
                                    <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: var(--title-color);">{{ $product->name }}</h4>
                                    <p class="plan-info" id="selected-plan-name" style="margin: 5px 0; font-size: 14px; color: var(--theme-color); font-weight: 600;">{{ $pricing->title }}</p>
                                    <p class="plan-type" id="selected-plan-details" style="margin: 5px 0; font-size: 13px; color: #666;">
                                        @if($pricing->type && $pricing->type_value)
                                            {{ ucfirst($pricing->type) }}: <strong>{{ $pricing->type_value }}</strong>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Price Breakdown -->
                            <div class="price-breakdown">
                                <div class="price-row" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--border-color); font-size: 14px; color: #666;">
                                    <span>Subtotal:</span>
                                    <span class="amount" id="subtotal-amount" style="color: var(--title-color); font-weight: 600;">
                                        @if($pricing->region == 'D')
                                            ₹{{ number_format($pricing->price, 2) }}
                                        @else
                                            ${{ number_format($pricing->price, 2) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="price-row" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--border-color); font-size: 14px; color: #666;">
                                    <span>Tax:</span>
                                    <span class="amount" id="tax-amount" style="color: var(--title-color); font-weight: 600;">
                                        @if($pricing->region == 'D')
                                            ₹0.00
                                        @else
                                            $0.00
                                        @endif
                                    </span>
                                </div>
                                <div class="price-row total" style="display: flex; justify-content: space-between; padding: 15px 0; background: var(--light-bg); margin-top: 10px; padding: 15px; border-radius: 8px; font-size: 16px; font-weight: 700;">
                                    <span style="color: var(--title-color);">Total:</span>
                                    <span class="amount" id="total-amount" style="color: var(--theme-color);">
                                        @if($pricing->region == 'D')
                                            ₹{{ number_format($pricing->price, 2) }}
                                        @else
                                            ${{ number_format($pricing->price, 2) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @else
                            <div class="empty-cart" style="text-align: center; padding: 30px 20px; color: #666;">
                                <p>No product selected. <a href="{{ route('frontend.products.showcase') }}" style="color: var(--theme-color); font-weight: 600; text-decoration: none;">Browse Products</a></p>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Security Info -->
                    {{-- <div class="sidebar-widget security-info">
                        <div class="widget-title">
                            <h4>Secure Payment</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="security-features">
                                <li><i class="fas fa-shield-alt"></i> SSL Encrypted</li>
                                <li><i class="fas fa-lock"></i> Secure Transaction</li>
                                <li><i class="fas fa-credit-card"></i> Multiple Payment Options</li>
                                <li><i class="fas fa-undo"></i> Money Back Guarantee</li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Checkout page initializing...');
    
    // Load payment gateways first
    loadPaymentGateways();
    
    // Setup plan selection after a short delay to ensure DOM is ready
    setTimeout(() => {
        setupPlanSelection();
    }, 100);
    
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product_id');
    const planId = urlParams.get('plan_id');
    
    if (productId) {
        const productField = document.getElementById('product_id');
        if (productField) productField.value = productId;
    }
    
    if (planId) {
        const pricingField = document.getElementById('pricing_id');
        if (pricingField) pricingField.value = planId;
        
        // Select the corresponding radio button
        const planRadio = document.querySelector(`input[name="plan_selection"][value="${planId}"]`);
        if (planRadio) {
            planRadio.checked = true;
            planRadio.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }
    
    console.log('Checkout page loaded with:', { productId, planId });
});

function loadPaymentGateways() {
    // Show loading
    document.getElementById('payment-gateways').innerHTML = '<div class="col-12"><div class="d-flex justify-content-center"><i class="fas fa-spinner fa-spin"></i> Loading payment methods...</div></div>';
    
    fetch('/payment/gateways/active', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(`HTTP ${response.status}: ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Payment gateways response:', data);
        if (data.success && data.gateways && data.gateways.length > 0) {
            displayPaymentGateways(data.gateways);
        } else {
            console.warn('No active gateways found:', data);
            document.getElementById('payment-gateways').innerHTML = `
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        No payment methods available at the moment. Please contact support.
                        ${data.debug ? '<br><small>Debug: ' + JSON.stringify(data.debug) + '</small>' : ''}
                    </div>
                </div>`;
        }
    })
    .catch(error => {
        console.error('Error loading payment gateways:', error);
        document.getElementById('payment-gateways').innerHTML = `
            <div class="col-12">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> 
                    Error loading payment methods: ${error.message}
                    <br><small>Please refresh the page or contact support if the problem persists.</small>
                </div>
            </div>`;
    });
}

function displayPaymentGateways(gateways) {
    const container = document.getElementById('payment-gateways');
    
    console.log('Displaying gateways:', gateways);
    console.log('Gateway count:', gateways.length);
    
    if (!gateways || gateways.length === 0) {
        container.innerHTML = `
            <div class="col-12">
                <div class="alert alert-warning" style="padding: 15px; background: #fff3cd; border: 1px solid #ffc107; border-radius: 5px;">
                    <i class="fas fa-exclamation-triangle"></i> 
                    No payment methods available. Please activate payment gateways in admin panel.
                </div>
            </div>`;
        return;
    }
    
    let gatewayHtml = '';
    
    gateways.forEach((gateway, index) => {
        const isChecked = index === 0 ? 'checked' : '';
        const activeClass = index === 0 ? 'selected' : '';
        
        console.log(`Rendering gateway ${index}:`, gateway.name, gateway.keyword);
        
        gatewayHtml += `
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="payment-gateway-option ${activeClass}" style="border: 2px solid ${index === 0 ? 'var(--theme-color)' : 'var(--border-color)'}; border-radius: 8px; padding: 15px; cursor: pointer; transition: all 0.3s ease; background: ${index === 0 ? 'rgba(255, 107, 53, 0.05)' : 'white'};">
                    <input type="radio" 
                           id="gateway-${gateway.keyword}" 
                           name="payment_gateway" 
                           value="${gateway.keyword}" 
                           ${isChecked} 
                           style="margin-right: 10px; width: 18px; height: 18px; cursor: pointer;" 
                           required>
                    <label for="gateway-${gateway.keyword}" class="gateway-label" style="cursor: pointer; margin: 0; display: flex; align-items: center; width: calc(100% - 28px);">
                        <div class="gateway-info" style="flex: 1;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h5 style="margin: 0 0 5px 0; font-size: 16px; font-weight: 600; color: var(--title-color);">${gateway.name || 'Payment Method'}</h5>
                                    <p style="margin: 0; font-size: 13px; color: #666; line-height: 1.4;">${gateway.description || 'Secure payment processing'}</p>
                                </div>
                                <div class="gateway-features" style="display: flex; gap: 5px;">
                                    <span style="background: var(--theme-color); color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">Secure</span>
                                    <span style="background: #10b981; color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">Fast</span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = gatewayHtml;
    
    // Add event listeners for payment gateway selection
    document.querySelectorAll('input[name="payment_gateway"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all options
            document.querySelectorAll('.payment-gateway-option').forEach(option => {
                option.classList.remove('selected');
                option.style.borderColor = 'var(--border-color)';
                option.style.backgroundColor = '#fff';
            });
            
            // Add selected class to chosen option
            const selectedOption = this.closest('.payment-gateway-option');
            selectedOption.classList.add('selected');
            selectedOption.style.borderColor = 'var(--theme-color)';
            selectedOption.style.backgroundColor = 'rgba(255, 107, 53, 0.05)';
            
            // Update hidden field
            document.getElementById('selected_payment_method').value = this.value;
        });
    });
    
    // Set initial selection
    const firstRadio = document.querySelector('input[name="payment_gateway"]');
    if (firstRadio) {
        firstRadio.checked = true;
        document.getElementById('selected_payment_method').value = firstRadio.value;
        const firstOption = firstRadio.closest('.payment-gateway-option');
        firstOption.style.borderColor = 'var(--theme-color)';
        firstOption.style.backgroundColor = 'rgba(255, 107, 53, 0.05)';
    }
}

// Handle form submission
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    const formData = new FormData(this);
    const selectedPayment = document.querySelector('input[name="payment_gateway"]:checked');
    
    // Validate required fields
    if (!formData.get('name') || !formData.get('email') || !formData.get('phone_number')) {
        e.preventDefault();
        alert('Please fill in all required fields (Name, Email, and Phone).');
        return;
    }
    
    if (!selectedPayment) {
        e.preventDefault();
        alert('Please select a payment method.');
        return;
    }
    
    // Update hidden field with selected payment method
    document.getElementById('selected_payment_method').value = selectedPayment.value;
    
    // Disable submit button to prevent double submission
    const submitBtn = document.getElementById('place-order-btn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr_10"></i>Processing...';
    
    // Form will submit normally to the checkout.process route
});

// Setup plan selection handlers
function setupPlanSelection() {
    const planRadios = document.querySelectorAll('.plan-radio');
    
    planRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            console.log('Plan selected:', {
                id: this.value,
                title: this.dataset.planTitle,
                price: this.dataset.planPrice,
                region: this.dataset.planRegion
            });
            
            // Update hidden plan_id field - THIS IS CRITICAL!
            document.getElementById('pricing_id').value = this.value;
            
            // Update plan option styling
            document.querySelectorAll('.plan-option').forEach(option => {
                option.style.background = 'white';
                option.style.borderColor = 'var(--border-color)';
                option.style.boxShadow = 'none';
            });
            
            const selectedOption = this.closest('.plan-option');
            if (selectedOption) {
                selectedOption.style.background = 'rgba(255, 107, 53, 0.08)';
                selectedOption.style.borderColor = 'var(--theme-color)';
                selectedOption.style.boxShadow = '0 2px 6px rgba(255, 107, 53, 0.1)';
            }
            
            // Update old plan card styling (if exists)
            document.querySelectorAll('.plan-card').forEach(card => {
                card.style.borderColor = 'var(--border-color)';
                card.style.backgroundColor = '#fff';
                card.style.boxShadow = 'none';
            });
            
            const selectedCard = this.closest('.plan-card');
            if (selectedCard) {
                selectedCard.style.borderColor = 'var(--theme-color)';
                selectedCard.style.backgroundColor = 'rgba(255, 107, 53, 0.05)';
                selectedCard.style.boxShadow = '0 2px 8px rgba(255, 107, 53, 0.1)';
            }
            
            // Update order summary
            updateOrderSummary(this);
        });
        
        // Click on option to select radio
        const option = radio.closest('.plan-option');
        if (option) {
            option.addEventListener('click', function(e) {
                if (e.target !== radio) {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        }
        
        // Click on card to select radio (old style)
        const card = radio.closest('.plan-card');
        if (card) {
            card.addEventListener('click', function(e) {
                if (e.target !== radio) {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        }
    });
    
    // Add hover effects to plan options
    document.querySelectorAll('.plan-option').forEach(option => {
        option.addEventListener('mouseover', function() {
            if (!this.querySelector('input:checked')) {
                this.style.background = 'var(--light-bg)';
            }
        });
        
        option.addEventListener('mouseout', function() {
            if (!this.querySelector('input:checked')) {
                this.style.background = 'white';
            }
        });
    });
    
    // Initialize the selected plan styling and price on page load
    const checkedRadio = document.querySelector('.plan-radio:checked');
    if (checkedRadio) {
        // Set initial styling
        const selectedOption = checkedRadio.closest('.plan-option');
        if (selectedOption) {
            selectedOption.style.background = 'rgba(255, 107, 53, 0.08)';
            selectedOption.style.borderColor = 'var(--theme-color)';
            selectedOption.style.boxShadow = '0 2px 6px rgba(255, 107, 53, 0.1)';
        }
        
        // Update order summary with initial plan
        updateOrderSummary(checkedRadio);
    }
}

function updateOrderSummary(selectedRadio) {
    if (!selectedRadio) {
        console.error('No radio button selected for order summary update');
        return;
    }
    
    const planTitle = selectedRadio.dataset.planTitle;
    const planPrice = parseFloat(selectedRadio.dataset.planPrice);
    const planRegion = selectedRadio.dataset.planRegion;
    const planType = selectedRadio.dataset.planType;
    const planValue = selectedRadio.dataset.planValue;
    
    console.log('=== Updating Order Summary ===');
    console.log('Plan Title:', planTitle);
    console.log('Plan Price:', planPrice);
    console.log('Plan Region:', planRegion);
    console.log('Plan Type:', planType);
    console.log('Plan Value:', planValue);
    
    // Validate elements exist
    const planNameElement = document.getElementById('selected-plan-name');
    const planDetailsElement = document.getElementById('selected-plan-details');
    const subtotalElement = document.getElementById('subtotal-amount');
    const taxElement = document.getElementById('tax-amount');
    const totalElement = document.getElementById('total-amount');
    
    if (!planNameElement || !planDetailsElement || !subtotalElement || !taxElement || !totalElement) {
        console.error('One or more required elements not found:', {
            planNameElement: !!planNameElement,
            planDetailsElement: !!planDetailsElement,
            subtotalElement: !!subtotalElement,
            taxElement: !!taxElement,
            totalElement: !!totalElement
        });
        return;
    }
    
    // Update plan name
    planNameElement.textContent = planTitle || 'Plan';
    console.log('Updated plan name to:', planTitle);
    
    // Update plan details (type and value)
    let planDetails = '';
    if (planType && planValue) {
        const typeCapitalized = planType.charAt(0).toUpperCase() + planType.slice(1);
        if (planType === 'credit') {
            planDetails = `${typeCapitalized}: <strong>${planValue} credits</strong>`;
        } else {
            planDetails = `${typeCapitalized}: <strong>${planValue}</strong>`;
        }
    }
    planDetailsElement.innerHTML = planDetails;
    console.log('Updated plan details to:', planDetails);
    
    // Update prices
    const currencySymbol = planRegion === 'D' ? '₹' : '$'; // D = Domestic (INR), I = International (USD)
    const formattedPrice = planPrice.toFixed(2);
    
    console.log('Currency Symbol:', currencySymbol);
    console.log('Formatted Price:', formattedPrice);
    
    subtotalElement.textContent = `${currencySymbol}${formattedPrice}`;
    taxElement.textContent = `${currencySymbol}0.00`;
    totalElement.textContent = `${currencySymbol}${formattedPrice}`;
    
    console.log('=== Order Summary Updated Successfully ===');
}
</script>

<style>
.order-item {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    background: #f8f8f8;
    border-radius: 0px;
    margin-bottom: 20px;
    border: 1px solid #eee;
}

.item-image {
    margin-right: 15px;
    flex-shrink: 0;
}

.item-details {
    flex: 1;
}

.item-details h4 {
    margin: 0 0 8px 0;
    font-size: 16px;
    font-weight: 600;
    color: var(--title-color);
    line-height: 1.4;
}

.plan-info,
.plan-type {
    margin: 4px 0;
    font-size: 13px;
    color: #666;
    line-height: 1.4;
}

.plan-type {
    color: #888;
    font-size: 12px;
}

.price-breakdown {
    margin-top: 0;
    padding: 20px;
    background: #f8f8f8;
    border: 1px solid #eee;
    border-radius: 0px;
}

.price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
    color: #666;
}

.price-row:last-of-type {
    margin-bottom: 0;
}

.price-row .amount {
    font-weight: 600;
    color: var(--title-color);
    text-align: right;
}

.price-row.total {
    border-top: 2px solid #ddd;
    padding-top: 12px;
    margin-top: 12px;
    font-weight: 600;
    font-size: 16px;
    color: var(--theme-color);
}

.price-row.total .amount {
    color: var(--theme-color);
    font-size: 16px;
}

.payment-gateway-option {
    border: 2px solid #e0e0e0;
    border-radius: 0px;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-gateway-option:hover {
    border-color: var(--theme-color);
    box-shadow: 0 2px 10px rgba(151, 126, 255, 0.1);
}

.payment-gateway-option.selected {
    border-color: var(--theme-color);
    background-color: rgba(151, 126, 255, 0.05);
}

.gateway-info h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #333;
}

.security-features {
    list-style: none;
    padding: 0;
    margin: 0;
}

.security-features li {
    padding: 10px 0;
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

.security-features i {
    color: var(--theme-color);
    margin-right: 10px;
    width: 16px;
    text-align: center;
}

.sidebar-widget {
    margin-bottom: 20px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 0px;
    overflow: hidden;
}

.sidebar-widget .widget-title {
    background: var(--light-bg);
    padding: 20px;
    border-bottom: 1px solid var(--border-color);
    margin: 0;
}

.sidebar-widget .widget-title h3,
.sidebar-widget .widget-title h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: var(--title-color);
}

.sidebar-widget .widget-content {
    padding: 20px;
}

.empty-cart {
    text-align: center;
    padding: 30px 20px;
    color: #666;
}

.empty-cart a {
    color: var(--theme-color);
    text-decoration: none;
    font-weight: 600;
}

.empty-cart a:hover {
    text-decoration: underline;
}

.payment-section {
    border-top: 1px solid var(--border-color);
    padding-top: 30px;
    margin-top: 30px;
}

.form-group input,
.form-group textarea,
.form-group select {
    border: 2px solid var(--border-color);
    border-radius: 0px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: var(--theme-color);
    box-shadow: 0 0 0 0.2rem rgba(151, 126, 255, 0.25);
    outline: none;
}

.form-group label span {
    color: var(--theme-color);
}

.order-summary {
    border: 2px solid var(--border-color);
    border-radius: 8px;
}

.order-summary:hover {
    border-color: var(--theme-color-light);
    box-shadow: 0 5px 15px rgba(151, 126, 255, 0.1);
}

#place-order-btn {
    width: 100%;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 600;
    background: var(--theme-color);
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}

#place-order-btn:hover {
    background: var(--theme-color-dark);
}

#place-order-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    background: var(--theme-color-light);
}
</style>

@endsection

