@extends('layouts.layout')

@php
    $title='Job Openings';
    $subTitle='Job Openings';  
    $css = '<link href="' . asset('assets/css/module-css/header.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/job.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/welcome.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

        <!-- job-section -->
        <section class="job-section pt_110 pb_90">
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Post ed jobs</span>
                    <h2 class="title-animation">Find Your Job</h2>
                </div>
                <div class="inner-container">
                    <div class="job-block-one">
                        <div class="upper-box">
                            <ul class="job-info">
                                <li><i class="icon-43"></i>Posted by <span>6 months ago</span></li>
                                <li>job Code: <span>0222512</span></li>
                            </ul>
                        </div>
                        <div class="inner-box">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-44"></i></div>
                                <h3>Software Engineer</h3>
                                <span>San Fransisco, California</span>
                            </div>
                            <div class="salary-box">
                                <h5>Salary</h5>
                                <span>$200 - $300 Per  Month</span>
                            </div>
                            <div class="experience-box">
                                <h5>Experience need</h5>
                                <span>2 - 3 Yrs</span>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="job-block-one">
                        <div class="upper-box">
                            <ul class="job-info">
                                <li><i class="icon-43"></i>Posted by <span>6 months ago</span></li>
                                <li>job Code: <span>0222512</span></li>
                            </ul>
                        </div>
                        <div class="inner-box">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-44"></i></div>
                                <h3>Resources Manager</h3>
                                <span>San Fransisco, California</span>
                            </div>
                            <div class="salary-box">
                                <h5>Salary</h5>
                                <span>$200 - $300 Per  Month</span>
                            </div>
                            <div class="experience-box">
                                <h5>Experience need</h5>
                                <span>2 - 3 Yrs</span>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="job-block-one">
                        <div class="upper-box">
                            <ul class="job-info">
                                <li><i class="icon-43"></i>Posted by <span>6 months ago</span></li>
                                <li>job Code: <span>0222512</span></li>
                            </ul>
                        </div>
                        <div class="inner-box">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-44"></i></div>
                                <h3>Administrative Coordinator</h3>
                                <span>San Fransisco, California</span>
                            </div>
                            <div class="salary-box">
                                <h5>Salary</h5>
                                <span>$200 - $300 Per  Month</span>
                            </div>
                            <div class="experience-box">
                                <h5>Experience need</h5>
                                <span>2 - 3 Yrs</span>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="job-block-one">
                        <div class="upper-box">
                            <ul class="job-info">
                                <li><i class="icon-43"></i>Posted by <span>6 months ago</span></li>
                                <li>job Code: <span>0222512</span></li>
                            </ul>
                        </div>
                        <div class="inner-box">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-44"></i></div>
                                <h3>Talent Acquisition</h3>
                                <span>San Fransisco, California</span>
                            </div>
                            <div class="salary-box">
                                <h5>Salary</h5>
                                <span>$200 - $300 Per  Month</span>
                            </div>
                            <div class="experience-box">
                                <h5>Experience need</h5>
                                <span>2 - 3 Yrs</span>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="job-block-one">
                        <div class="upper-box">
                            <ul class="job-info">
                                <li><i class="icon-43"></i>Posted by <span>6 months ago</span></li>
                                <li>job Code: <span>0222512</span></li>
                            </ul>
                        </div>
                        <div class="inner-box">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-44"></i></div>
                                <h3>Software Engineer</h3>
                                <span>San Fransisco, California</span>
                            </div>
                            <div class="salary-box">
                                <h5>Salary</h5>
                                <span>$200 - $300 Per  Month</span>
                            </div>
                            <div class="experience-box">
                                <h5>Experience need</h5>
                                <span>2 - 3 Yrs</span>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="job-block-one">
                        <div class="upper-box">
                            <ul class="job-info">
                                <li><i class="icon-43"></i>Posted by <span>6 months ago</span></li>
                                <li>job Code: <span>0222512</span></li>
                            </ul>
                        </div>
                        <div class="inner-box">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-44"></i></div>
                                <h3>Resources Manager</h3>
                                <span>San Fransisco, California</span>
                            </div>
                            <div class="salary-box">
                                <h5>Salary</h5>
                                <span>$200 - $300 Per  Month</span>
                            </div>
                            <div class="experience-box">
                                <h5>Experience need</h5>
                                <span>2 - 3 Yrs</span>
                            </div>
                            <div class="btn-box">
                                <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- job-section end -->

        <!-- welcome-section -->
        <section class="welcome-section alternat-2 pt_0 pb_120">
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

@endsection


