@extends('layouts.layout')

@php
    $title='Job Seekers Overview';
    $subTitle='Job Seekers Overview'; 
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/service.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/chooseus.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/pricing.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
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
                </div>
            </div>
        </section>
        <!-- service-section end -->

        <!-- about-section -->
        <section class="about-section pt_0 pb_120">
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
                </div>
            </div>
        </section>
        <!-- about-section end -->

        <!-- chooseus-section -->
        <section class="chooseus-section light-section centred">
            <div class="outer-container b_radius_0 p_relative pt_120 pb_90">
                <div class="shape">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="shape-3"></div>
                    <div class="shape-4"></div>
                </div>
                <div class="auto-container">
                    <div class="sec-title light pb_60 sec-title-animation animation-style2">
                        <span class="sub-title mb_10 title-animation">Why Us</span>
                        <h2 class="title-animation">Why Choose Us</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12 chooseus-block">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-4"></i></div>
                                    <h3><a href="{{ route('home') }}">Retain Top Talent</a></h3>
                                    <p>Providing clear career paths and growth opportunities is key to retaining top talent.</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 chooseus-block">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-5"></i></div>
                                    <h3><a href="{{ route('home') }}">Stay Compliant</a></h3>
                                    <p>Educate employees about compliance requirements through regular training</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 chooseus-block">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-6"></i></div>
                                    <h3><a href="{{ route('home') }}">Improve Employee</a></h3>
                                    <p>Invest in employee training and development programs to enhance skills and knowledge.</p>
                                    <div class="link"><a href="{{ route('home') }}">Learn More<i class="icon-7"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 chooseus-block">
                            <div class="chooseus-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="icon-33"></i></div>
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
        <!-- chooseus-section end -->

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

@endsection

