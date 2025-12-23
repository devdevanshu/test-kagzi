@extends('frontend.layouts.layout')

@section('title', 'Payment Successful - Kagzi InfoTech')

@section('content')
<!--Page Title-->
{{-- <section class="page-title centred" style="background-image: url({{ asset('assets/images/background/page-title.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Payment Successful</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('frontend.products.showcase') }}">Products</a></li>
                <li>Payment Success</li>
            </ul>
        </div>
    </div>
</section> --}}
<!--End Page Title-->

<!-- payment-success-section -->
<section class="payment-result-section sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 offset-lg-2 content-column">
                <div class="content-box text-center theme-card-style">
                    <div class="success-icon mb_40">
                        <i class="fas fa-check-circle success-check-icon"></i>
                    </div>
                    
                    <div class="sec-title mb_40">
                        <h2 class="theme-color">Payment Successful!</h2>
                        <p class="theme-paragraph">
                            Thank you for your purchase. Your payment has been processed successfully.
                        </p>
                    </div>

                    @if($checkout)
                        <div class="transaction-details theme-card mb_40">
                            <h4 class="theme-color mb_20">Order Details</h4>
                            <div class="details-list">
                                <p><strong>Order ID:</strong> {{ $checkout->order_id }}</p>
                                
                                @if($checkout->transaction_id)
                                    <p><strong>Transaction ID:</strong> {{ $checkout->transaction_id }}</p>
                                @endif
                                
                                <p><strong>Product:</strong> {{ $checkout->product->name ?? 'N/A' }}</p>
                                
                                @if($checkout->pricing)
                                    <p><strong>Plan:</strong> {{ $checkout->pricing->title }}</p>
                                    <p><strong>Amount:</strong> <span style="color: #28a745; font-weight: bold; font-size: 18px;">{{ $checkout->pricing->formatted_price }}</span></p>
                                @endif
                                
                                <p><strong>Payment Method:</strong> {{ ucfirst($checkout->payment_method) }}</p>
                                <p><strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">Confirmed</span></p>
                                <p><strong>Date:</strong> {{ $checkout->purchase_date ? $checkout->purchase_date->format('M d, Y h:i A') : $checkout->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>

                        <div class="message-box success-message-box mb_40">
                            <h5 class="mb_15">What's Next?</h5>
                            <p class="mb_0">
                                You will receive a confirmation email at <strong>{{ $checkout->email }}</strong> with your order details and next steps. Access to your product/service will be activated within 24 hours.
                            </p>
                        </div>
                    @endif

                    <div class="btn-box">
                        <a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one mr_15">
                            <i class="fas fa-arrow-left mr_8"></i>Back to Products
                        </a>
                        <a href="{{ route('contact.page') }}" class="theme-btn btn-two">
                            <i class="fas fa-envelope mr_8"></i>Contact Support
                        </a>
                    </div>

                    {{-- <div class="support-info" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee;">
                        <p style="color: #666; margin-bottom: 10px;">
                            <i class="fas fa-info-circle" style="margin-right: 8px; color: #007bff;"></i>
                            Need help? Contact our support team
                        </p>
                        <p>
                            <a href="mailto:support@kagziinfotech.com" style="color: #007bff; text-decoration: none;">
                                support@kagziinfotech.com
                            </a>
                            <span style="margin: 0 15px; color: #ccc;">|</span>
                            <a href="tel:+15551234567" style="color: #007bff; text-decoration: none;">
                                +1 (555) 123-4567
                            </a>
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- payment-success-section end -->

<style>
.payment-result-section {
    padding: 100px 0;
    background: var(--light-bg, #f9f9f9);
}

.theme-card-style {
    background: white;
    padding: 60px 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.success-check-icon {
    font-size: 100px;
    color: var(--theme-color, #59c542);
    animation: successPulse 2s infinite;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.theme-card {
    background: var(--light-bg, #f8f9fa);
    padding: 30px;
    border-radius: 10px;
    text-align: left;
    border: 1px solid var(--border-color, #e0e0e0);
}

.theme-color {
    color: var(--title-color, #222);
}

.theme-paragraph {
    font-size: 18px;
    color: var(--text-color, #666);
    line-height: 1.6;
}

.success-message-box {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 25px;
    border-radius: 10px;
    text-align: left;
}

.details-list p {
    margin-bottom: 15px;
    font-size: 16px;
    line-height: 1.6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color, #eee);
}

.details-list p:last-child {
    border-bottom: none;
}

.mb_40 { margin-bottom: 40px; }
.mb_20 { margin-bottom: 20px; }
.mb_15 { margin-bottom: 15px; }
.mb_0 { margin-bottom: 0; }
.mr_15 { margin-right: 15px; }
.mr_8 { margin-right: 8px; }

@media (max-width: 768px) {
    .theme-card-style {
        padding: 40px 20px;
    }
    
    .success-check-icon {
        font-size: 80px;
    }
    
    .btn-box .theme-btn {
        display: block;
        margin-bottom: 15px;
        margin-right: 0 !important;
    }
}
</style>
@endsection

