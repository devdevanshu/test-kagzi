@extends('layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/service.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title='Our Solutions';
    $subTitle='Our Solutions';   
@endphp

@section('content')

        <!-- service-section -->
        <section class="service-section centred pt_110 pb_90">
            <div class="auto-container">
                <div class="sec-title pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">What We Provide</span>
                    <h2 class="title-animation">Inspiring Staffing Solutions</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('serviceDetails2') }}"><img src="{{ asset('assets/images/service/service-1.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('serviceDetails2') }}"><img src="{{ asset('assets/images/service/service-1.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('serviceDetails2') }}">Training Session</a></h3>
                                    <p>These experts guide new employees through interactive workshops</p>
                                    <div class="btn-box"><a href="{{ route('serviceDetails2') }}" class="theme-btn btn-one">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('serviceDetails') }}"><img src="{{ asset('assets/images/service/service-2.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('serviceDetails') }}"><img src="{{ asset('assets/images/service/service-2.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('serviceDetails') }}">Executive Search</a></h3>
                                    <p>Our executive search services are customized to meet your specific</p>
                                    <div class="btn-box"><a href="{{ route('serviceDetails') }}" class="theme-btn btn-one">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('serviceDetails6') }}"><img src="{{ asset('assets/images/service/service-3.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('serviceDetails6') }}"><img src="{{ asset('assets/images/service/service-3.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('serviceDetails6') }}">Temporary Jobs</a></h3>
                                    <p>Apply for our temporary jobs and become part of our talent pool</p>
                                    <div class="btn-box"><a href="{{ route('serviceDetails6') }}" class="theme-btn btn-one">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('serviceDetails4') }}"><img src="{{ asset('assets/images/service/service-4.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('serviceDetails4') }}"><img src="{{ asset('assets/images/service/service-1.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('serviceDetails4') }}">Payroll Services</a></h3>
                                    <p>Utilizing a reliable payroll service can significantly improve operational</p>
                                    <div class="btn-box"><a href="{{ route('serviceDetails4') }}" class="theme-btn btn-one">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('serviceDetails5') }}"><img src="{{ asset('assets/images/service/service-5.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('serviceDetails5') }}"><img src="{{ asset('assets/images/service/service-2.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('serviceDetails5') }}">Workforce System</a></h3>
                                    <p>This system leverages advanced technologies such as Applicant Tracking</p>
                                    <div class="btn-box"><a href="{{ route('serviceDetails5') }}" class="theme-btn btn-one">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('serviceDetails3') }}"><img src="{{ asset('assets/images/service/service-6.jpg') }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="{{ route('serviceDetails3') }}"><img src="{{ asset('assets/images/service/service-3.jpg') }}" alt=""></a></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('serviceDetails3') }}">Career Growth</a></h3>
                                    <p>career growth is about fostering a culture where individuals can achieve</p>
                                    <div class="btn-box"><a href="{{ route('serviceDetails3') }}" class="theme-btn btn-one">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-section end -->

        <!-- dueal-section -->
        <section class="dueal-section service-page p_relative pt_110 pb_120">
            <div class="bg-color"></div>
            <div class="shape">
                <div class="shape-1"></div>
                <div class="shape-2"></div>
                <div class="shape-3"></div>
                <div class="shape-4"></div>
            </div>
            <figure class="image-layer-1 p_absolute l_150 b_0"><img src="{{ asset('assets/images/resource/women-1.png') }}" alt=""></figure>
            <figure class="image-layer-2 p_absolute r_150 b_0"><img src="{{ asset('assets/images/resource/men-1.png') }}" alt=""></figure>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="hiring-content align-3 mr_60">
                            <h2>Professions Hiring</h2>
                            <p>This dynamic hiring landscape presents a wealth of opportunities for professionals across</p>
                            <a href="{{ route('service') }}" class="theme-btn btn-one">Professions</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="hiring-content light ml_45">
                            <h2>Industries Hiring</h2>
                            <p>The current job market is dynamic, with numerous industries actively seeking new talent</p>
                            <a href="{{ route('service') }}" class="theme-btn btn-one">Industries</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- dueal-section end -->

        <!-- testimonial-style-three -->
        <section class="testimonial-style-three pt_120 pb_120">
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

@endsection


