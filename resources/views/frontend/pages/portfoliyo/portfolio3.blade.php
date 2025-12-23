@extends('frontend.layouts.layout')

@php
    $title='Portfolio Masonry';
    $subTitle='Portfolio Masonry';
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/portfolio.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

        <!-- portfolio-section -->
        <section class="portfolio-section portfolio-masonry centred pt_110 pb_120">
            <div class="auto-container">
                <div class="sec-title pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">REQUEST NEEDED TALENT</span>
                    <h2 class="title-animation">Talented Professionals Needed</h2>
                </div>
                <div class="sortable-masonry">
                    <div class="filters mb_60">
                        <ul class="filter-tabs filter-btns">
                            <li class="active filter" data-role="button" data-filter=".all">View All</li>
                            <li class="filter" data-role="button" data-filter=".consulting">Consulting</li>
                            <li class="filter" data-role="button" data-filter=".market">Market</li>
                            <li class="filter" data-role="button" data-filter=".presentation">Presentation</li>
                            <li class="filter" data-role="button" data-filter=".recruitment">Recruitment</li>
                            <li class="filter" data-role="button" data-filter=".technology">Technology</li>
                        </ul>
                    </div>
                    <div class="items-container row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all consulting presentation technology">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-16.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="#">Consulting Excellence Portfolio</a></h3>
                                        <div class="link"><a href="#">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all market recruitment">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-17.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="#">Create a series of blog posts discussing</a></h3>
                                        <div class="link"><a href="#">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all consulting presentation technology">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-18.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="#">Explore the concept of personal</a></h3>
                                        <div class="link"><a href="#">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all market recruitment technology">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-19.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="#">Share stories of employees who have</a></h3>
                                        <div class="link"><a href="#">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all consulting presentation">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-20.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="#">Provide guidance on crafting effective</a></h3>
                                        <div class="link"><a href="#">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all market recruitment technology">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-21.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="#">Detail any internship or graduate</a></h3>
                                        <div class="link"><a href="#">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all market recruitment technology">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-22.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="#">Share stories of employees who have</a></h3>
                                        <div class="link"><a href="#">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12 masonry-item small-column all consulting presentation">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-23.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="{{ route('portfolio') }}">Provide guidance on crafting effective</a></h3>
                                        <div class="link"><a href="{{ route('portfolio') }}">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all market recruitment technology">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/portfolio/portfolio-24.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <span>Consulting</span>
                                        <h3><a href="{{ route('portfolio') }}">Detail any internship or graduate</a></h3>
                                        <div class="link"><a href="{{ route('portfolio') }}">Learn More</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-wrapper pt_20">
                    <ul class="pagination clearfix">
                        <li><a href="#"><i class="icon-34"></i></a></li>
                        <li><a href="#" class="current">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="icon-35"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- portfolio-section end -->

@endsection

