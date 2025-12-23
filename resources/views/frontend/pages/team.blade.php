@extends('frontend.layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/team.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/faq.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title='Our Team';
    $subTitle='Our Team';  
@endphp

@section('content')

        <!-- team-section -->
        <section class="team-section centred pt_110 pb_70">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-2.png') }}')"></div>
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
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
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
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
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
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
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
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-8.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-8.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('home') }}">Azizi Dai</a></h3>
                                    <span class="designation">Assistant Director</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- team-section end -->

        <!-- dueal-section -->
        <section class="dueal-section alternat-3 p_relative">
            <div class="outer-container b_radius_0 p_relative pt_120 pb_120">
                <div class="bg-color"></div>
                <div class="shape">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="shape-3"></div>
                    <div class="shape-4"></div>
                </div>
                <div class="auto-container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                            <div class="content_block_three">
                                <div class="content-box mr_100">
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
                            <div class="testimonial-content ml_130">
                                <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                                    <div class="testimonial-block-three">
                                        <div class="inner-box">
                                            <div class="icon-box"><i class="icon-36"></i></div>
                                            <h2>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage</h2>
                                            <figure class="signature mb_30"><img src="{{ asset('assets/images/icons/signature-1.png') }}" alt=""></figure>
                                            <div class="author-box">
                                                <figure class="author-thumb"><img src="{{ asset('assets/images/resource/testimonial-4.png') }}" alt=""></figure>
                                                <h3>Franklin Bailey</h3>
                                                <span class="designation">CEO, JobAway</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial-block-three">
                                        <div class="inner-box">
                                            <div class="icon-box"><i class="icon-36"></i></div>
                                            <h2>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage</h2>
                                            <figure class="signature mb_30"><img src="{{ asset('assets/images/icons/signature-1.png') }}" alt=""></figure>
                                            <div class="author-box">
                                                <figure class="author-thumb"><img src="{{ asset('assets/images/resource/testimonial-4.png') }}" alt=""></figure>
                                                <h3>Franklin Bailey</h3>
                                                <span class="designation">CEO, JobAway</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial-block-three">
                                        <div class="inner-box">
                                            <div class="icon-box"><i class="icon-36"></i></div>
                                            <h2>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage</h2>
                                            <figure class="signature mb_30"><img src="{{ asset('assets/images/icons/signature-1.png') }}" alt=""></figure>
                                            <div class="author-box">
                                                <figure class="author-thumb"><img src="{{ asset('assets/images/resource/testimonial-4.png') }}" alt=""></figure>
                                                <h3>Franklin Bailey</h3>
                                                <span class="designation">CEO, JobAway</span>
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
        <!-- dueal-section end -->

        <!-- join-section -->
        <section class="join-section centred pt_120 pb_120">
            <div class="auto-container">
                <div class="content-box">
                    <div class="sec-title pb_20 sec-title-animation animation-style2">
                        <span class="sub-title mb_10 title-animation">Join Our Team</span>
                        <h2 class="title-animation">Be Imagine, Be Artistic, and let’s Engage.</h2>
                    </div>
                    <div class="text-box">
                        <p>Join our team and be part of a dynamic and forward-thinking organization where <br />your talents and ambitions are valued and nurtured.</p>
                        <a href="{{ route('contact') }}" class="theme-btn btn-one">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- join-section end -->

@endsection

