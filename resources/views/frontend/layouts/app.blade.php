<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'JobAway') }}</title>
    
    @php
    $css = '<link href="' . asset('assets/css/bootstrap.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/style.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/responsive.css') . '" rel="stylesheet">';
    @endphp
    @include('frontend.components.head')
    
    <!-- Additional CSS -->
    @stack('styles')
</head>
<body>
    <div class="boxed_wrapper ltr">
        <!-- preloader -->
        @include('frontend.components.preloader')
        <!-- preloader end -->

        <!-- page-direction -->
        @include('frontend.components.pageDirection')
        <!-- page-direction end -->

        <!--Search Popup-->
        @include('frontend.components.searchPopup')

        <!-- main header -->
        <header class="main-header header-style-one">
            <!-- header-lower -->
            <div class="header-lower">
                <div class="auto-container">
                    <div class="outer-box">
                        <div class="logo-box pl_15"><a href="{{ route('home') }}" style="font-size: 28px; font-weight: 700; color: #2d3748; text-decoration: none;">Kagzi</a></div>
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
                                        <li><a href="{{ route('home') }}">HOME</a></li>
                                        <li><a href="#services">SERVICES</a></li>
                                        <li><a href="{{ route('frontend.products.showcase') }}">PRODUCTS</a></li>
                                        <li><a href="#about">ABOUT</a></li>
                                        <li><a href="#team">TEAM</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-right-content">
                            {{-- <div class="search-btn mr_20"><button class="search-toggler"><i class="icon-1"></i></button></div>
                            <div class="link-box mr_20"><a href="{{ route('login') }}">Log In</a></div> --}}
                            <div class="btn-box"><a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one">Get Started</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="outer-box">
                        <figure class="logo-box pl_15"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a></figure>
                        <div class="menu-area">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="menu-right-content">
                            <div class="search-btn mr_20"><button class="search-toggler"><i class="icon-1"></i></button></div>
                            <div class="link-box mr_20"><a href="{{ route('login') }}">Log In</a></div>
                            <div class="btn-box"><a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one">Get Started</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        @include('frontend.components.mobileMenu')
        <!-- End Mobile Menu -->

            <!-- Responsive Navigation Menu -->
            <div class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium">
                        Home
                    </a>
                    <a href="{{ route('frontend.products.showcase') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('products.*') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium">
                        Products
                    </a>
                    <a href="{{ route('contact.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('contact.*') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium">
                        Contact
                    </a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @if (session('success'))
                <div class="alert alert-success" style="margin: 20px auto; max-width: 1200px; padding: 15px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" style="margin: 20px auto; max-width: 1200px; padding: 15px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; border-radius: 4px;">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="margin: 20px auto; max-width: 1200px; padding: 15px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; border-radius: 4px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- main-footer -->
        <footer class="main-footer">
            <div class="widget-section p_relative pt_80 pb_100">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget mr_30">
                                <figure class="footer-logo mb_25"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a></figure>
                                <p>Your trusted partner for business solutions and services. We provide comprehensive digital solutions to help your business grow.</p>
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
                                    <h3>Quick Links</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links clearfix">
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('frontend.products.showcase') }}">Products</a></li>
                                        <li><a href="{{ route('contact.index') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h3>Services</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links clearfix">
                                        <li><a href="#">Web Development</a></li>
                                        <li><a href="#">Mobile Apps</a></li>
                                        <li><a href="#">Digital Marketing</a></li>
                                        <li><a href="#">E-commerce</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h3>Contact Info</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="info clearfix">
                                        <li><i class="icon-3"></i>info@jobaway.com</li>
                                        <li><i class="icon-2"></i>+1 234 567 8900</li>
                                        <li><i class="icon-26"></i>123 Business Street, Suite 100</li>
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
                        <div class="copyright"><p>Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ config('app.name', 'JobAway') }}</a> All rights reserved.</p></div>
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
        @include('frontend.components.scroll')
        
    </div>

    @include('frontend.components.script')
    
    <!-- Additional JavaScript -->
    @stack('scripts')
</body>
</html>

