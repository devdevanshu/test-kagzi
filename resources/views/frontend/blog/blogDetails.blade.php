@extends('layouts.layout')

@php
    $title='Blog Details';
    $subTitle='Blog Details';
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
                    <div class="blog-details-content">
                        <div class="news-block-two">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/news/news-15.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3>Create a series of blog posts discussing common interview Discuss the company’s core values</h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Ema Chawal</a></li>
                                        <li><span>March 18, 2023</span></li>
                                    </ul>
                                </div>
                                <div class="text-box pt_25 mb_50">
                                    <p class="mb_30">Another post might tackle technical questions relevant to your industry, offering strategies for breaking down complex problems and showcasing problem-solving skills. By breaking down each type of question and offering practical advice, sample answers.</p>
                                    <p class="mb_40">tips for tailoring responses to align with the company's values and expectations, this blog series can become an essential resource for candidates aiming to succeed in their interviews and secure their desired positions.</p>
                                    <blockquote>
                                        <div class="icon-box"><i class="icon-36"></i></div>
                                        <h4>That's why we adhere to strict quality standards and regulations to ensure that all our products meet the highest levels of safety and efficacy.</h4>
                                        <h3>Hemandi Kaur</h3>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="two-column">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                    <figure class="image-box mb_25"><img src="{{ asset('assets/images/news/news-17.jpg') }}" alt=""></figure>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                    <figure class="image-box mb_25"><img src="{{ asset('assets/images/news/news-18.jpg') }}" alt=""></figure>
                                </div>
                            </div>
                        </div>
                        <div class="content-one mb_40">
                            <h3>Hiring & Onboarding Process</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing.</p>
                            <h4>Your Gateway to Hiring Success</h4>
                            <ul class="list-item clearfix">
                                <li>The wise man therefore always holds in these matters</li>
                                <li>Have to be repudiated and annoyances accepted.</li>
                                <li>Rejects pleasures to secure other greater pleasures, or else</li>
                            </ul>
                        </div>
                        <div class="post-share-option mb_60">
                            <ul class="tags-list">
                                <li><h6>Tags:</h6></li>
                                <li><a href="{{ route('blogDetails') }}">Careers</a></li>
                                <li><a href="{{ route('blogDetails') }}">Demo</a></li>
                            </ul>
                            <ul class="social-links"> 
                                <li><h6>Share This :</h6></li>
                                <li><a href="{{ route('blogDetails') }}"><i class="icon-22"></i></a></li>
                                <li><a href="{{ route('blogDetails') }}"><i class="icon-23"></i></a></li>
                                <li><a href="{{ route('blogDetails') }}"><i class="icon-24"></i></a></li>
                            </ul>
                        </div>
                        <div class="comment-box">
                            <div class="group-title mb_25"><h3>Write Comment</h3></div>
                            <div class="form-inner">
                                <form method="post" action="{{ route('blogDetails') }}">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                            <div class="form-group">
                                                <label>Name <span>*</span></label>
                                                <input type="text" name="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                            <div class="form-group">
                                                <label>Email <span>*</span></label>
                                                <input type="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 single-column">
                                            <div class="form-group">
                                                <label>Message <span>*</span></label>
                                                <textarea name="message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 single-column">
                                            <div class="check-box mb_35">
                                                <input class="check" type="checkbox" id="checkbox9">
                                                <label for="checkbox9">Save my name, email, and website in this browser for the next time I comment.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 single-column">
                                            <div class="message-btn">
                                                <button type="submit" class="theme-btn btn-one">Submit Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->

@endsection



