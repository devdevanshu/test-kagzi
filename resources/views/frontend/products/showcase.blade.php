@extends('frontend.layouts.layout')

@section('title', 'Our Products')

@php 
$title = 'Our Products';
$subTitle = 'Comprehensive Business Solutions';
$css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/service.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

<!-- Products Section -->
<section class="service-section pt_50 pb_90">
    <div class="auto-container">
        <div class="sec-title centred pb_60">
            <h2>Our Products</h2>
            <p>Discover our range of high-quality products designed to meet your needs and exceed your expectations.</p>
        </div>
        
        @if($products && count($products) > 0)
        <div class="row clearfix">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                <a href="{{ route('frontend.products.show', $product->slug) }}" class="product-link-wrapper">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                @if($product->primary_image)
                                <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" style="height: 280px; object-fit: cover; width: 100%;" onerror="this.src='{{ asset('assets/images/service/service-1.jpg') }}'">
                                @else
                                <img src="{{ asset('assets/images/service/service-1.jpg') }}" alt="{{ $product->name }}" style="height: 280px; object-fit: cover; width: 100%;">
                                @endif
                            </div>
                            <div class="lower-content">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="empty-state centred" style="padding: 60px 20px;">
                    <div class="icon-box mb_30">
                        <i class="icon-15" style="font-size: 60px; color: #ccc;"></i>
                    </div>
                    <h3 class="mb_20">No Products Available</h3>
                    <p class="mb_30">We are working on adding amazing products. Please check back soon!</p>
                    <a href="{{ route('home') }}" class="theme-btn btn-one">Contact Us</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Products Section End -->

<style>
.product-link-wrapper {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
}

.service-block {
    margin-bottom: 30px;
}

.service-block-one {
    height: 100%;
    transition: all 0.3s ease;
    border-radius: 8px;
    overflow: hidden;
}

.image-box {
    position: relative;
    overflow: hidden;
    background: #f5f5f5;
}

.lower-content {
    padding: 20px;
}

.lower-content h3 {
    font-size: 18px;
    font-weight: 600;
    margin: 10px 0;
    color: #333;
}

.lower-content p {
    color: #666;
    font-size: 14px;
    margin: 10px 0;
    line-height: 1.5;
}

.service-block-one:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(151, 126, 255, 0.15);
    cursor: pointer;
}

@media (max-width: 768px) {
    .service-block-one {
        margin-bottom: 20px;
    }
}
</style>

@endsection

