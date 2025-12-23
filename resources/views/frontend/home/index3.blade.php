@extends('layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/banner.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/chooseus.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/clients.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/category.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/industries.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/process.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/welcome.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/faq.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/download.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/news.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/apps.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $breadcrumb ='false';
    $footer ='false';
    $subscribeStyleTwo ='false';            
@endphp

@section('content')

        <!-- banner-section -->
        <section class="banner-section banner-style-three p_relative">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-10.png') }}')"></div>
            <div class="shape">
                <div class="shape-1" style="background-image: url('{{ asset('assets/images/shape/shape-11.png') }}')"></div>
                <div class="shape-2" style="background-image: url('{{ asset('assets/images/shape/shape-12.png') }}')"></div>
                <div class="shape-3" style="background-image: url('{{ asset('assets/images/shape/shape-13.png') }}')"></div>
            </div>
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box">
                            <h2>Discover Your Next Career Move with <span>JobAway</span></h2>
                            <p>Implementing a robust employee referral program can be a creative and effective way to recruit at scale.</p>
                            <div class="btn-box">
                                <a href="{{ route('home') }}" class="theme-btn btn-one mr_20"><span>Find Works</span></a>
                                <a href="{{ route('home') }}" class="theme-btn banner-btn">Hire Talents Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-inner">
                            <div class="icon-logo"><img src="{{ asset('assets/images/icons/logo-icon-1.png') }}" alt=""></div>
                            <div class="image-box mr_15">
                                <figure class="image image-1 mb_15"><img src="{{ asset('assets/images/banner/banner-img-1.jpg') }}" alt=""></figure>
                                <figure class="image image-2"><img src="{{ asset('assets/images/banner/banner-img-2.jpg') }}" alt=""></figure>
                            </div>
                            <div class="image-box pt_55">
                                <figure class="image image-3 mb_15"><img src="{{ asset('assets/images/banner/banner-img-3.jpg') }}" alt=""></figure>
                                <figure class="image image-4"><img src="{{ asset('assets/images/banner/banner-img-4.jpg') }}" alt=""></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner-section end -->

        <!-- chooseus-style-two -->
        <section class="chooseus-style-two pt_40 pb_40 centred">
            <div class="auto-container">
                <div class="sec-title pb_20 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Why Us</span>
                    <h2 class="title-animation">Why Choose Us</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-4"></i></div>
                                <h3><a href="{{ route('home') }}">Retain Top Talent</a></h3>
                                <p>Providing clear career paths and growth opportunities is key to retaining top talent.</p>
                                <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-5"></i></div>
                                <h3><a href="{{ route('home') }}">Stay Compliant</a></h3>
                                <p>Educate employees about compliance requirements through regular training</p>
                                <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-6"></i></div>
                                <h3><a href="{{ route('home') }}">Improve Employee</a></h3>
                                <p>Invest in employee training and development programs to enhance skills and knowledge.</p>
                                <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- chooseus-style-two end -->

        <!-- clients-section -->
        <section class="clients-section home-3">
            <div class="bg-color"></div>
            <div class="auto-container">
                <div class="inner-container">
                    <div class="clients-box">
                        <figure class="clients-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-1.png') }}" alt=""></a></figure>
                        <figure class="overlay-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-1.png') }}" alt=""></a></figure>
                    </div>
                    <div class="clients-box">
                        <figure class="clients-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-2.png') }}" alt=""></a></figure>
                        <figure class="overlay-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-2.png') }}" alt=""></a></figure>
                    </div>
                    <div class="clients-box">
                        <figure class="clients-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-3.png') }}" alt=""></a></figure>
                        <figure class="overlay-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-3.png') }}" alt=""></a></figure>
                    </div>
                    <div class="clients-box">
                        <figure class="clients-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-4.png') }}" alt=""></a></figure>
                        <figure class="overlay-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-4.png') }}" alt=""></a></figure>
                    </div>
                    <div class="clients-box">
                        <figure class="clients-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-5.png') }}" alt=""></a></figure>
                        <figure class="overlay-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/clients/clients-5.png') }}" alt=""></a></figure>
                    </div>
                </div>
            </div>
        </section>
        <!-- clients-section end -->

        <!-- about-style-three -->
        <section class="about-style-three">
            <div class="pattern-layer">
                <div class="pattern-1"></div>
                <div class="pattern-2"></div>
            </div>
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 video-column">
                        <div class="video_block_two">
                            <div class="video-box p_relative pb_100 pr_150 mr_30">
                                <figure class="image image-1"><img src="{{ asset('assets/images/resource/about-1.jpg') }}" alt=""></figure>
                                <figure class="image image-2 z_1 p_absolute r_0 b_0"><img src="{{ asset('assets/images/resource/about-2.jpg') }}" alt=""></figure>
                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-14.png') }}')"></div>
                                <div class="video-content">
                                    <div class="curve-text z_2">
                                        <span class="curved-circle">watch&nbsp;&nbsp;the&nbsp;&nbsp;video&nbsp;&nbsp;right&nbsp;&nbsp;now&nbsp;&nbsp;</span>
                                    </div>
                                    <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_one">
                            <div class="content-box mr_80">
                                <div class="sec-title light pb_20 sec-title-animation animation-style2">
                                    <span class="sub-title mb_10 title-animation">About us</span>
                                    <h2 class="title-animation">Exploring the benefits of diversity and inclusion</h2>
                                </div>
                                <div class="text-box">
                                    <p>Moreover embracing diversity and inclusion can enhance employee engagement and morale. They are more likely</p>
                                    <ul class="list-style-one mb_40 clearfix">
                                        <li>Inclusive teams consider a wider range of viewpoints</li>
                                        <li>Demonstrating a commitment to diversity and inclusion enhances</li>
                                        <li>Embracing diversity aligns with legal and ethical standards</li>
                                    </ul>
                                </div>
                                <div class="btn-box"><a href="{{ route('about') }}" class="theme-btn btn-one"><span>Find Works</span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-style-three end -->

        <!-- category-section -->
        <section class="category-section home-3 centred pt_120 pb_0">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 category-block">
                        <div class="category-block-one">
                            <div class="inner-box">
                                <h2>For Local Workers</h2>
                                <p>Join over 1 million workers who use GravyWork to <br />find flexible and temp to hire</p>
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">Find Work</a>
                                <figure class="image-box image-hov-one"><img src="{{ asset('assets/images/resource/category-1.jpg') }}" alt=""></figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 category-block">
                        <div class="category-block-one">
                            <div class="inner-box">
                                <h2>For Business Owner</h2>
                                <p>Finding individuals who share your company's values and <br />vision can contribute to a cohesive</p>
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">Find Employee</a>
                                <figure class="image-box image-hov-two"><img src="{{ asset('assets/images/resource/category-2.jpg') }}" alt=""></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- category-section end -->

        <!-- download-section -->
        <section class="download-section alternat-2 pb_120">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-6.png') }}')"></div>
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                            <div class="content-box">
                                <h2>The 2025 guide for Optimal Content <span>Management</span></h2>
                                <ul class="list-item mb_30">
                                    <li>Start by explaining the fundamental concepts of talent acquisition.</li>
                                    <li> Provide guidance on crafting clear and compelling job descriptions that accurately reflect.</li>
                                    <li>Practical tips for conducting effective interviews, including types of interview questions interview formats.</li>
                                </ul>
                                <button type="button" class="theme-btn btn-one">Download E-book</button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 image-column">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/resource/book-1.png') }}" alt=""></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- download-section end -->

        <!-- industries-style-three -->
        <section class="industries-style-three centred pt_120 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-15.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title light pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Industries</span>
                    <h2 class="title-animation">Industries Served</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-9"></i></div>
                                <h3><a href="{{ route('home') }}">Hotel</a></h3>
                                <p>2853 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-10"></i></div>
                                <h3><a href="{{ route('home') }}">Hospitality</a></h3>
                                <p>2256 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-11"></i></div>
                                <h3><a href="{{ route('home') }}">Kitchen</a></h3>
                                <p>1408 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-12"></i></div>
                                <h3><a href="{{ route('home') }}">Retail</a></h3>
                                <p>1740 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-13"></i></div>
                                <h3><a href="{{ route('home') }}">Events</a></h3>
                                <p>3948 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-14"></i></div>
                                <h3><a href="{{ route('home') }}">Labor</a></h3>
                                <p>2984 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-15"></i></div>
                                <h3><a href="{{ route('home') }}">Driving</a></h3>
                                <p>4509 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-three">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-16"></i></div>
                                <h3><a href="{{ route('home') }}">Caretaker</a></h3>
                                <p>1039 Staffs</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="more-btn"><a href="{{ route('index3') }}" class="theme-btn btn-one">View All Categories</a></div>
            </div>
        </section>
        <!-- industries-style-three end -->

        <!-- welcome-section -->
        <section class="welcome-section pt_120 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-16.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Welcome to JobAway</span>
                    <h2 class="title-animation">Modern Day Staffing Agency</h2>
                </div>
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><i class="far fa-user"></i>For Talents</li>
                        <li class="tab-btn" data-tab="#tab-2"><i class="far fa-briefcase"></i>For Business</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-container">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                        <div class="content-box">
                                            <div class="text-box mb_40">
                                                <h2>An Award Winning Hiring Agency for <span>12 years</span></h2>
                                                <p>Voted the fastest solution to implement the easiest to administer your employee & business.</p>
                                            </div>
                                            <div class="inner-box clearfix">
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-29"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Easiest Admin</a></h3>
                                                    <span>Fall 2023</span>
                                                </div>
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-30"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Users love Us</a></h3>
                                                    <span>Winter 2023</span>
                                                </div>
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-31"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Leader</a></h3>
                                                    <span>Winter 2023</span>
                                                </div>
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-32"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Best support</a></h3>
                                                    <span>Winter 2023</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                        <div class="image_block_one">
                                            <div class="image-box pl_65">
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                                        <div class="single-item">
                                                            <figure class="image-1 mb_16 image-hov-one"><img src="{{ asset('assets/images/resource/welcome-1.jpg') }}" alt=""></figure>
                                                            <div class="experience-box">
                                                                <h3>12</h3>
                                                                <h4>Year of Experience</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                                        <div class="single-item">
                                                            <div class="support-box">
                                                                <div class="icon-box"><i class="icon-28"></i></div>
                                                                <span>Online Support</span>
                                                                <h4><a href="tel:912556889">+912 (556) 889</a></h4>
                                                            </div>
                                                            <figure class="image-2 mt_16 image-hov-two"><img src="{{ asset('assets/images/resource/welcome-2.jpg') }}" alt=""></figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-container">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                        <div class="content-box">
                                            <div class="text-box mb_40">
                                                <h2>An Award Winning Hiring Agency for <span>12 years</span></h2>
                                                <p>Voted the fastest solution to implement the easiest to administer your employee & business.</p>
                                            </div>
                                            <div class="inner-box clearfix">
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-29"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Easiest Admin</a></h3>
                                                    <span>Fall 2023</span>
                                                </div>
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-30"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Users love Us</a></h3>
                                                    <span>Winter 2023</span>
                                                </div>
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-31"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Leader</a></h3>
                                                    <span>Winter 2023</span>
                                                </div>
                                                <div class="single-item">
                                                    <div class="icon-box"><i class="icon-32"></i></div>
                                                    <h3><a href="{{ route('jobDetails') }}">Best support</a></h3>
                                                    <span>Winter 2023</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                        <div class="image_block_one">
                                            <div class="image-box pl_65">
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                                        <div class="single-item">
                                                            <figure class="image-1 mb_16 image-hov-one"><img src="{{ asset('assets/images/resource/welcome-1.jpg') }}" alt=""></figure>
                                                            <div class="experience-box">
                                                                <h3>12</h3>
                                                                <h4>Year of Experience</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                                        <div class="single-item">
                                                            <div class="support-box">
                                                                <div class="icon-box"><i class="icon-28"></i></div>
                                                                <span>Online Support</span>
                                                                <h4><a href="tel:912556889">+912 (556) 889</a></h4>
                                                            </div>
                                                            <figure class="image-2 mt_16 image-hov-two"><img src="{{ asset('assets/images/resource/welcome-2.jpg') }}" alt=""></figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- welcome-section -->

        <div class="slide-text alternat-2">
            <div class="text-inner">
                <ul class="text-list">
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                    <li>Warehouse</li>
                    <li>Hospitality</li>
                    <li>Manufacturing</li>
                    <li>Special Events</li>
                    <li>General Labor</li>
                </ul>
            </div>
        </div>

        <!-- testimonial-style-two -->
        <section class="testimonial-style-two pt_120 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-17.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Testimonials</span>
                    <h2 class="title-animation">Love From Users</h2>
                </div>
                <div class="two-item-carousel owl-carousel owl-theme owl-nav-none">
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt=""></figure>
                                <h4>Evan Clement</h4>
                                <span class="designation">HR Assistant, NFL</span>
                            </div>
                            <p>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage and ensured that I had all the information I needed to succeed.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-3.png') }}" alt=""></figure>
                                <h4>Maharan Depaak</h4>
                                <span class="designation">CEO, Amaban</span>
                            </div>
                            <p>Recently I went through their recruitment process with Jobaway Company, and I was impressed by how the smooth and efficient these were.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt=""></figure>
                                <h4>Evan Clement</h4>
                                <span class="designation">HR Assistant, NFL</span>
                            </div>
                            <p>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage and ensured that I had all the information I needed to succeed.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-3.png') }}" alt=""></figure>
                                <h4>Maharan Depaak</h4>
                                <span class="designation">CEO, Amaban</span>
                            </div>
                            <p>Recently I went through their recruitment process with Jobaway Company, and I was impressed by how the smooth and efficient these were.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt=""></figure>
                                <h4>Evan Clement</h4>
                                <span class="designation">HR Assistant, NFL</span>
                            </div>
                            <p>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage and ensured that I had all the information I needed to succeed.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-3.png') }}" alt=""></figure>
                                <h4>Maharan Depaak</h4>
                                <span class="designation">CEO, Amaban</span>
                            </div>
                            <p>Recently I went through their recruitment process with Jobaway Company, and I was impressed by how the smooth and efficient these were.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-style-two end -->

        <!-- dueal-section -->
        <section class="dueal-section p_relative alternat-2 pt_120 pb_120">
            <div class="bg-color"></div>
            <div class="shape">
                <div class="shape-1"></div>
                <div class="shape-2"></div>
                <div class="shape-3"></div>
                <div class="shape-4"></div>
            </div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_three">
                            <div class="content-box mr_150">
                                <div class="sec-title pb_30 sec-title-animation animation-style2">
                                    <span class="sub-title mb_10 title-animation">General Faqs</span>
                                    <h2 class="title-animation">Frequently Asked Questions</h2>
                                </div>
                                <ul class="accordion-box">
                                    <li class="accordion block active-block">
                                        <div class="acc-btn active">
                                            <div class="icon-box"><i class="icon-21"></i></div>
                                            <h4>How Can I Prepare for an Interview?</h4>
                                        </div>
                                        <div class="acc-content current">
                                            <div class="content">
                                                <p>To prepare for an interview, research the company, understand the job role and responsibilities, and prepare questions to ask the interviewer.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion block">
                                        <div class="acc-btn">
                                            <div class="icon-box"><i class="icon-21"></i></div>
                                            <h4>Hiring Managers and Candidates?</h4>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content">
                                                <p>To prepare for an interview, research the company, understand the job role and responsibilities, and prepare questions to ask the interviewer.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion block">
                                        <div class="acc-btn">
                                            <div class="icon-box"><i class="icon-21"></i></div>
                                            <h4>Clarifying Recruitment Concepts?</h4>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content">
                                                <p>To prepare for an interview, research the company, understand the job role and responsibilities, and prepare questions to ask the interviewer.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="accordion block">
                                        <div class="acc-btn">
                                            <div class="icon-box"><i class="icon-21"></i></div>
                                            <h4>Employers look for in candidates?</h4>
                                        </div>
                                        <div class="acc-content">
                                            <div class="content">
                                                <p>To prepare for an interview, research the company, understand the job role and responsibilities, and prepare questions to ask the interviewer.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_two">
                            <div class="content-box ml_100">
                                <div class="sec-title light pb_35 sec-title-animation animation-style2">
                                    <span class="sub-title mb_10 title-animation">The Process</span>
                                    <h2 class="title-animation">How it Works</h2>
                                </div>
                                <div class="inner-box">
                                    <div class="single-item">
                                        <span class="count-text">1</span>
                                        <h3><a href="{{ route('index2') }}">Sign up, It's Free!</a></h3>
                                        <p>Our team will set up your account and help you build job to  easy-to-use web dashboard.</p>
                                    </div>
                                    <div class="single-item">
                                        <span class="count-text">2</span>
                                        <h3><a href="{{ route('index2') }}">Find best Deals and Invest</a></h3>
                                        <p>Create and post anywhere from 1-100 job openings with just a few clicks. customize your own.</p>
                                    </div>
                                    <div class="single-item">
                                        <span class="count-text">3</span>
                                        <h3><a href="{{ route('index2') }}">Get you profit back</a></h3>
                                        <p>View bios, reviews, and rosters before workers arrive on the job, and post reviews and pay, effortlessly.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- dueal-section end -->

        <!-- news-section -->
        <section class="news-section pt_120 pb_90">
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Media</span>
                    <h2 class="title-animation">Latest News</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-4.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-4.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('index2') }}">Create a series of blog posts discussing common interview</a></h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Alex Beniwal</a></li>
                                        <li><span>March 20, 2023</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-5.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-5.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Analytics</span>
                                    <h3><a href="{{ route('index2') }}">Explore the concept of personal branding and its impact on</a></h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Alex Beniwal</a></li>
                                        <li><span>March 19, 2023</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-6.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-6.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('index2') }}">Feature interviews with employees from top companies</a></h3>
                                    <ul class="post-info">
                                        <li>By <a href="{{ route('blogDetails') }}">Alex Beniwal</a></li>
                                        <li><span>March 18, 2023</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- news-section end -->

        <!-- apps-section -->
        <section class="apps-section pt_120 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-18.png') }}')"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_four">
                            <div class="content-box">
                                <div class="sec-title light pb_40 sec-title-animation animation-style2">
                                    <span class="sub-title mb_10 title-animation">Download APp</span>
                                    <h2 class="title-animation">Download Our App</h2>
                                    <p class="title-animation">We use cookies to understand how you use our website and to give you the best possible experience. </p>
                                </div>
                                <div class="download-btn">
                                    <a href="{{ route('about') }}" class="apple-store">
                                        <img src="{{ asset('assets/images/icons/icon-12.png') }}" alt="">
                                        <span>Download on</span>
                                        App Store
                                    </a>
                                    <a href="{{ route('about') }}" class="play-store">
                                        <img src="{{ asset('assets/images/icons/icon-5.png') }}" alt="">
                                        <span>Get it on</span>
                                        Google Play
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map-content">
                <div class="map-inner">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55945.16225505631!2d-73.90847969206546!3d40.66490264739892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1601263396347!5m2!1sen!2sbd" width="100%" height="500" frameborder="0" style="border:0; width: 100%" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="map-author">
                    <figure class="author-thumb"><img src="{{ asset('assets/images/resource/author-7.png') }}" alt=""></figure>
                    <h6>Fayde Carinaste</h6>
                    <span class="rating-box"><img src="{{ asset('assets/images/icons/icon-13.png') }}" alt=""> 4.96 out of 5</span>
                    <p>Event Server, Bartender, event Set Up</p>
                </div>
            </div>
        </section>
        <!-- apps-section end -->

        <!-- main-footer -->
        <footer class="main-footer light-footer">
            <div class="widget-section p_relative pt_80 pb_100">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget mr_30">
                                <figure class="footer-logo mb_20"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-2.png') }}" alt=""></a></figure>
                                <p>Since 2018, JobAway has connecting hospitality workers to thousands of business, private events and universities.</p>
                                <ul class="social-links">
                                    <li><a href="{{ route('home') }}"><i class="icon-22"></i></a></li>
                                    <li><a href="{{ route('home') }}"><i class="icon-23"></i></a></li>
                                    <li><a href="{{ route('home') }}"><i class="icon-24"></i></a></li>
                                    <li><a href="{{ route('home') }}"><i class="icon-25"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>For Workers</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('home') }}">Find Work</a></li>
                                        <li><a href="{{ route('home') }}">Jobs in Dubai</a></li>
                                        <li><a href="{{ route('home') }}">Jobs in Virginia</a></li>
                                        <li><a href="{{ route('home') }}">Jobs in California</a></li>
                                        <li><a href="{{ route('home') }}">Jobs in Alaska</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>For Business</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('home') }}">Merchandising</a></li>
                                        <li><a href="{{ route('home') }}">Hospitality Staff</a></li>
                                        <li><a href="{{ route('home') }}">General Labour</a></li>
                                        <li><a href="{{ route('home') }}">Car Drivers</a></li>
                                        <li><a href="{{ route('home') }}">Bus Driver</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>Company</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('home') }}">Career</a></li>
                                        <li><a href="{{ route('home') }}">Partners</a></li>
                                        <li><a href="{{ route('blog') }}">Blog</a></li>
                                        <li><a href="{{ route('home') }}">Clients</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>Help & Support</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                        <li><a href="{{ route('faq') }}">General FAQ</a></li>
                                        <li><a href="{{ route('home') }}">Support Center</a></li>
                                        <li><a href="{{ route('home') }}">Privacy Policy</a></li>
                                        <li><a href="{{ route('home') }}">Terms & Conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="bottom-inner">
                        <div class="copyright"><p>Copyright &copy; 2025 <a href="{{ route('home') }}">JobAway</a> All rights reserved.</p></div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->

@endsection


