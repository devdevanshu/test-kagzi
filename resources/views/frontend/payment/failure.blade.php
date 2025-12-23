@extends('frontend.layouts.layout')

@section('title', 'Payment Failed - Kagzi InfoTech')

@section('content')
<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('assets/images/background/page-title.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Payment Failed</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('frontend.products.showcase') }}">Products</a></li>
                <li>Payment Failed</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- payment-failure-section -->
<section class="payment-result-section sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 offset-lg-2 content-column">
                <div class="content-box text-center theme-card-style">
                    <div class="error-icon mb_40">
                        <i class="fas fa-times-circle error-icon-style"></i>
                    </div>
                    
                    <div class="sec-title mb_40">
                        <h2 class="error-title">Payment Failed</h2>
                        <p class="theme-paragraph">
                            We're sorry, but there was an issue processing your payment. Please try again.
                        </p>
                    </div>

                    @if($checkout)
                        <div class="order-details theme-card mb_40">
                            <h4 class="theme-color mb_20">Order Information</h4>
                            <div class="details-list">
                                <p><strong>Order ID:</strong> {{ $checkout->order_id }}</p>
                                <p><strong>Product:</strong> {{ $checkout->product->name ?? 'N/A' }}</p>
                                
                                @if($checkout->pricing)
                                    <p><strong>Plan:</strong> {{ $checkout->pricing->title }}</p>
                                    <p><strong>Amount:</strong> <span style="color: #dc3545; font-weight: bold; font-size: 18px;">{{ $checkout->pricing->formatted_price }}</span></p>
                                @endif
                                
                                <p><strong>Status:</strong> <span style="color: #dc3545; font-weight: bold;">{{ ucfirst($checkout->status) }}</span></p>
                                <p><strong>Attempted:</strong> {{ $checkout->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="error-reasons error-message-box mb_30">
                        <h5 class="mb_15">Common reasons for payment failure:</h5>
                        <ul class="error-list">
                            <li>Insufficient funds in your account</li>
                            <li>Incorrect card information or expired card</li>
                            <li>Network connectivity issues</li>
                            <li>Bank declined the transaction</li>
                            <li>Payment gateway temporary issues</li>
                        </ul>
                    </div>

                    <div class="message-box" style="background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; padding: 20px; border-radius: 8px; margin-bottom: 40px;">
                        <h5 style="margin-bottom: 15px;">What Should You Do?</h5>
                        <ul style="text-align: left; margin: 0; padding-left: 20px;">
                            <li>Check your card details and try again</li>
                            <li>Try a different payment method</li>
                            <li>Contact your bank if the issue persists</li>
                            <li>Reach out to our support team for assistance</li>
                        </ul>
                    </div>

                    <div class="btn-box">
                        @if($checkout)
                            <a href="{{ route('frontend.products.show', ['slug' => $checkout->product->slug ?? '']) }}" class="theme-btn btn-one mr_15">
                                <i class="fas fa-redo mr_8"></i>Try Again
                            </a>
                        @endif
                        <a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-two mr_15">
                            <i class="fas fa-arrow-left mr_8"></i>Back to Products
                        </a>
                        <a href="{{ route('contact.page') }}" class="theme-btn btn-three">
                            <i class="fas fa-life-ring mr_8"></i>Get Help
                        </a>
                    </div>

                    {{-- <div class="support-info mt_40 pt_30">
                        <p class="support-text mb_10">
                            <i class="fas fa-headset mr_8"></i>
                            Need immediate assistance? Our support team is here to help
                        </p>
                        <p class="contact-links">
                            <a href="mailto:support@kagziinfotech.com" class="support-link">
                                support@kagziinfotech.com
                            </a>
                            <span class="separator">|</span>
                            <a href="tel:+15551234567" class="support-link">
                                +1 (555) 123-4567
                            </a>
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- payment-failure-section end -->

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

.error-icon-style {
    font-size: 100px;
    color: #dc3545;
    animation: errorShake 1s ease-in-out;
}

@keyframes errorShake {
    0%, 20%, 40%, 60%, 80% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-5px);
    }
}

.error-title {
    color: #dc3545;
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

.error-message-box {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 25px;
    border-radius: 10px;
    text-align: left;
}

.warning-message-box {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    color: #856404;
    padding: 25px;
    border-radius: 10px;
    text-align: left;
}

.error-list, .action-list {
    margin: 0;
    padding-left: 25px;
}

.error-list li, .action-list li {
    margin-bottom: 10px;
    line-height: 1.6;
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

.support-info {
    border-top: 1px solid var(--border-color, #eee);
}

.support-text {
    color: var(--text-color, #666);
}

.support-link {
    color: var(--theme-color, #007bff);
    text-decoration: none;
}

.support-link:hover {
    text-decoration: underline;
}

.separator {
    margin: 0 15px;
    color: #ccc;
}

.mb_40 { margin-bottom: 40px; }
.mb_30 { margin-bottom: 30px; }
.mb_20 { margin-bottom: 20px; }
.mb_15 { margin-bottom: 15px; }
.mb_10 { margin-bottom: 10px; }
.mb_0 { margin-bottom: 0; }
.mr_15 { margin-right: 15px; }
.mr_8 { margin-right: 8px; }
.mt_40 { margin-top: 40px; }
.pt_30 { padding-top: 30px; }

@media (max-width: 768px) {
    .theme-card-style {
        padding: 40px 20px;
    }
    
    .error-icon-style {
        font-size: 80px;
    }
    
    .btn-box .theme-btn {
        display: block;
        margin-bottom: 15px;
        margin-right: 0 !important;
    }
    
    .contact-links {
        text-align: center;
    }
    
    .separator {
        display: block;
        margin: 10px 0;
    }
}
</style>
@endsection

