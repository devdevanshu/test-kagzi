<!DOCTYPE html>
<html lang="en">

    @include('components.head')

    @php
        $css ='<link href="' . asset('assets/css/module-css/banner.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/industries.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/chooseus.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/profile.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/featured.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/process.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/welcome.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/funfact.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/news.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
               <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';

        $script  ='<script src="' . asset('assets/js/bxslider.js') . '"></script>';
    @endphp
    @include('components.head')

<!-- page wrapper -->
<body>

    <div class="boxed_wrapper ltr">

        <!-- preloader -->
        @include('components.preloader')
        <!-- preloader end -->

        <!-- page-direction -->
        @include('components.pageDirection')
        <!-- page-direction end -->

        <!--Search Popup-->
        @include('components.searchPopup')

        <!-- main header -->
        <header class="main-header header-style-five">
            <!-- header-top -->
            <div class="header-top">
                <div class="outer-container">
                    <div class="top-inner">
                        <ul class="info">
                            <li>
                                <img src="{{ asset('assets/images/icons/icon-6.png') }}" alt="">
                                Call: <a href="tel:912345432">+91 (234) 5432</a>
                            </li>
                            <li>
                                <img src="{{ asset('assets/images/icons/icon-7.png') }}" alt="">
                                Mail: <a href="mailto:jobinfo@example.com">jobinfo@example.com</a>
                            </li>
                        </ul>
                        <p><span>Latest News:</span> Fusce neque CEO egestas cursu magna sapien</p>
                        <div class="right-column">
                            <div class="language-picker js-language-picker mr_30" data-trigger-class="btn btn--subtle">
                                <form action="{{ route('index2') }}" class="language-picker__form">
                                    <label for="language-picker-select">Select your language</label>
                                    <select name="language-picker-select" id="language-picker-select">
                                        <option lang="de" value="deutsch">DE</option>
                                        <option lang="en" value="english" selected>EN</option>
                                        <option lang="fr" value="francais">FR</option>
                                        <option lang="it" value="italiano">IT</option>
                                    </select>
                                </form>
                            </div>
                            <ul class="social-links">
                                <li><span>Share:</span></li>
                                <li><a href="{{ route('index2') }}"><i class="icon-22"></i></a></li>
                                <li><a href="{{ route('index2') }}"><i class="icon-23"></i></a></li>
                                <li><a href="{{ route('index2') }}"><i class="icon-24"></i></a></li>
                                <li><a href="{{ route('index2') }}"><i class="icon-25"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-container">
                    <div class="outer-box">
                        <figure class="logo-box"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a></figure>
                        <div class="menu-area">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light clearfix">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="current dropdown"><a href="{{ route('home') }}">Home</a>
                                            <ul>
                                                <li><a href="{{ route('home') }}">Home One</a></li>
                                                <li><a href="{{ route('index2') }}">Home Two</a></li>
                                                <li><a href="{{ route('index3') }}">Home Three</a></li>
                                                <li><a href="{{ route('index4') }}">Home Four</a></li>
                                                <li><a href="{{ route('index5') }}">Home Five</a></li>
                                            </ul>
                                        </li> 
                                        <li><a href="{{ route('about') }}">About</a></li>
                                        <li class="dropdown"><a href="{{ route('home') }}">Solutions</a>
                                            <ul>
                                                <li><a href="{{ route('service') }}">Our Solutions</a></li>
                                                <li><a href="{{ route('serviceDetails') }}">Executive Search</a></li>
                                                <li><a href="{{ route('serviceDetails2') }}">Training Session</a></li>
                                                <li><a href="{{ route('serviceDetails3') }}">Career Growth</a></li>
                                                <li><a href="{{ route('serviceDetails4') }}">Payroll Services</a></li>
                                                <li><a href="{{ route('serviceDetails5') }}">Workforce System</a></li>
                                                <li><a href="{{ route('serviceDetails6') }}">Temporary Jobs</a></li>
                                            </ul>
                                        </li> 
                                        <li class="dropdown"><a href="{{ route('home') }}">Pages</a>
                                            <ul>
                                                <li class="dropdown"><a href="{{ route('home') }}">Job</a>
                                                    <ul>
                                                        <li><a href="{{ route('job') }}">Place Job</a></li>
                                                        <li><a href="{{ route('job2') }}">Job Seekers</a></li>
                                                        <li><a href="{{ route('job3') }}">Job Openings</a></li>
                                                        <li><a href="{{ route('job4') }}">Job Apply</a></li>
                                                        <li><a href="{{ route('jobDetails') }}">Job Details</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown"><a href="{{ route('home') }}">Portfolio</a>
                                                    <ul>
                                                        <li><a href="{{ route('portfolio') }}">Portfolio 3 column</a></li>
                                                        <li><a href="{{ route('portfolio2') }}">Portfolio 2 column</a></li>
                                                        <li><a href="{{ route('portfolio3') }}">Portfolio Masonry</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ route('team') }}">Our Team</a></li>
                                                <li><a href="{{ route('faq') }}">FAQ's</a></li>
                                                <li><a href="{{ route('testimonial') }}">Testimonials</a></li>
                                                <li><a href="{{ route('login') }}">Login</a></li>
                                                <li><a href="{{ route('signup') }}">Sing Up</a></li>
                                                <li><a href="{{ route('pageError') }}">404</a></li>
                                            </ul>
                                        </li> 
                                        <li class="dropdown"><a href="{{ route('home') }}">Blog</a>
                                            <ul>
                                                <li><a href="{{ route('blog') }}">Blog Grid</a></li>
                                                <li><a href="{{ route('blog2') }}">Blog Standard</a></li>
                                                <li><a href="{{ route('blogDetails') }}">Blog Details</a></li>
                                            </ul>
                                        </li>  
                                        <li><a href="{{ route('contact') }}">Contact</a></li> 
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-right-content">
                            <div class="search-btn mr_20"><button class="search-toggler"><i class="icon-1"></i></button></div>
                            <div class="link-box mr_20"><a href="{{ route('login') }}">Log In</a></div>
                            <div class="btn-box"><a href="{{ route('signup') }}" class="theme-btn btn-one">Appointment</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="outer-container">
                    <div class="outer-box">
                        <figure class="logo-box"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a></figure>
                        <div class="menu-area">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="menu-right-content">
                            <div class="search-btn mr_20"><button class="search-toggler"><i class="icon-1"></i></button></div>
                            <div class="link-box mr_20"><a href="{{ route('login') }}">Log In</a></div>
                            <div class="btn-box"><a href="{{ route('signup') }}" class="theme-btn btn-one">Appointment</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        @include('components.mobileMenu')
        <!-- End Mobile Menu -->

        <!-- banner-section -->
        <section class="banner-style-five">
            <div class="outer-container clearfix">
                <div class="left-column">
                    <div class="bg-layer" style="background-image: url('{{ asset('assets/images/banner/banner-3.jpg') }}')"></div>
                    <div class="content-box">
                        <h2>I’m Looking for <span>Job</span></h2>
                        <p>Searching for a job can be both exciting and daunting, filled with anticipation and uncertainty.</p>
                        <a href="{{ route('jobDetails') }}" class="theme-btn banner-btn">Find a Job</a>
                    </div>
                </div>
                <div class="right-column align-3">
                    <div class="bg-layer" style="background-image: url('{{ asset('assets/images/banner/banner-4.jpg') }}')"></div>
                    <div class="content-box">
                        <h2>I am an <span>Employer</span></h2>
                        <p>I believe that the key to a successful business lies in valuing each team member's unique strengths.</p>
                        <a href="{{ route('jobDetails') }}" class="theme-btn banner-btn">Hire Talents</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner-section end -->

        <!-- industries-style-five -->
        <section class="industries-style-five centred pt_120 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-21.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Industries</span>
                    <h2 class="title-animation">Industries Served</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-1.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-1.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Hotel</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-2.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-2.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Hospitality</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-3.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-3.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Kitchen</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-4.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-4.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Retail</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-5.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-5.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Events</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-6.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-6.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Labor</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-7.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-7.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Driving</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-four">
                            <div class="inner-box">
                                <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/industries-8.jpg') }}')"></div>
                                <div class="overlay-bg" style="background-image: url('{{ asset('assets/images/resource/industries-8.jpg') }}')"></div>
                                <h4><a href="{{ route('index5') }}">Caretaker</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="more-btn mt_30"><a href="{{ route('index5') }}" class="theme-btn btn-one">View All Categories</a></div>
            </div>
        </section>
        <!-- industries-style-five end -->

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

        <!-- about-style-three -->
        <section class="about-style-three about-style-five">
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 video-column">
                        <div class="video_block_two">
                            <div class="video-box p_relative pb_100 pr_150 mr_30">
                                <figure class="image image-1"><img src="{{ asset('assets/images/resource/about-1.jpg') }}" alt=""></figure>
                                <figure class="image image-2 z_1 p_absolute r_0 b_0"><img src="{{ asset('assets/images/resource/about-2.jpg') }}" alt=""></figure>
                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-22.png') }}')"></div>
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
                                <div class="sec-title pb_20 sec-title-animation animation-style2">
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

        <!-- chooseus-style-three -->
        <section class="chooseus-style-three pt_120 pb_90">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-12 col-sm-12 title-column">
                        <div class="sec-title pb_60 sec-title-animation animation-style2">
                            <span class="sub-title mb_10 title-animation">Why Us</span>
                            <h2 class="title-animation">Why People Choose Us</h2>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12 content-column">
                        <div class="three-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-4"></i></div>
                                    <h3><a href="{{ route('home') }}">Stay Compliant</a></h3>
                                    <p>Educate employees about compliance requirements through regular training</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-5"></i></div>
                                    <h3><a href="{{ route('home') }}">Improve Employee</a></h3>
                                    <p>Invest in employee training and development programs to enhance skills and knowledge.</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-6"></i></div>
                                    <h3><a href="{{ route('home') }}">Great Support</a></h3>
                                    <p>We invest in the best to support your productivity and success.</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- chooseus-style-three end -->

        <!-- profile-section -->
        <section class="profile-section p_relative">
            <div class="auto-container">
                <div class="inner-container p_relative">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12 chat-column">
                            <div class="chat-content">
                                <div class="shape">
                                    <div class="shape-1"></div>
                                    <div class="shape-2"></div>
                                </div>
                                <div class="title-text centred p_relative mb_45">
                                    <h3><img src="{{ asset('assets/images/icons/icon-15.png') }}" alt="">Live Chat Support</h3>
                                </div>
                                <div class="chat-slide">
                                    <div class="single-item">
                                        <div class="image-box"><img src="{{ asset('assets/images/resource/author-8.png') }}" alt=""></div>
                                        <p>I’m available starting next week. I can answer any questions live.</p>
                                    </div>
                                    <div class="single-item">
                                        <div class="image-box"><img src="{{ asset('assets/images/icons/logo-icon-2.png') }}" alt=""></div>
                                        <p>How about we schedule a meeting for next Tuesday at 10 AM?</p>
                                    </div>
                                    <div class="single-item">
                                        <div class="image-box"><img src="{{ asset('assets/images/resource/author-9.png') }}" alt=""></div>
                                        <p>That works for me. Is there a specific agenda you have in mind?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 verified-column">
                            <div class="verified-content">
                                <div class="shape">
                                    <div class="shape-1"></div>
                                    <div class="shape-2"></div>
                                </div>
                                <div class="title-text centred p_relative mb_45">
                                    <h3><img src="{{ asset('assets/images/icons/icon-16.png') }}" alt="">Verified Profiles</h3>
                                </div>
                                <div class="image-box">
                                    <div class="bg-layer" style="background-image: url('{{ asset('assets/images/resource/profile-1.jpg') }}')"></div>
                                    <figure class="image"><img src="{{ asset('assets/images/resource/profile-2.jpg') }}" alt=""></figure>
                                    <span class="designation designation-1">Finance</span>
                                    <span class="designation designation-2">Nurse</span>
                                    <span class="designation designation-3">Assistant</span>
                                    <span class="designation designation-4">Cleaner</span>
                                </div>
                                <div class="lower-content centred">
                                    <div class="single-item">
                                        <h4>7 yrs</h4>
                                        <p>Experience</p>
                                    </div>
                                    <div class="single-item">
                                        <h4>4.61 <img src="{{ asset('assets/images/icons/icon-17.png') }}" alt=""></h4>
                                        <p>Rating</p>
                                    </div>
                                    <div class="single-item">
                                        <h4>7 <img src="{{ asset('assets/images/icons/icon-18.png') }}" alt=""></h4>
                                        <p>Favorites</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- profile-section end -->

        <!-- featured-section -->
        <section class="featured-section centred pt_110 pb_90">
            <div class="shape">
                <div class="shape-1"></div>
                <div class="shape-2"></div>
            </div>
            <div class="auto-container">
                <div class="title-text mb_60">
                    <h2>Trusted by Thousands of Users Across the World</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-19.png') }}" alt=""></div>
                                <h3>Getapp</h3>
                                <p>Top Recruitment Agency</p>
                                <ul class="rating">
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-21.png') }}" alt=""></div>
                                <h3>Capterra</h3>
                                <p>Best Agency for Job</p>
                                <ul class="rating">
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-22.png') }}" alt=""></div>
                                <h3>G2 Rating</h3>
                                <p>Best Job Software</p>
                                <ul class="rating">
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-23.png') }}" alt=""></div>
                                <h3>Trustpilot</h3>
                                <p>Most Loved by Users</p>
                                <ul class="rating">
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/icon-20.png') }}" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- featured-section end -->

        <!-- process-section -->
        <section class="process-section pt_120 pb_90">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Process</span>
                    <h2 class="title-animation">How It Works?</h2>
                </div>
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><i class="far fa-user"></i>For Talents</li>
                        <li class="tab-btn" data-tab="#tab-2"><i class="far fa-briefcase"></i>For Business</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                    <div class="processing-block-one">
                                        <div class="inner-box">
                                            <span class="count-text">1</span>
                                            <h3><a href="{{ route('home') }}">Sign up, It's Free!</a></h3>
                                            <p>Our team will set up your account and help you build job to  easy-to-use web dashboard.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                    <div class="processing-block-one">
                                        <div class="inner-box">
                                            <span class="count-text">2</span>
                                            <h3><a href="{{ route('home') }}">Post jobs in minutes</a></h3>
                                            <p>Create and post anywhere from 1-100 job openings with just a few clicks. customize your own.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                    <div class="processing-block-one">
                                        <div class="inner-box">
                                            <span class="count-text">3</span>
                                            <h3><a href="{{ route('home') }}">Review Your Staff</a></h3>
                                            <p>View bios, reviews, and rosters before workers arrive on the job, and post reviews and pay, effortlessly.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                    <div class="processing-block-one">
                                        <div class="inner-box">
                                            <span class="count-text">1</span>
                                            <h3><a href="{{ route('home') }}">Sign up, It's Free!</a></h3>
                                            <p>Our team will set up your account and help you build job to  easy-to-use web dashboard.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                    <div class="processing-block-one">
                                        <div class="inner-box">
                                            <span class="count-text">2</span>
                                            <h3><a href="{{ route('home') }}">Post jobs in minutes</a></h3>
                                            <p>Create and post anywhere from 1-100 job openings with just a few clicks. customize your own.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                    <div class="processing-block-one">
                                        <div class="inner-box">
                                            <span class="count-text">3</span>
                                            <h3><a href="{{ route('home') }}">Review Your Staff</a></h3>
                                            <p>View bios, reviews, and rosters before workers arrive on the job, and post reviews and pay, effortlessly.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- process-section -->

        <!-- welcome-section -->
        <section class="welcome-section alternat-2 pt_120 pb_120">
            <div class="shape">
                <div class="shape-1"></div>
                <div class="shape-2"></div>
            </div>
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Welcome to JobAway</span>
                    <h2 class="title-animation">Modern Day Staffing Agency</h2>
                </div>
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons">
                        <li class="tab-btn active-btn" data-tab="#tab-3"><i class="far fa-user"></i>For Talents</li>
                        <li class="tab-btn" data-tab="#tab-4"><i class="far fa-briefcase"></i>For Business</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-3">
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
                        <div class="tab" id="tab-4">
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

        <!-- funfact-section -->
        <section class="funfact-section alternat-2 centred pb_90">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="count-outer">
                                    <span class="odometer" data-count="12">00</span><span class="symble">k</span>
                                </div>
                                <p>Freelance Workers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="count-outer">
                                    <span class="odometer" data-count="95">00</span><span class="symble">%</span>
                                </div>
                                <p>Jobs Fulfillment Rate</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="count-outer">
                                    <span class="odometer" data-count="12">00</span><span class="symble">k+</span>
                                </div>
                                <p>Jobs Filled</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="count-outer">
                                    <span class="odometer" data-count="825">00</span><span class="symble">+</span>
                                </div>
                                <p>Satisfied Businesses</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- funfact-section end -->

        <!-- testimonial-style-three -->
        <section class="testimonial-style-three">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="shape">
                        <div class="shape-1"></div>
                        <div class="shape-2"></div>
                    </div>
                    <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                        <div class="testimonial-block">
                            <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-5.png') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="icon-box"><i class="icon-36"></i></div>
                                <h2>Company was impressed by the personal approach of their recruitment team for the improvement. They kept informed at every stage of the task.</h2>
                                <h3>Franklin Bailey</h3>
                                <span class="designation">CEO, JobAway</span>
                            </div>
                        </div>
                        <div class="testimonial-block">
                            <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-5.png') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="icon-box"><i class="icon-36"></i></div>
                                <h2>Company was impressed by the personal approach of their recruitment team for the improvement. They kept informed at every stage of the task.</h2>
                                <h3>Franklin Bailey</h3>
                                <span class="designation">CEO, JobAway</span>
                            </div>
                        </div>
                        <div class="testimonial-block">
                            <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-5.png') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="icon-box"><i class="icon-36"></i></div>
                                <h2>Company was impressed by the personal approach of their recruitment team for the improvement. They kept informed at every stage of the task.</h2>
                                <h3>Franklin Bailey</h3>
                                <span class="designation">CEO, JobAway</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-style-three end -->

        <!-- news-section -->
        <section class="news-section pt_120 pb_90">
            <div class="shape">
                <div class="shape-1"></div>
                <div class="shape-2"></div>
            </div>
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Media</span>
                    <h2 class="title-animation">Latest News</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-three wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-4.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-4.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('index2') }}">Create a series of blog posts discussing common interview</a></h3>
                                    <ul class="post-info">
                                        <li><i class="icon-37"></i>March 20, 2023</li>
                                        <li><i class="icon-38"></i><a href="{{ route('blogDetails') }}">Ralph Edwards</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-three wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-5.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-5.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Analytics</span>
                                    <h3><a href="{{ route('index2') }}">Explore the concept of personal branding and its impact on</a></h3>
                                    <ul class="post-info">
                                        <li><i class="icon-37"></i>March 19, 2023</li>
                                        <li><i class="icon-38"></i><a href="{{ route('blogDetails') }}">Theresa Webb</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-three wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-6.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('blogDetails') }}"><img src="{{ asset('assets/images/news/news-6.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <span class="category">Business</span>
                                    <h3><a href="{{ route('index2') }}">Feature interviews with employees from top companies</a></h3>
                                    <ul class="post-info">
                                        <li><i class="icon-37"></i>March 18, 2023</li>
                                        <li><i class="icon-38"></i><a href="{{ route('blogDetails') }}">Arlene McCoy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- news-section end -->

        <!-- subscribe-style-two -->
        <section class="subscribe-style-two">
            <div class="bg-color-2"></div>
            <div class="auto-container">
                <div class="inner-container">
                    <div class="shape-box">
                        <div class="shape-1" style="background-image: url('{{ asset('assets/images/shape/shape-8.png') }}')"></div>
                        <div class="shape-2" style="background-image: url('{{ asset('assets/images/shape/shape-9.png') }}')"></div>
                    </div>
                    <div class="text-box">
                        <h2>Subscribe for <span>latest update</span></h2>
                    </div>
                    <div class="form-inner">
                        <form method="post" action="{{ route('contact') }}">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email Address" required>
                                <button type="submit" class="theme-btn btn-one">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-style-two end -->

        <!-- main-footer -->
        <footer class="main-footer light-footer">
            <div class="widget-section p_relative pt_80 pb_100">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget mr_30">
                                <figure class="footer-logo mb_20"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-2.png') }}" alt=""></a></figure>
                                <p>Since 2018, JobAway has connecting hospitality workers to thousands of business, private events and universities.</p>
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
                                    <h4>Help &amp; Support</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                        <li><a href="{{ route('faq') }}">General FAQ</a></li>
                                        <li><a href="{{ route('home') }}">Support Center</a></li>
                                        <li><a href="{{ route('home') }}">Privacy Policy</a></li>
                                        <li><a href="{{ route('home') }}">Terms &amp; Conditions</a></li>
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
                        <ul class="social-links">
                            <li><h5>Follow Us On:</h5></li>
                            <li><a href="{{ route('home') }}"><i class="icon-22"></i></a></li>
                            <li><a href="{{ route('home') }}"><i class="icon-23"></i></a></li>
                            <li><a href="{{ route('home') }}"><i class="icon-24"></i></a></li>
                            <li><a href="{{ route('home') }}"><i class="icon-25"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->

        <!--Scroll to top-->
        @include('components.scroll')
        
    </div>

        @include('components.script')

</body><!-- End of .page_wrapper -->
</html>


