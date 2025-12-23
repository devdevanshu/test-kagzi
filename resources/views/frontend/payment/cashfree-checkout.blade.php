@extends('frontend.layouts.layout')

@section('title', 'Complete Payment - Cashfree')

@section('content')
<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('assets/images/background/page-title.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Complete Payment</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('frontend.products.showcase') }}">Products</a></li>
                <li>Payment</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- Payment Section -->
<section class="payment-section sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 offset-lg-2 content-column">
                <div class="content-box text-center theme-card-style">
                    <div class="sec-title mb_40">
                        <h2 class="theme-color">Secure Payment</h2>
                        <p class="theme-paragraph">
                            Complete your purchase securely using Cashfree
                        </p>
                    </div>

                    @if($checkout)
                        <div class="order-summary theme-card mb_40">
                            <h4 class="theme-color mb_20">Order Summary</h4>
                            <div class="details-list">
                                <p><strong>Product:</strong> {{ $checkout->product->name ?? 'N/A' }}</p>
                                @if($checkout->pricing)
                                    <p><strong>Plan:</strong> {{ $checkout->pricing->title }}</p>
                                    <p><strong>Amount:</strong> 
                                        <span style="color: #28a745; font-weight: bold; font-size: 18px;">
                                            {{ $checkout->currency === 'INR' ? '₹' : '$' }}{{ number_format($checkout->amount ?? $checkout->pricing->price, 2) }}
                                        </span>
                                    </p>
                                @endif
                                <p><strong>Email:</strong> {{ $checkout->email }}</p>
                                <p><strong>Order ID:</strong> {{ $checkout->order_id }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Cashfree Payment Container -->
                    <div id="cashfree-container" class="payment-container mb_40">
                        <div id="payment-loading" class="text-center">
                            <i class="fas fa-spinner fa-spin fa-2x mb_20"></i>
                            <p>Loading secure payment options...</p>
                        </div>
                        
                        <div id="payment-error" class="alert alert-danger" style="display: none;">
                            <p><strong>Payment Error:</strong></p>
                            <p id="error-message"></p>
                            <a href="{{ route('checkout') }}" class="btn btn-primary mt_20">Try Again</a>
                        </div>
                    </div>

                    <div class="payment-info">
                        <p><i class="fas fa-shield-alt text-success"></i> Your payment is secured with 256-bit SSL encryption</p>
                        <p><i class="fas fa-lock text-success"></i> Powered by Cashfree - PCI DSS Compliant</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Payment Section End -->

<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeCashfreePayment();
});

async function initializeCashfreePayment() {
    const loadingEl = document.getElementById('payment-loading');
    const errorEl = document.getElementById('payment-error');
    const errorMessageEl = document.getElementById('error-message');
    
    try {
        // Initialize Cashfree
        const cashfree = Cashfree({
            mode: "{{ config('app.env') === 'production' ? 'production' : 'sandbox' }}"
        });

        @if($session_id)
            // Method 1: Use payment session ID (preferred)
            const checkoutOptions = {
                paymentSessionId: "{{ $session_id }}",
                returnUrl: "{{ route('payment.cashfree.return', ['order_id' => $order_id]) }}",
                components: [
                    "order-details",
                    "card",
                    "netbanking", 
                    "app",
                    "upi"
                ],
                style: {
                    backgroundColor: "#ffffff",
                    color: "#11385b",
                    fontFamily: "Lato",
                    fontSize: "14px",
                    errorColor: "#ff0000",
                    theme: "light"
                }
            };
        @else
            // Method 2: Use order token (fallback)
            const checkoutOptions = {
                paymentSessionId: "{{ $order_data['order_token'] ?? '' }}",
                returnUrl: "{{ route('payment.cashfree.return', ['order_id' => $order_id]) }}"
            };
        @endif

        loadingEl.style.display = 'none';
        
        // Render Cashfree checkout
        cashfree.checkout(checkoutOptions).then(function(result) {
            if (result.error) {
                console.error('Cashfree checkout error:', result.error);
                showError('Payment initialization failed: ' + result.error.message);
            }
            if (result.redirect) {
                console.log('Cashfree redirect:', result.redirect);
            }
        }).catch(function(error) {
            console.error('Cashfree initialization failed:', error);
            showError('Unable to load payment options. Please try again.');
        });

    } catch (error) {
        console.error('Payment initialization error:', error);
        showError('Payment system unavailable. Please try again later.');
    }
}

function showError(message) {
    const loadingEl = document.getElementById('payment-loading');
    const errorEl = document.getElementById('payment-error');
    const errorMessageEl = document.getElementById('error-message');
    
    loadingEl.style.display = 'none';
    errorMessageEl.textContent = message;
    errorEl.style.display = 'block';
}
</script>

<style>
.payment-container {
    min-height: 400px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 30px;
    background: #f8f9fa;
}

.order-summary {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
}

.details-list p {
    margin: 10px 0;
    font-size: 14px;
}

.payment-info {
    margin-top: 20px;
    font-size: 13px;
    color: #666;
}

.payment-info i {
    margin-right: 8px;
}

.alert {
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

#cashfree-container {
    position: relative;
}

/* Cashfree SDK Styling Overrides */
.cf-checkout-container {
    border: none !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
}

.cf-payment-method {
    border-radius: 8px !important;
    margin-bottom: 15px !important;
}
</style>

@endsection

