@extends('layouts.layout')

@php
    $title='Blog Standard';
    $subTitle='Blog Standard';
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/news.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/blog-sidebar.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/blog-details.css') . '" rel="stylesheet">
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
                                <form method="post" action="#">
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
                                    <li><a href="{{ route('blogDetails') }}">Day Trading<span>(09)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}">Finance<span>(20)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}">Virtual Hiring<span>(25)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}">Headhunting<span>(06)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}">Promotions<span>(18)</span></a></li>
                                    <li><a href="{{ route('blogDetails') }}">Recruitment Agencies<span>(11)</span></a></li>
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
                    <div class="blog-standard-content">
                        <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-13.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-13.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('blogDetails') }}">Create a series of blog posts discussing common interview Discuss the company’s core values</a></h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Alex Beniwal</a></li>
                                        <li><span>March 20, 2023</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-14.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-14.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('blogDetails') }}">Use relevant keywords to improve the blog’s visibility in hare stories of employees who have advanced within</a></h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Haris Gulati</a></li>
                                        <li><span>March 19, 2023</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-15.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-15.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('blogDetails') }}">Provide guidance on crafting effective resumes and cover detailing responsibilities and expectations.</a></h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Ema Chawal</a></li>
                                        <li><span>March 18, 2023</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-16.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-16.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('blogDetails') }}">Share stories of employees who have advanced within the and cover detailing responsibilities and expectations.</a></h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Dorin Baby</a></li>
                                        <li><span>March 17, 2023</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pagination-wrapper">
                            <ul class="pagination clearfix">
                                <li><a href="#"><i class="icon-34"></i></a></li>
                                <li><a href="#" class="current">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="icon-35"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->

@endsection

