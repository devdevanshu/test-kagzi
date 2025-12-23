@extends('frontend.layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/clients.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/video.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title='Testimonials';
    $subTitle='Testimonials';   
@endphp

@section('content')

        <!-- about-style-four -->
        <section class="about-style-four pt_110 pb_120">
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image_block_two">
                            <div class="image-inner">
                                <div class="image-box mr_15">
                                    <figure class="image image-1 mb_15"><img src="{{ asset('assets/images/resource/about-3.jpg') }}" alt=""></figure>
                                    <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-4.jpg') }}" alt=""></figure>
                                </div>
                                <div class="image-box">
                                    <figure class="image image-3 mb_15"><img src="{{ asset('assets/images/resource/about-5.jpg') }}" alt=""></figure>
                                    <figure class="image image-4"><img src="{{ asset('assets/images/resource/about-6.jpg') }}" alt=""></figure>
                                </div>
                                <div class="support-box">
                                    <div class="icon-box"><i class="icon-28"></i></div>
                                    <span>Online Support</span>
                                    <h4><a href="tel:912556889">+912 (556) 889</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_five">
                            <div class="content-box">
                                <div class="sec-title pb_40 sec-title-animation animation-style2">
                                    <span class="sub-title mb_10 title-animation">About us</span>
                                    <h2 class="title-animation">The most loved <span>Agency</span></h2>
                                    <p class="title-animation">Voted the fastest solution to implement the easiest to administer your employee & business.</p>
                                </div>
                                <div class="inner-box clearfix">
                                    <div class="single-item">
                                        <div class="icon-box"><i class="icon-29"></i></div>
                                        <h4><a href="#">Easiest Admin</a></h4>
                                        <span>Fall 2023</span>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-box"><i class="icon-30"></i></div>
                                        <h4><a href="#">Users love Us</a></h4>
                                        <span>Winter 2023</span>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-box"><i class="icon-31"></i></div>
                                        <h4><a href="#">Leader</a></h4>
                                        <span>Winter 2023</span>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-box"><i class="icon-32"></i></div>
                                        <h4><a href="#">Best support</a></h4>
                                        <span>Winter 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-style-four end -->

        <!-- testimonial-section -->
        <section class="testimonial-section pt_120 pb_90">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Testimonials</span>
                    <h2 class="title-animation">Words From Our Partners</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 testimonial-block">
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
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 testimonial-block">
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
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 testimonial-block">
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
                    <div class="col-lg-4 col-md-6 col-sm-12 testimonial-block">
                         <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-7.png') }}')"></div>
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-10.png') }}" alt=""></div>
                                <div class="author-box">
                                    <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-6.png') }}" alt=""></figure>
                                    <h4>Ashitaka Dai</h4>
                                    <span class="designation">Art Director</span>
                                </div>
                                <p>The quality of candidates we've received has significantly improved, and the time-to-hire has reduced dramatically. It's a must-have tool for any company</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 testimonial-block">
                         <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-7.png') }}')"></div>
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-10.png') }}" alt=""></div>
                                <div class="author-box">
                                    <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-7.png') }}" alt=""></figure>
                                    <h4>Diarmuid Eoin</h4>
                                    <span class="designation">Art Director</span>
                                </div>
                                <p>The targeted advertising options and comprehensive candidate profiles have allowed us to connect with highly qualified professionals</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 testimonial-block">
                         <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-7.png') }}')"></div>
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-10.png') }}" alt=""></div>
                                <div class="author-box">
                                    <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-8.png') }}" alt=""></figure>
                                    <h4>Antonio Alex</h4>
                                    <span class="designation">Mahager, Cypertech</span>
                                </div>
                                <p>We’ve seen a significant increase in the quality of applicants since using this recruitment site. The detailed profiles and easy-to-use dashboard make managing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-section end -->

        <!-- clients-section -->
        <section class="clients-section pt_110 pb_120 centred">
            <div class="auto-container">
                <div class="title-text pb_60 sec-title-animation animation-style2">
                    <h3 class="title-animation">Trusted by the next-gen industry leaders</h3>
                </div>
                <div class="inner-box">
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

        <!-- video-section -->
        <section class="video-section centred pb_120">
            <div class="auto-container">
                <div class="inner-container" style="background-image: url('{{ asset('assets/images/background/video-bg.jpg') }}')">
                    <div class="video_block_two">
                        <div class="video-box p_relative">
                            <div class="video-content">
                                <div class="curve-text z_2">
                                    <span class="curved-circle">watch&nbsp;&nbsp;the&nbsp;&nbsp;video&nbsp;&nbsp;right&nbsp;&nbsp;now&nbsp;&nbsp;</span>
                                </div>
                                <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image video-btn" data-caption=""><i class="icon-8"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- video-section end -->

@endsection

