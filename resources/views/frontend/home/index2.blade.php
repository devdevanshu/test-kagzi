<!DOCTYPE html>
<html lang="en">

    @php
    $css = '<link href="' . asset('assets/css/module-css/banner.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/clients.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/chooseus.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/industries.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/process.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/faq.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/training.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/pricing.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/download.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/news.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
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
        <header class="main-header header-style-two">
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
                            <div class="btn-box"><a href="{{ route('home') }}" class="theme-btn btn-one">Get Started</a></div>
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
                            <div class="btn-box"><a href="{{ route('home') }}" class="theme-btn btn-one">Get Started</a></div>
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
        <section class="banner-section banner-style-two p_relative">
            <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-5.png') }}')"></div>
            <div class="pattern-layer-2" style="background-image: url('{{ asset('assets/images/shape/shape-4.png') }}')"></div>
            <div class="bg-layer" style="background-image: url('{{ asset('assets/images/banner/banner-1.jpg') }}')"></div>
            <div class="outer-container">
                <div class="content-box">
                    <h2>Creative to Hiring with <span>Thousands Workers</span></h2>
                    <p>Implementing a robust employee referral program can be a creative and effective way to recruit at scale.</p>
                    <div class="btn-box">
                        <a href="{{ route('home') }}" class="theme-btn btn-one mr_20"><span>Find Works</span></a>
                        <a href="{{ route('home') }}" class="theme-btn banner-btn">Hire Talents Now</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner-section end -->

        <!-- clients-style-two -->
        <section class="clients-style-two centred pt_110 pb_120">
            <div class="auto-container">
                <div class="title-text">
                    <h3>Trusted by the next-gen industry leaders</h3>
                </div>
                <div class="clients-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                    <figure class="clients-logo"><a href="{{ route('index2') }}"><img src="{{ asset('assets/images/clients/clients-6.png') }}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="{{ route('index2') }}"><img src="{{ asset('assets/images/clients/clients-7.png') }}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="{{ route('index2') }}"><img src="{{ asset('assets/images/clients/clients-8.png') }}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="{{ route('index2') }}"><img src="{{ asset('assets/images/clients/clients-9.png') }}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="{{ route('index2') }}"><img src="{{ asset('assets/images/clients/clients-10.png') }}" alt=""></a></figure>
                </div>
            </div>
        </section>
        <!-- clients-style-two end -->

        <!-- about-style-two -->
        <section class="about-style-two">
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_one">
                            <div class="content-box mr_80">
                                <div class="sec-title pb_20 sec-title-animation animation-style2">
                                    <span class="sub-title mb_10 title-animation">About us</span>
                                    <h2 class="title-animation">The Leading Hospitality Staffing <span>Platform</span></h2>
                                </div>
                                <div class="text-box">
                                    <p>This staffing platform provides access to a diverse pool of qualified candidates with specialized skills in areas such as hospitality management.</p>
                                    <ul class="list-style-one clearfix">
                                        <li>This helps businesses maintain service excellence</li>
                                        <li>This scalability allows businesses to adjust staffing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 video-column">
                        <div class="video_block_two">
                            <div class="video-box t_120 z_1 p_relative ml_40 mr_60 centred">
                                <div class="video-inner" style="background-image: url('{{ asset('assets/images/resource/video-4.jpg') }}')">
                                    <div class="video-content">
                                        <div class="curve-text">
                                            <span class="curved-circle">watch&nbsp;&nbsp;the&nbsp;&nbsp;video&nbsp;&nbsp;right&nbsp;&nbsp;now&nbsp;&nbsp;</span>
                                        </div>
                                        <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-style-two end -->

        <!-- chooseus-section -->
        <section class="chooseus-section alternat-2 pt_120 pb_90">
            <div class="auto-container">
                <div class="sec-title pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Why Us</span>
                    <h2 class="title-animation">Why Choose Us</h2>
                </div>
                <div class="inner-container">
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
            </div>
        </section>
        <!-- chooseus-section end -->

        <!-- industries-style-two -->
        <section class="industries-style-two pt_120 pb_90">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Industries</span>
                    <h2 class="title-animation">Industries Served</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-9"></i></div>
                                <h3><a href="{{ route('home') }}">Hotel</a></h3>
                                <p>2853 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-10"></i></div>
                                <h3><a href="{{ route('home') }}">Hospitality</a></h3>
                                <p>2256 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-11"></i></div>
                                <h3><a href="{{ route('home') }}">Kitchen</a></h3>
                                <p>1408 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-12"></i></div>
                                <h3><a href="{{ route('home') }}">Retail</a></h3>
                                <p>1740 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-13"></i></div>
                                <h3><a href="{{ route('home') }}">Events</a></h3>
                                <p>3948 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-14"></i></div>
                                <h3><a href="{{ route('home') }}">Labor</a></h3>
                                <p>2984 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-15"></i></div>
                                <h3><a href="{{ route('home') }}">Driving</a></h3>
                                <p>4509 Staffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-16"></i></div>
                                <h3><a href="{{ route('home') }}">Caretaker</a></h3>
                                <p>1039 Staffs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- industries-style-two end -->

        <!-- dueal-section -->
        <section class="dueal-section pt_120 pb_120">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_two">
                            <div class="content-box mr_100">
                                <div class="sec-title pb_35 sec-title-animation animation-style2">
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
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_three">
                            <div class="content-box">
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
                </div>
            </div>
        </section>
        <!-- dueal-section end -->

        <!-- training-section -->
        <section class="training-section">
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Training</span>
                    <h2 class="title-animation">Recent Workshops</h2>
                </div>
            </div>
            <div class="inner-container clearfix">
                <div class="training-block-one">
                    <div class="inner-box" style="background-image: url('{{ asset('assets/images/resource/training-1.jpg') }}')">
                        <div class="video-content mb_150 centred">
                            <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i></a>
                        </div>
                        <div class="text-box">
                            <h3><a href="{{ route('jobDetails') }}">Business Intelligence and Data Analytics</a></h3>
                            <div class="link"><a href="{{ route('jobDetails') }}">Find Works<img src="{{ asset('assets/images/icons/icon-8.png') }}" alt=""></a></div>
                        </div>
                    </div>
                </div>
                <div class="training-block-one">
                    <div class="inner-box" style="background-image: url('{{ asset('assets/images/resource/training-2.jpg') }}')">
                        <div class="video-content mb_150 centred">
                            <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i></a>
                        </div>
                        <div class="text-box">
                            <h3><a href="{{ route('jobDetails') }}">Information Technology Management</a></h3>
                            <div class="link"><a href="{{ route('jobDetails') }}">Find Works<img src="{{ asset('assets/images/icons/icon-8.png') }}" alt=""></a></div>
                        </div>
                    </div>
                </div>
                <div class="training-block-one">
                    <div class="inner-box" style="background-image: url('{{ asset('assets/images/resource/training-3.jpg') }}')">
                        <div class="video-content mb_150 centred">
                            <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i></a>
                        </div>
                        <div class="text-box">
                            <h3><a href="{{ route('jobDetails') }}">Public Policy and Management</a></h3>
                            <div class="link"><a href="{{ route('jobDetails') }}">Find Works<img src="{{ asset('assets/images/icons/icon-8.png') }}" alt=""></a></div>
                        </div>
                    </div>
                </div>
                <div class="training-block-one">
                    <div class="inner-box" style="background-image: url('{{ asset('assets/images/resource/training-4.jpg') }}')">
                        <div class="video-content mb_150 centred">
                            <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i></a>
                        </div>
                        <div class="text-box">
                            <h3><a href="{{ route('jobDetails') }}">Mathematics and its Applications</a></h3>
                            <div class="link"><a href="{{ route('jobDetails') }}">Find Works<img src="{{ asset('assets/images/icons/icon-8.png') }}" alt=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- training-section end -->

        <!-- pricing-section -->
        <section class="pricing-section pt_120 pb_90">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-2.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Pricing</span>
                    <h2 class="title-animation">Pricing Plans</h2>
                </div>
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons">
                        <li class="tab-btn active-btn" data-tab="#tab-1">Monthly</li>
                        <li class="tab-btn" data-tab="#tab-2">Yearly</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                                    <div class="pricing-block-one">
                                        <div class="pricing-table">
                                            <div class="table-header">
                                                <h3>Starter plan</h3>
                                                <h2>$19.00</h2>
                                                <span>Per Month</span>
                                            </div>
                                            <div class="table-content mb_40">
                                                <p>For new comer to the industry trying out for an unlimited period.</p>
                                                <ul class="list-item">
                                                    <li><i class="icon-26"></i>Advantage on the list</li>
                                                    <li><i class="icon-26"></i>Live Tutorial</li>
                                                    <li><i class="icon-26"></i>Expert Advice Plan</li>
                                                    <li><i class="icon-27"></i>Weekly Workshop</li>
                                                    <li><i class="icon-27"></i>Auto Apply to new Job</li>
                                                </ul>
                                            </div>
                                            <div class="table-footer">
                                                <a href="{{ route('index2') }}">Start Free Trial</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                                    <div class="pricing-block-one">
                                        <div class="pricing-table">
                                            <div class="table-header">
                                                <h3>Basic plan</h3>
                                                <h2>$39.00</h2>
                                                <span>Per Month</span>
                                            </div>
                                            <div class="table-content mb_40">
                                                <p>For new comer to the industry trying out for an unlimited period.</p>
                                                <ul class="list-item">
                                                    <li><i class="icon-26"></i>Advantage on the list</li>
                                                    <li><i class="icon-26"></i>Live Tutorial</li>
                                                    <li><i class="icon-26"></i>Expert Advice Plan</li>
                                                    <li><i class="icon-27"></i>Weekly Workshop</li>
                                                    <li><i class="icon-27"></i>Auto Apply to new Job</li>
                                                </ul>
                                            </div>
                                            <div class="table-footer">
                                                <a href="{{ route('index2') }}">Start Free Trial</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                                    <div class="pricing-block-one">
                                        <div class="pricing-table">
                                            <div class="table-header">
                                                <h3>Advanced plan</h3>
                                                <h2>$59.00</h2>
                                                <span>Per Month</span>
                                            </div>
                                            <div class="table-content mb_40">
                                                <p>For new comer to the industry trying out for an unlimited period.</p>
                                                <ul class="list-item">
                                                    <li><i class="icon-26"></i>Advantage on the list</li>
                                                    <li><i class="icon-26"></i>Live Tutorial</li>
                                                    <li><i class="icon-26"></i>Expert Advice Plan</li>
                                                    <li><i class="icon-27"></i>Weekly Workshop</li>
                                                    <li><i class="icon-27"></i>Auto Apply to new Job</li>
                                                </ul>
                                            </div>
                                            <div class="table-footer">
                                                <a href="{{ route('index2') }}">Start Free Trial</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                                    <div class="pricing-block-one">
                                        <div class="pricing-table">
                                            <div class="table-header">
                                                <h3>Starter plan</h3>
                                                <h2>$119.00</h2>
                                                <span>Per Year</span>
                                            </div>
                                            <div class="table-content mb_40">
                                                <p>For new comer to the industry trying out for an unlimited period.</p>
                                                <ul class="list-item">
                                                    <li><i class="icon-26"></i>Advantage on the list</li>
                                                    <li><i class="icon-26"></i>Live Tutorial</li>
                                                    <li><i class="icon-26"></i>Expert Advice Plan</li>
                                                    <li><i class="icon-27"></i>Weekly Workshop</li>
                                                    <li><i class="icon-27"></i>Auto Apply to new Job</li>
                                                </ul>
                                            </div>
                                            <div class="table-footer">
                                                <a href="{{ route('index2') }}">Start Free Trial</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                                    <div class="pricing-block-one">
                                        <div class="pricing-table">
                                            <div class="table-header">
                                                <h3>Basic plan</h3>
                                                <h2>$239.00</h2>
                                                <span>Per Year</span>
                                            </div>
                                            <div class="table-content mb_40">
                                                <p>For new comer to the industry trying out for an unlimited period.</p>
                                                <ul class="list-item">
                                                    <li><i class="icon-26"></i>Advantage on the list</li>
                                                    <li><i class="icon-26"></i>Live Tutorial</li>
                                                    <li><i class="icon-26"></i>Expert Advice Plan</li>
                                                    <li><i class="icon-27"></i>Weekly Workshop</li>
                                                    <li><i class="icon-27"></i>Auto Apply to new Job</li>
                                                </ul>
                                            </div>
                                            <div class="table-footer">
                                                <a href="{{ route('index2') }}">Start Free Trial</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 pricing-block">
                                    <div class="pricing-block-one">
                                        <div class="pricing-table">
                                            <div class="table-header">
                                                <h3>Advanced plan</h3>
                                                <h2>$359.00</h2>
                                                <span>Per Year</span>
                                            </div>
                                            <div class="table-content mb_40">
                                                <p>For new comer to the industry trying out for an unlimited period.</p>
                                                <ul class="list-item">
                                                    <li><i class="icon-26"></i>Advantage on the list</li>
                                                    <li><i class="icon-26"></i>Live Tutorial</li>
                                                    <li><i class="icon-26"></i>Expert Advice Plan</li>
                                                    <li><i class="icon-27"></i>Weekly Workshop</li>
                                                    <li><i class="icon-27"></i>Auto Apply to new Job</li>
                                                </ul>
                                            </div>
                                            <div class="table-footer">
                                                <a href="{{ route('index2') }}">Start Free Trial</a>
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
        <!-- pricing-section end -->

        <!-- download-section -->
        <section class="download-section pb_120">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-6.png') }}')"></div>
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12 col-sm-12 image-column">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/resource/book-1.png') }}" alt=""></figure>
                            </div>
                        </div>
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
                    </div>
                </div>
            </div>
        </section>
        <!-- download-section end -->

        <!-- testimonial-section -->
        <section class="testimonial-section pt_120 pb_90">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Testimonials</span>
                    <h2 class="title-animation">Words From Our Partners</h2>
                </div>
                <div class="three-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-7.png') }}')"></div>
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-10.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt=""></figure>
                                <h4>Ashitaka Dai</h4>
                                <span class="designation">Art Director</span>
                            </div>
                            <p>Company and was impressed by the main personalized approach of their recruitment team. They kept me informed at every stage and ensured that I had all</p>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-7.png') }}')"></div>
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-10.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-2.png') }}" alt=""></figure>
                                <h4>Franklin Bailey</h4>
                                <span class="designation">Sale Manager</span>
                            </div>
                            <p>Recently I went through their recruitment process with Jobaway Company, and I was impressed by how the smooth and efficient these were.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-7.png') }}')"></div>
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-10.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-3.png') }}" alt=""></figure>
                                <h4>Evan Clement</h4>
                                <span class="designation">Mahager, Cypertech</span>
                            </div>
                            <p>I had a fantastic experience throughout the recruitment process with Jobaway team. The communication was clear, interview process was well-organized</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-section end -->

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
                                    <h3><a href="{{ route('blogDetails') }}">Create a series of blog posts discussing common interview</a></h3>
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
                                    <h3><a href="{{ route('blogDetails') }}">Explore the concept of personal branding and its impact on</a></h3>
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
                                    <h3><a href="{{ route('blogDetails') }}">Feature interviews with employees from top companies</a></h3>
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

        <!-- subscribe-style-two -->
        @include('components.subscribeStyleTwo')
        <!-- subscribe-style-two end -->

        <!-- main-footer -->
        @include('components.footer')
        <!-- main-footer end -->

        <!--Scroll to top-->
        @include('components.scroll')
        
    </div>

        @include('components.script')

</body><!-- End of .page_wrapper -->
</html>


