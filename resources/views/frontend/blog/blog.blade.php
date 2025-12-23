@extends('layouts.layout')

@php
    $title='Blog Grid';
    $subTitle='Blog Grid';
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/news.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/blog-sidebar.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

    <!-- sidebar-page-container -->
    <section class="sidebar-page-container p_relative pt_110 pb_120">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar mr_40 mb_30">
                        <div class="search-widget mb_60">
                            <div class="search-form">
                                <form method="post" action="{{ route('#') }}">
                                    <div class="form-group">
                                        <input type="search" name="search-field" placeholder="Search" required>
                                        <button type="submit"><i class="icon-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget category-widget mb_50">
                            <div class="widget-title mb_11">
                                <h3>Categories</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list clearfix">
                                    <li><a href="{{ route('#') }}">Day Trading<span>(09)</span></a></li>
                                    <li><a href="{{ route('#') }}">Finance<span>(20)</span></a></li>
                                    <li><a href="{{ route('#') }}">Virtual Hiring<span>(25)</span></a></li>
                                    <li><a href="{{ route('#') }}">Headhunting<span>(06)</span></a></li>
                                    <li><a href="{{ route('#') }}">Promotions<span>(18)</span></a></li>
                                    <li><a href="{{ route('#') }}">Recruitment Agencies<span>(11)</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget post-widget mb_60">
                            <div class="widget-title mb_20">
                                <h3>Latest Posts</h3>
                            </div>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="post-thumb"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/post-1.jpg') }}" alt=""></a></figure>
                                    <h6><a href="{{ route('blogDetails') }}">Provide guidance on crafting effective</a></h6>
                                    <span class="post-date">1 May 2025</span>
                                </div>
                                <div class="post">
                                    <figure class="post-thumb"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/post-2.jpg') }}" alt=""></a></figure>
                                    <h6><a href="{{ route('blogDetails') }}">Explore the concept of personal branding</a></h6>
                                    <span class="post-date">1 May 2025</span>
                                </div>
                                <div class="post">
                                    <figure class="post-thumb"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/post-3.jpg') }}" alt=""></a></figure>
                                    <h6><a href="{{ route('blogDetails') }}">Use relevant keywords to improve</a></h6>
                                    <span class="post-date">1 May 2025</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget tags-widget mb_45">
                            <div class="widget-title mb_20">
                                <h3>Popular tag</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="tags-list clearfix">
                                    <li><a href="{{ route('blogDetails') }}">Account</a></li>
                                    <li><a href="{{ route('blogDetails') }}">Careers</a></li>
                                    <li><a href="{{ route('blogDetails') }}">Demo</a></li>
                                    <li><a href="{{ route('blogDetails') }}">Development</a></li>
                                    <li><a href="{{ route('blogDetails') }}">Technology</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget archives-widget">
                            <div class="widget-title mb_11">
                                <h3>Archives</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="archives-list clearfix">
                                    <li><a href="{{ route('blogDetails') }}"><i class="fal fa-angle-right"></i>December 20, 2022<span>(09)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}"><i class="fal fa-angle-right"></i>December 26, 2022<span>(20)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}"><i class="fal fa-angle-right"></i>December 26, 2022<span>(25)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}"><i class="fal fa-angle-right"></i>December 26, 2022<span>(06)</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="download-widget mr_40">
                        <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-24.png') }}')"></div>
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/resource/book-3.png') }}" alt=""></figure>
                            <h4>The 2025 guide for Optimal Content <span>Management</span></h4>
                            <button type="button" class="theme-btn btn-one">Download E-book</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-grid-content">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-4.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-4.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Business</span>
                                            <h3><a href="{{ route('blogDetails') }}">Create a series of blog posts discussing common interview</a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">Alex Beniwal</a></li>
                                                <li><span>March 20, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-5.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-5.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Analytics</span>
                                            <h3><a href="{{ route('blogDetails') }}">Explore the concept of personal branding and its impact on</a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">Stefen De</a></li>
                                                <li><span>March 19, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-7.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-7.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Technology</span>
                                            <h3><a href="{{ route('blogDetails') }}">Share stories of employees who have advanced within the</a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">Ema malwar</a></li>
                                                <li><span>March 18, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-8.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-8.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Development</span>
                                            <h3><a href="{{ route('blogDetails') }}">Provide guidance on crafting effective resumes and cover</a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">John Rock</a></li>
                                                <li><span>March 17, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-9.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-9.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Remote</span>
                                            <h3><a href="{{ route('blogDetails') }}">Detail any internship or graduate programs you offer</a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">Caly Andrs</a></li>
                                                <li><span>March 16, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-10.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-10.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Analytics</span>
                                            <h3><a href="{{ route('blogDetails') }}">Use relevant keywords to improve the blog’s visibility in</a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">Tom Rose</a></li>
                                                <li><span>March 15, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-11.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-11.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Remote</span>
                                            <h3><a href="{{ route('blogDetails') }}">Explore the concept of personal branding and its impact on</a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">Jhon Haris</a></li>
                                                <li><span>March 14, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-12.jpg') }}" alt=""></a></figure>
                                            <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-12.jpg') }}" alt=""></a></figure>
                                        </div>
                                        <div class="lower-content">
                                            <span class="category">Analytics</span>
                                            <h3><a href="{{ route('blogDetails') }}">Share stories of employees who have advanced within the </a></h3>
                                            <ul class="post-info">
                                                <li>By <a href="{{ route('blogDetails') }}">Alex Bolt</a></li>
                                                <li><span>March 13, 2023</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination-wrapper">
                            <ul class="pagination clearfix">
                                <li><a href="{{ route('blog') }}"><i class="icon-34"></i></a></li>
                                <li><a href="{{ route('blog') }}" class="current">1</a></li>
                                <li><a href="{{ route('blog') }}">2</a></li>
                                <li><a href="{{ route('blog') }}">3</a></li>
                                <li><a href="{{ route('blog') }}"><i class="icon-35"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->

@endsection


