<!DOCTYPE html>
<html lang="en">

    @php
    $css = '<link href="' . asset('assets/css/module-css/banner.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/clients.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/funfact.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/chooseus.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/category.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/industries.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/process.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/team.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/news.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    @endphp
    @include('frontend.components.head')



    
<!-- page wrapper -->
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
                        <figure class="logo-box pl_15"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a></figure>
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
                                        <li class="current"><a href="{{ route('home') }}">HOME</a></li>
                                        <li><a href="#services">FEATURES</a></li>
                                        <li><a href="#about">ABOUT</a></li>
                                        <li><a href="{{ route('frontend.products.showcase') }}">PRODUCTS</a></li>
                                        <li><a href="#testimonials">TESTIMONIALS</a></li>
                                        <li><a href="#team">TEAM</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-right-content">
                            <div class="btn-box"><a href="#contact-form" class="theme-btn btn-one scroll-link">CONTACT US</a></div>
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
                            <div class="btn-box"><a href="#contact-form" class="theme-btn btn-one scroll-link">CONTACT US</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        @include('frontend.components.mobileMenu')
        <!-- End Mobile Menu -->

        <!-- banner-section -->
        <section class="banner-section p_relative centred">
            <div class="gradient-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, var(--theme-color-lighter) 0%, var(--light-bg) 50%, var(--theme-color-light) 100%); z-index: 1;"></div>
            <canvas id="particle-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; pointer-events: none;"></canvas>
            {{-- <div class="author-box">
                <div class="author author-1"><img src="{{ asset('assets/images/resource/author-1.png') }}" alt=""><span>Waiter</span></div>
                <div class="author author-2"><img src="{{ asset('assets/images/resource/author-2.png') }}" alt=""><span>Assistant</span></div>
                <div class="author author-3"><img src="{{ asset('assets/images/resource/author-3.png') }}" alt=""><span>Painter</span></div>
                <div class="author author-4"><img src="{{ asset('assets/images/resource/author-4.png') }}" alt=""><span>Finance</span></div>
                <div class="author author-5"><img src="{{ asset('assets/images/resource/author-5.png') }}" alt=""><span>Cleaner</span></div>
                <div class="author author-6"><img src="{{ asset('assets/images/resource/author-6.png') }}" alt=""><span>Nurse</span></div>
            </div> --}}
            <div class="auto-container" style="position: relative; z-index: 3;">
                <div class="content-box">
                    <h2 style="color: var(--title-color);">Boost your project's speed and efficiency.</h2>
                    <p style="color: var(--text-color);">We are committed to blend insights and strategy to create digital products for your business</p>
                    <div class="btn-box">
                        <a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one mr_20"><span>OUR PRODUCTS</span></a>
                        {{-- <a href="#contact-form" class="theme-btn banner-btn scroll-link">CONTACT US</a> --}}
                    </div>
                </div>
            </div>
            
            <script>
                // Gradient Canvas Animation
                const canvas = document.getElementById('particle-canvas');
                const ctx = canvas.getContext('2d');
                
                function resizeCanvas() {
                    canvas.width = window.innerWidth;
                    canvas.height = canvas.parentElement.offsetHeight;
                }
                
                resizeCanvas();
                window.addEventListener('resize', resizeCanvas);
                
                const particles = [];
                const particleCount = 50;
                
                class Particle {
                    constructor() {
                        this.x = Math.random() * canvas.width;
                        this.y = Math.random() * canvas.height;
                        this.vx = (Math.random() - 0.5) * 0.5;
                        this.vy = (Math.random() - 0.5) * 0.5;
                        this.radius = Math.random() * 3 + 1;
                        this.opacity = Math.random() * 0.5 + 0.2;
                    }
                    
                    update() {
                        this.x += this.vx;
                        this.y += this.vy;
                        
                        if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
                        if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
                    }
                    
                    draw() {
                        ctx.globalAlpha = this.opacity;
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                        ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                        ctx.fill();
                    }
                }
                
                // Create particles
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
                
                function animate() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    particles.forEach(particle => {
                        particle.update();
                        particle.draw();
                    });
                    
                    // Draw connections
                    ctx.globalAlpha = 0.1;
                    particles.forEach((particle, i) => {
                        particles.slice(i + 1).forEach(other => {
                            const dx = particle.x - other.x;
                            const dy = particle.y - other.y;
                            const distance = Math.sqrt(dx * dx + dy * dy);
                            
                            if (distance < 150) {
                                ctx.beginPath();
                                ctx.moveTo(particle.x, particle.y);
                                ctx.lineTo(other.x, other.y);
                                ctx.strokeStyle = 'rgba(255, 255, 255, 0.2)';
                                ctx.lineWidth = 1;
                                ctx.stroke();
                            }
                        });
                    });
                    
                    requestAnimationFrame(animate);
                }
                
                animate();
            </script>
        </section>
        <!-- banner-section end -->

        <!-- clients-section -->
        {{-- <section class="clients-section">
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
        </section> --}}
        <!-- clients-section end -->


         <!-- features-section -->
        <section id="services" class="features-section pt_120 pb_120" style="background: #f8f9fa;">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                        <div class="content-box centred">
                            <div class="sec-title pb_50">
                                <div class="btn-box mb_30">
                                    <span class="sub-title mb_10" style="display: inline-block; background: rgba(112, 66, 197, 0.1); color: #977EFF; padding: 8px 20px; border-radius: 25px; font-weight: 600; font-size: 14px;">OUR FEATURES</span>
                                </div>
                                <h2 style="font-size: 48px; font-weight: 700; color: var(--title-color); line-height: 1.3; margin-bottom: 20px;">
                                    Together, we are<br>
                                    creating a <span style="color: var(--theme-color);">Bright Future.</span><br>
                                    <span style="color: var(--theme-color); font-style: italic;">Join us.</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 30px; text-align: center;">
                                <div class="icon-box mb_25">
                                    <i class="fas fa-eye" style="font-size: 48px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 20px; font-weight: 600; color: #2d3748; margin-bottom: 15px;">Premium Blackbox OCR -<br>Get text From Image & Video</h4>
                                <p style="color: #718096; line-height: 1.6; margin-bottom: 25px;">One of the best Google Chrome Extension for capturing and converting Image/Video data in to text. Easy to use. Install it in Google Chrome or Microsoft Edge and use it to get the text from Image or Video. You can use it on more than 100 different languages.</p>
                                <div class="btn-box">
                                    {{-- <a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one" style="color: white; padding: 12px 30px; border-radius: 25px;">BUY NOW</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 30px; text-align: center;">
                                <div class="icon-box mb_25">
                                    <i class="fas fa-file-alt" style="font-size: 48px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 20px; font-weight: 600; color: #2d3748; margin-bottom: 15px;">Premium Blackbox OCR -<br>Get text From Image & Video</h4>
                                <p style="color: #718096; line-height: 1.6; margin-bottom: 25px;">One of the best Google Chrome Extension for capturing and converting Image/Video data in to text. Easy to use. Install it in Google Chrome or Microsoft Edge and use it to get the text from Image or Video. You can use it on more than 100 different languages.</p>
                                <div class="btn-box">
                                    {{-- <a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one" style="color: white; padding: 12px 30px; border-radius: 25px;">BUY NOW</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 30px; text-align: center;">
                                <div class="icon-box mb_25">
                                    <i class="fas fa-image" style="font-size: 48px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 20px; font-weight: 600; color: #2d3748; margin-bottom: 15px;">Premium Blackbox OCR -<br>Get text From Image & Video</h4>
                                <p style="color: #718096; line-height: 1.6; margin-bottom: 25px;">One of the best Google Chrome Extension for capturing and converting Image/Video data in to text. Easy to use. Install it in Google Chrome or Microsoft Edge and use it to get the text from Image or Video. You can use it on more than 100 different languages.</p>
                                <div class="btn-box">
                                    {{-- <a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one" style="color: white; padding: 12px 30px; border-radius: 25px;">BUY NOW</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 30px; text-align: center;">
                                <div class="icon-box mb_25">
                                    <i class="fas fa-video" style="font-size: 48px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 20px; font-weight: 600; color: #2d3748; margin-bottom: 15px;">Premium Blackbox OCR -<br>Get text From Image & Video</h4>
                                <p style="color: #718096; line-height: 1.6; margin-bottom: 25px;">One of the best Google Chrome Extension for capturing and converting Image/Video data in to text. Easy to use. Install it in Google Chrome or Microsoft Edge and use it to get the text from Image or Video. You can use it on more than 100 different languages.</p>
                                <div class="btn-box">
                                    {{-- <a href="{{ route('frontend.products.showcase') }}" class="theme-btn btn-one" style="color: white; padding: 12px 30px; border-radius: 25px;">BUY NOW</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- features-section end -->



         <!-- chooseus-section -->
        <section class="chooseus-section pt_200 pb_90" style="background: linear-gradient(45deg, #f1f5f9 0%, #e2e8f0 50%, #f8fafc 100%); position: relative;">
            <div class="choose-decoration" style="position: absolute; top: 100px; right: 50px; width: 120px; height: 120px; background: rgba(255, 107, 53, 0.06); border-radius: 50%; filter: blur(30px);"></div>
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-2.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Why Us</span>
                    <h2 class="title-animation">Why Choose Us</h2>
                </div>
                <div class="inner-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-4"></i></div>
                                    <h3><a href="{{ route('home') }}">Arrow Birds CRM</a></h3>
                                    <p>Best In class CRM to fulfill all your needs. Enterprise
grade security provided by default. Hosted on world best 
clouds. 24/7 dedicated support. Connect your Lead 
Sources easily. Send automated welcome email/sms to 
lead and notify your team members via mail and 
notification on their dashboard.</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-5"></i></div>
                                    <h3><a href="{{ route('home') }}">Bhojan Restaurant Software</a></h3>
                                    <p>Best In class CRM to fulfill all your needs. Enterprise
grade security provided by default. Hosted on world best 
clouds. 24/7 dedicated support. Connect your Lead 
Sources easily. Send automated welcome email/sms to 
lead and notify your team members via mail and 
notification on their dashboard.</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-6"></i></div>
                                    <h3><a href="{{ route('home') }}">HelpDesk-Online Support</a></h3>
                                    <p>Best In class CRM to fulfill all your needs. Enterprise
grade security provided by default. Hosted on world best 
clouds. 24/7 dedicated support. Connect your Lead 
Sources easily. Send automated welcome email/sms to 
lead and notify your team members via mail and 
notification on their dashboard.</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- chooseus-section end -->


        <!-- about-section -->
        <section id="about" class="about-section pt_120 pb_120" style="background: #ffffff; position: relative; overflow: hidden;">
            <div class="bg-element" style="position: absolute; top: 50px; left: 50px; width: 100px; height: 100px; background: rgba(34, 101, 255, 0.05); border-radius: 20px; transform: rotate(45deg);"></div>
            <div class="bg-element" style="position: absolute; bottom: 50px; right: 100px; width: 150px; height: 150px; background: rgba(255, 107, 53, 0.05); border-radius: 50%;"></div>
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 video-column">
                        <div class="video_block_one">
                            <div class="video-box p_relative pt_40 pb_40 pl_30 centred">
                                <div class="image-layer">
                                    <figure class="image-1"><img src="{{ asset('assets/images/resource/video-3.jpg') }}" alt=""></figure>
                                    <figure class="image-2"><img src="{{ asset('assets/images/resource/video-2.jpg') }}" alt=""></figure>
                                </div>
                                <div class="video-inner" style="background-image: url('{{ asset('assets/images/resource/video-1.jpg') }}')">
                                    <div class="video-content">
                                        <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i><span class="border-animation border-1"></span><span class="border-animation border-2"></span><span class="border-animation border-3"></span></a>
                                        <h6>Watch Video</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_one">
                            <div class="content-box ml_80">
                                <div class="sec-title pb_20 sec-title-animation animation-style2">
                                    <span class="sub-title mb_10 title-animation">About us</span>
                                    <h2 class="title-animation">Explore our story, values, and 
the mission that inspires <span>everything we do</span></h2>
                                </div>
                                <div class="text-box">
                                    <p>We’re not a big organization with offices around the world; but we are a small team of experienced 
professionals comprising creative designers, web developers, Internet marketing experts, hardware 
technicians and project managers. Honest Infotech is a team of 10+ expert professionals with lots 
and lots of talent. We intended to stay small because we believe in Quality rather than Quantity. 
Each and every team member is a part of our family. The team members have spent days and 
nights to take organization to the existing level. At Honest Infotech, we provide flexible and scalable 
web, and marketing solutions that help clients grow their business.</p>
                                    {{-- <ul class="list-style-one clearfix">
                                        <li>Innovative web design and development</li>
                                        <li>Scalable digital products and services</li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-section end -->

         <!-- funfact-section -->
        {{-- <section class="funfact-section centred pb_90">
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
        </section> --}}

       

        <!-- funfact-section -->
        {{-- <section class="funfact-section centred pb_90">
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
        </section> --}}
        <!-- funfact-section end -->

        <!-- revolutionizing-section -->
        <section class="revolutionizing-section pt_120 pb_120" style="background: #fefefe; position: relative;">
            <div class="revolution-accent" style="position: absolute; bottom: 30px; left: 30px; width: 60px; height: 60px; background: rgba(34, 101, 255, 0.08); transform: rotate(45deg); border-radius: 8px;"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                        <div class="content-box centred">
                            <div class="sec-title pb_60">
                                <h2 style="font-size: 48px; font-weight: 700; color: #2d3748; line-height: 1.3; margin-bottom: 20px;">
                                    Revolutionizing Your<br>
                                    World with Our Products
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box centred" style="padding: 40px 20px; margin-bottom: 30px;">
                                <div class="icon-box mb_30">
                                    <i class="fas fa-sitemap" style="font-size: 60px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 22px; font-weight: 600; color: #2d3748; margin: 0;">Organization</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box centred" style="padding: 40px 20px; margin-bottom: 30px;">
                                <div class="icon-box mb_30">
                                    <i class="fas fa-chess" style="font-size: 60px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 22px; font-weight: 600; color: #2d3748; margin: 0;">Strategy</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box centred" style="padding: 40px 20px; margin-bottom: 30px;">
                                <div class="icon-box mb_30">
                                    <i class="fas fa-chart-line" style="font-size: 60px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 22px; font-weight: 600; color: #2d3748; margin: 0;">Data analytics</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box centred" style="padding: 40px 20px; margin-bottom: 30px;">
                                <div class="icon-box mb_30">
                                    <i class="fas fa-brain" style="font-size: 60px; color: var(--theme-color);"></i>
                                </div>
                                <h4 style="font-size: 22px; font-weight: 600; color: #2d3748; margin: 0;">Intelligence</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- revolutionizing-section end -->

        {{-- <div class="slide-text">
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
        </div> --}}

       

        <!-- category-section -->
        <section class="category-section centred pt_120 pb_70">
            <div class="bg-box">
                <div class="bg-layer parallax-bg" data-parallax='{"y": 100}' style="background-image: url('{{ asset('assets/images/background/category-bg.png') }}')"></div>
            </div>
            <div class="auto-container">
                <div class="sec-title light pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Product</span>
                    <h2 class="title-animation">Researching Products <br />Before Buy</h2>
                </div>
                
                @if($products && $products->count() > 0)
                <!-- Product Carousel Container -->
                <div class="product-carousel-container position-relative">
                    <!-- Navigation Arrows -->
                    @if($products->count() > 2)
                    <button class="carousel-nav carousel-prev" onclick="moveCarousel(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-nav carousel-next" onclick="moveCarousel(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    @endif
                    
                    <!-- Products Container -->
                    <div class="product-carousel-wrapper">
                        <div class="product-carousel" id="productCarousel">
                            @foreach($products as $index => $product)
                                <div class="product-slide">
                                    <div class="category-block-one">
                                        <div class="inner-box">
                                            <h2>{{ $product->name }}</h2>
                                            <p>{{ $product->description }}</p>
                                            <a href="{{ route('frontend.products.show', $product->slug) }}" class="theme-btn btn-one">Buy Now</a>
                                            <figure class="image-box image-hov-{{ $index % 2 == 0 ? 'one' : 'two' }}">
                                                @if($product->images && is_array($product->images) && count($product->images) > 0)
                                                    <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                                         alt="{{ $product->name }}" 
                                                         style="width:240px; height:240px; object-fit:cover;">
                                                @else
                                                    <img src="{{ asset('assets/images/resource/category-' . ($index % 2 + 1) . '.jpg') }}" 
                                                         alt="{{ $product->name }}">
                                                @endif
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Dots Navigation -->
                    @if($products->count() > 2)
                    <div class="carousel-dots">
                        @for($i = 0; $i < ceil($products->count() / 2); $i++)
                            <span class="dot {{ $i == 0 ? 'active' : '' }}" onclick="currentSlide({{ $i + 1 }})"></span>
                        @endfor
                    </div>
                    @endif
                </div>
                @else
                        <!-- Fallback content if no products -->
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 category-block">
                                <div class="category-block-one">
                                    <div class="inner-box">
                                        <h2>For Local Workers</h2>
                                        <p>Join over 1 million workers who use GravyWork to <br />find flexible and temp to hire</p>
                                        <a href="#" class="theme-btn btn-one">Find Work</a>
                                        <figure class="image-box image-hov-one"><img src="{{ asset('assets/images/resource/category-1.jpg') }}" alt=""></figure>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 category-block">
                                <div class="category-block-one">
                                    <div class="inner-box">
                                        <h2>For Business Owner</h2>
                                        <p>Finding individuals who share your company's values and <br />vision can contribute to a cohesive</p>
                                        <a href="#" class="theme-btn btn-one">Find Employee</a>
                                        <figure class="image-box image-hov-two"><img src="{{ asset('assets/images/resource/category-2.jpg') }}" alt=""></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </section>
        
        <!-- Product Carousel CSS and JavaScript -->
        <style>
        .product-carousel-container {
            position: relative;
            overflow: hidden;
        }
        
        .product-carousel-wrapper {
            overflow: hidden;
            width: 100%;
        }
        
        .product-carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
            min-height: 400px;
            width: 100%;
        }
        
        .product-slide {
            min-width: 50%;
            flex: 0 0 50%;
            padding: 0 15px;
            box-sizing: border-box;
        }
        
        .product-slide .category-block-one {
            height: 100%;
            width: 100%;
        }
        
        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #333;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .carousel-nav:hover {
            background: white;
            color: #007bff;
            transform: translateY(-50%) scale(1.1);
        }
        
        .carousel-prev {
            left: -10px;
        }
        
        .carousel-next {
            right: -10px;
        }
        
        .carousel-dots {
            text-align: center;
            margin-top: 30px;
        }
        
        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .dot.active,
        .dot:hover {
            background-color: white;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .product-slide {
                min-width: 100%;
                flex: 0 0 100%;
            }
            
            .carousel-nav {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }
            
            .carousel-prev {
                left: 10px;
            }
            
            .carousel-next {
                right: 10px;
            }
        }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentIndex = 0;
            const totalProducts = {{ $products ? $products->count() : 0 }};
            const itemsPerPage = window.innerWidth <= 768 ? 1 : 2;
            const totalPages = Math.ceil(totalProducts / itemsPerPage);
            
            window.moveCarousel = function(direction) {
                const carousel = document.getElementById('productCarousel');
                if (!carousel) return;
                
                const dots = document.querySelectorAll('.dot');
                
                currentIndex += direction;
                
                if (currentIndex < 0) {
                    currentIndex = totalPages - 1;
                } else if (currentIndex >= totalPages) {
                    currentIndex = 0;
                }
                
                const translateX = -(currentIndex * 100);
                carousel.style.transform = `translateX(${translateX}%)`;
                
                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
            };
            
            window.currentSlide = function(index) {
                currentIndex = index - 1;
                window.moveCarousel(0);
            };
            
            // Auto-play carousel
            @if($products && $products->count() > 2)
            setInterval(() => {
                window.moveCarousel(1);
            }, 5000);
            @endif
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            const newItemsPerPage = window.innerWidth <= 768 ? 1 : 2;
            // Recalculate and reset position
            currentIndex = 0;
            const carousel = document.getElementById('productCarousel');
            if (carousel) {
                carousel.style.transform = 'translateX(0%)';
            }
        });
        </script>
        <!-- category-section end -->

        <!-- industries-section -->
        {{-- <section class="industries-section pt_20 pb_120">
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Industries</span>
                    <h2 class="title-animation">Industries Served</h2>
                </div>
                <div class="inner-container clearfix">
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-9"></i></div>
                            <h3><a href="{{ route('home') }}">Hotel</a></h3>
                            <p>2853 Staffs</p>
                        </div>
                    </div>
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-10"></i></div>
                            <h3><a href="{{ route('home') }}">Hospitality</a></h3>
                            <p>2256 Staffs</p>
                        </div>
                    </div>
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-11"></i></div>
                            <h3><a href="{{ route('home') }}">Kitchen</a></h3>
                            <p>1408 Staffs</p>
                        </div>
                    </div>
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-12"></i></div>
                            <h3><a href="{{ route('home') }}">Retail</a></h3>
                            <p>1740 Staffs</p>
                        </div>
                    </div>
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-13"></i></div>
                            <h3><a href="{{ route('home') }}">Special Events</a></h3>
                            <p>3948 Staffs</p>
                        </div>
                    </div>
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-14"></i></div>
                            <h3><a href="{{ route('home') }}">General Labor</a></h3>
                            <p>2984 Staffs</p>
                        </div>
                    </div>
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-15"></i></div>
                            <h3><a href="{{ route('home') }}">Driving</a></h3>
                            <p>4509 Staffs</p>
                        </div>
                    </div>
                    <div class="industries-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-16"></i></div>
                            <h3><a href="{{ route('home') }}">Senior Living</a></h3>
                            <p>1039 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="btn-box centred mt_60"><a href="{{ route('home') }}" class="theme-btn btn-one">View All Categories</a></div>
            </div>
        </section> --}}
        <!-- industries-section end -->

        <!-- section divider -->
        {{-- <div class="section-divider" style="height: 1px; background: linear-gradient(90deg, transparent 0%, #e2e8f0 50%, transparent 100%); margin: 0;"></div>

        <!-- section separator -->
        <div class="section-separator" style="height: 2px; background: linear-gradient(90deg, transparent 0%, #cbd5e1 25%, #cbd5e1 75%, transparent 100%); margin: 30px 0;"></div> --}}

        <!-- testimonial-section -->
        <section id="testimonials" class="testimonial-section pt_120 pb_90" style="background: linear-gradient(135deg, #f8fafe 0%, #eef5ff 100%); position: relative; overflow: hidden;">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}'); opacity: 0.1;"></div>
            <div class="bg-shape" style="position: absolute; top: -50px; right: -100px; width: 300px; height: 300px; background: rgba(255, 107, 53, 0.08); border-radius: 50%; z-index: 1;"></div>
            <div class="bg-shape" style="position: absolute; bottom: -80px; left: -120px; width: 400px; height: 400px; background: rgba(34, 101, 255, 0.05); border-radius: 50%; z-index: 1;"></div>
            <div class="auto-container">
                <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Testimonials</span>
<h2 class="title-animation" style="color: black;">
    What Our Customers Say
</h2>
                </div>
                <div style="overflow: hidden; position: relative;">
                    <div class="testimonial-slider" style="display: flex; gap: 30px; animation: scroll-testimonials 30s linear infinite;">
                        <!-- Testimonial 1 -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-1.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">Sarah Johnson</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Restaurant Owner</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"JobAway has been a game-changer for our restaurant. We found skilled staff quickly and efficiently. The platform is easy to use and the workers are professional."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">245 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-2.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">Michael Chen</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Hotel Manager</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"Excellent service! We've hired multiple staff members through JobAway and each one has been thoroughly vetted and professional. Highly recommend to any hospitality business."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">189 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-3.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">Emily Rodriguez</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Event Coordinator</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star-half-alt" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"As an event coordinator, I need reliable staff on short notice. JobAway delivers every time. The quality of workers and the ease of booking makes my job so much easier."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">312 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 4 -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-4.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">David Thompson</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Retail Store Manager</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"We've been using JobAway for over a year now. The platform is intuitive, customer support is responsive, and we've never had issues finding quality staff for our retail locations."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">278 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 5 -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-5.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">Lisa Anderson</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Catering Director</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"JobAway has revolutionized how we staff our catering events. The workers are skilled, punctual, and professional. This platform saves us time and ensures quality service every time."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">421 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 6 -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-6.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">Robert Martinez</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Operations Manager</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"Outstanding platform! JobAway has helped us scale our operations with confidence. The verification process ensures we get reliable workers, and the booking system is seamless."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">356 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Duplicate testimonials for infinite loop -->
                        <!-- Testimonial 1 (duplicate) -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-1.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">Sarah Johnson</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Restaurant Owner</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"JobAway has been a game-changer for our restaurant. We found skilled staff quickly and efficiently. The platform is easy to use and the workers are professional."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">245 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 (duplicate) -->
                        <div style="flex: 0 0 400px; max-width: 400px;">
                            <div class="testimonial-block-one">
                                <div class="inner-box" style="background: white; padding: 30px; border-radius: 10px; height: 100%;">
                                    <div class="author-info mb_20">
                                        {{-- <figure class="author-thumb" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; float: left; margin-right: 15px;">
                                            <img src="{{ asset('assets/images/resource/author-2.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </figure> --}}
                                        <div style="overflow: hidden;">
                                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 5px;">Michael Chen</h4>
                                            <span style="font-size: 14px; color: var(--text-color);">Hotel Manager</span>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="rating mb_15">
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    </div>
                                    <div class="text">
                                        <p style="font-size: 15px; line-height: 1.8; color: var(--text-color); margin-bottom: 15px;">"Excellent service! We've hired multiple staff members through JobAway and each one has been thoroughly vetted and professional. Highly recommend to any hospitality business."</p>
                                    </div>
                                    <div class="like-box" style="display: flex; align-items: center; gap: 5px; color: var(--theme-color);">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span style="font-weight: 600;">189 people found this helpful</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            @keyframes scroll-testimonials {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(-2580px); /* 6 cards * (400px + 30px gap) */
                }
            }
            
            .testimonial-slider:hover {
                animation-play-state: paused;
            }

            /* Show contact image only on desktop/lg screens */
            @media (min-width: 992px) {
                .image-column .image-box {
                    display: block !important;
                }
            }

            /* Hide on tablet and mobile */
            @media (max-width: 991px) {
                .image-column .image-box {
                    display: none !important;
                }
            }

            /* Prevent validation.js conflicts */
            .custom-form .no-validate {
                pointer-events: auto !important;
            }

            /* Message styling */
            .alert {
                animation: fadeInDown 0.5s ease-in-out;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        <!-- testimonial-section end -->

        <!-- team-section -->
        <section id="team" class="team-section centred pt_120 pb_70" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%); position: relative; overflow: hidden;">
            <div class="team-pattern" style="position: absolute; top: 0; right: 0; width: 300px; height: 300px; background-image: radial-gradient(circle, rgba(255,107,53,0.08) 2px, transparent 2px); background-size: 20px 20px; opacity: 0.4;"></div>
            <div class="auto-container">
                <div class="sec-title pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Our Team</span>
                    <h2 class="title-animation">Meet The Team</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-1.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-1.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('home') }}">Tom Oliver</a></h3>
                                    <span class="designation">Founder</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-2.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-2.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('home') }}">Loenard Barnes</a></h3>
                                    <span class="designation">Lead Engineer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-3.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-3.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('home') }}">Gilbert Sherman</a></h3>
                                    <span class="designation">Sale Manager</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-4.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-4.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('home') }}">Franklin Bailey</a></h3>
                                    <span class="designation">Art Director</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="lower-box">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('assets/images/team/team-5.jpg') }}" alt=""></figure>
                                        <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-5.jpg') }}" alt=""></figure>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="{{ route('home') }}">Antonio Alex</a></h3>
                                        <span class="designation">Lead Engineer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('assets/images/team/team-6.jpg') }}" alt=""></figure>
                                        <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-6.jpg') }}" alt=""></figure>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="{{ route('home') }}">Diarmuid Eoin</a></h3>
                                        <span class="designation">Sale Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('assets/images/team/team-7.jpg') }}" alt=""></figure>
                                        <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-7.jpg') }}" alt=""></figure>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="{{ route('home') }}">Ashitaka Dai</a></h3>
                                        <span class="designation">Art Director</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
        <!-- team-section end -->

        <!-- news-section -->
         {{-- <section class="process-section pt_120 pb_90">
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
        </section> --}}
        <!-- news-section end -->

        <!-- contact-section -->
        <section class="contact-section pt_120 pb_120" id="contact-form" style="background: linear-gradient(135deg, #f8fafc 0%, #eef5ff 100%); position: relative; overflow: hidden;">
            <div class="bg-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('assets/images/shape/shape-1.png') }}'); opacity: 0.05; background-repeat: no-repeat; background-size: cover;"></div>
            <div class="contact-shape" style="position: absolute; top: 50px; right: 50px; width: 200px; height: 200px; background: rgba(151, 126, 255, 0.1); clip-path: polygon(50% 0%, 0% 100%, 100% 100%); z-index: 1;"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box" style="padding: 50px; position: relative; z-index: 2; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                            <h2 style="font-size: 42px; font-weight: 700; color: var(--title-color); margin-bottom: 10px; line-height: 1.3;">Have Questions?</h2>
                            <h3 style="font-size: 32px; font-weight: 600; color: var(--theme-color); margin-bottom: 40px; line-height: 1.4;">Contact Us</h3>
                            
                            <!-- Success/Error Messages -->
                            <div id="form-messages" style="display: none; margin-bottom: 25px;">
                                <div id="success-message" class="alert alert-success" style="display: none; background: #d4edda; color: #155724; padding: 15px 20px; border: 1px solid #c3e6cb; border-radius: 8px; margin-bottom: 15px; font-weight: 500;">
                                    <i class="fas fa-check-circle" style="margin-right: 12px;"></i>
                                    <span>Thank you for your message! We'll get back to you soon.</span>
                                </div>
                                <div id="error-message" class="alert alert-danger" style="display: none; background: #f8d7da; color: #721c24; padding: 15px 20px; border: 1px solid #f5c6cb; border-radius: 8px; margin-bottom: 15px; font-weight: 500;">
                                    <i class="fas fa-exclamation-circle" style="margin-right: 12px;"></i>
                                    <span>Something went wrong. Please try again.</span>
                                </div>
                            </div>

                            <form method="post" action="{{ route('contact.store') }}" class="contact-form custom-form" id="contactForm">
                                @csrf
                                <div class="row clearfix" style="margin-bottom: 0;">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group" style="margin-bottom: 25px;">
                                        <label style="display: block; margin-bottom: 12px; font-weight: 600; color: var(--title-color); font-size: 15px;">First Name</label>
                                        <input type="text" name="first_name" placeholder="Enter your first name" required class="no-validate" style="width: 100%; padding: 14px 18px; border: 2px solid #e5e5e5; border-radius: 8px; font-size: 15px; background: #f9f9f9; color: var(--title-color); transition: all 0.3s ease;" onFocus="this.style.borderColor='var(--theme-color)'; this.style.background='white';" onBlur="this.style.borderColor='#e5e5e5'; this.style.background='#f9f9f9';">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group" style="margin-bottom: 25px;">
                                        <label style="display: block; margin-bottom: 12px; font-weight: 600; color: var(--title-color); font-size: 15px;">Last Name</label>
                                        <input type="text" name="last_name" placeholder="Enter your last name" required class="no-validate" style="width: 100%; padding: 14px 18px; border: 2px solid #e5e5e5; border-radius: 8px; font-size: 15px; background: #f9f9f9; color: var(--title-color); transition: all 0.3s ease;" onFocus="this.style.borderColor='var(--theme-color)'; this.style.background='white';" onBlur="this.style.borderColor='#e5e5e5'; this.style.background='#f9f9f9';">
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 25px;">
                                    <label style="display: block; margin-bottom: 12px; font-weight: 600; color: var(--title-color); font-size: 15px;">Your Email</label>
                                    <input type="email" name="email" placeholder="Enter your email" required class="no-validate" style="width: 100%; padding: 14px 18px; border: 2px solid #e5e5e5; border-radius: 8px; font-size: 15px; background: #f9f9f9; color: var(--title-color); transition: all 0.3s ease;" onFocus="this.style.borderColor='var(--theme-color)'; this.style.background='white';" onBlur="this.style.borderColor='#e5e5e5'; this.style.background='#f9f9f9';">
                                </div>
                                <div class="form-group" style="margin-bottom: 25px;">
                                    <label style="display: block; margin-bottom: 12px; font-weight: 600; color: var(--title-color); font-size: 15px;">Message</label>
                                    <textarea name="message" placeholder="Enter your message" required class="no-validate" style="width: 100%; padding: 14px 18px; border: 2px solid #e5e5e5; border-radius: 8px; font-size: 15px; min-height: 130px; resize: vertical; background: #f9f9f9; color: var(--title-color); font-family: inherit; transition: all 0.3s ease;" onFocus="this.style.borderColor='var(--theme-color)'; this.style.background='white';" onBlur="this.style.borderColor='#e5e5e5'; this.style.background='#f9f9f9';"></textarea>
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <button type="submit" class="theme-btn btn-one" style="padding: 16px 50px; font-size: 16px; font-weight: 600; border-radius: 8px; transition: all 0.3s ease; width: 100%; max-width: 250px;">SUBMIT MESSAGE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-box" style="position: relative; z-index: 2; border-radius: 15px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1); height: 100%; min-height: 500px; display: none;">
                            <img src="{{ asset('assets/images/background/contactus.png') }}" alt="Contact Us" style="width: 100%; height: 90%; object-fit: cover; position: absolute; top: 0; left: 0;">
                            {{-- <div class="overlay-content" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(120, 235, 84, 0.85) 0%, rgba(69, 167, 53, 0.75) 100%); display: flex; align-items: center; justify-content: center; z-index: 2;">
                                <div class="text-center" style="color: white;">
                                    <i class="icon-4" style="font-size: 48px; margin-bottom: 20px; display: block;"></i>
                                    <h3 style="font-size: 28px; font-weight: 700; margin: 0;">Get In Touch</h3>
                                    <p style="margin-top: 15px; font-size: 16px; font-weight: 500;">We're here to help you succeed</p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-section end -->

        <!-- main-footer -->
        <footer class="main-footer">
            <div class="widget-section p_relative pt_80 pb_100">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget mr_30">
                                <figure class="footer-logo mb_20"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a></figure>
                                <p>Our expert financial consultants provide 
solutions to help you achieve financial 
wealth. Trust us to guide you toward a 
brighter financial future.</p>
                                {{-- <div class="download-btn">
                                    <a href="{{ route('about') }}" class="apple-store">
                                        <img src="{{ asset('assets/images/icons/icon-4.png') }}" alt="">
                                        <span>Download on</span>
                                        App Store
                                    </a>
                                    <a href="{{ route('about') }}" class="play-store">
                                        <img src="{{ asset('assets/images/icons/icon-5.png') }}" alt="">
                                        <span>Get it on</span>
                                        Google Play
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>Our Services</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('home') }}">Insurance Planning</a></li>
                                        <li><a href="{{ route('home') }}">Estate Planning</a></li>
                                        <li><a href="{{ route('home') }}">Tax Optimization</a></li>
                                        <li><a href="{{ route('home') }}">Debt Management</a></li>
                                        {{-- <li><a href="{{ route('home') }}">Jobs in Alaska</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>Explore More</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('home') }}">About us</a></li>
                                        <li><a href="{{ route('home') }}">Blog</a></li>
                                        <li><a href="{{ route('home') }}">Site map</a></li>
                                        <li><a href="{{ route('home') }}">Privacy</a></li>
                                        {{-- <li><a href="{{ route('home') }}">Bus Driver</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>Company</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('home') }}">Career</a></li>
                                        <li><a href="{{ route('home') }}">Partners</a></li>
                                        {{-- <li><a href="{{ route('blog') }}">Blog</a></li> --}}
                                        <li><a href="{{ route('home') }}">Clients</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-2 col-md-4 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h4>Help & Support</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                                        <li><a href="{{ route('faq') }}">General FAQ</a></li>
                                        <li><a href="{{ route('home') }}">Support Center</a></li>
                                        <li><a href="{{ route('home') }}">Privacy Policy</a></li>
                                        <li><a href="{{ route('home') }}">Terms & Conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="bottom-inner">
                        <div class="copyright"><p>Copyright &copy; 2025 <a href="{{ route('home') }}">Kagzi InfoTech</a> All rights reserved.</p></div>
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

    <script>
        // Smooth scrolling for anchor links
        document.addEventListener('DOMContentLoaded', function() {
            const scrollLinks = document.querySelectorAll('a[href^="#"]');
            
            scrollLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Only smooth scroll if it's an anchor link
                    if (href !== '#' && document.querySelector(href)) {
                        e.preventDefault();
                        
                        const target = document.querySelector(href);
                        const offsetTop = target.offsetTop - 80; // Offset for fixed header
                        
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Contact form submission with AJAX
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(contactForm);
                    const submitBtn = contactForm.querySelector('button[type="submit"]');
                    const formMessages = document.getElementById('form-messages');
                    const successMessage = document.getElementById('success-message');
                    const errorMessage = document.getElementById('error-message');
                    
                    // Show loading state
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 10px;"></i>Sending...';
                    submitBtn.disabled = true;
                    
                    // Hide previous messages
                    formMessages.style.display = 'none';
                    successMessage.style.display = 'none';
                    errorMessage.style.display = 'none';
                    
                    fetch(contactForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            successMessage.style.display = 'block';
                            formMessages.style.display = 'block';
                            contactForm.reset();
                            
                            // Scroll to message
                            formMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        } else {
                            // Show error message
                            errorMessage.style.display = 'block';
                            formMessages.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        // Show error message
                        errorMessage.style.display = 'block';
                        formMessages.style.display = 'block';
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.innerHTML = 'SUBMIT MESSAGE';
                        submitBtn.disabled = false;
                    });
                });
            }
        });
    </script>

        @include('frontend.components.script')

</body><!-- End of .page_wrapper -->
</html>


