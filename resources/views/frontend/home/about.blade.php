@extends('layouts.layout')

@php
    $title='About Us';
    $subTitle='About Us';
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/clients.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/chooseus.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/industries.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/team.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

        <!-- about-style-four -->
        <section class="about-style-four pt_120 pb_120">
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
                                        <h4><a href="{{ route('jobDetails') }}">Easiest Admin</a></h4>
                                        <span>Fall 2023</span>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-box"><i class="icon-30"></i></div>
                                        <h4><a href="{{ route('jobDetails') }}">Users love Us</a></h4>
                                        <span>Winter 2023</span>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-box"><i class="icon-31"></i></div>
                                        <h4><a href="{{ route('jobDetails') }}">Leader</a></h4>
                                        <span>Winter 2023</span>
                                    </div>
                                    <div class="single-item">
                                        <div class="icon-box"><i class="icon-32"></i></div>
                                        <h4><a href="{{ route('jobDetails') }}">Best support</a></h4>
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

        <!-- chooseus-section -->
        <section class="chooseus-section alternat-3 pt_120 pb_90">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-23.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
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

        <!-- industries-style-four -->
        <section class="industries-style-four pt_120 pb_90">
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
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
        <!-- industries-style-four end -->

        <!-- team-section -->
        <section class="team-section z_1 centred pt_0 pb_0">
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
            </div>
        </section>
        <!-- team-section end -->

        <!-- testimonial-style-two -->
        <section class="testimonial-style-two pt_70 pb_120">
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

@endsection


