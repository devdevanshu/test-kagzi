@extends('layouts.layout')

@php
    $title='Job Details';
    $subTitle='Job Details'; 
    $css = '<link href="' . asset('assets/css/module-css/header.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/job-details.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

        <!-- job-details -->
        <section class="job-details pt_110 pb_120">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="job-sidebar mr_40">
                            <div class="info-widget sidebar-widget mb_30">
                                <ul class="clearfix">
                                    <li>
                                        <h5>Location</h5>
                                        <p>San Fransisco, Californ</p>
                                    </li>
                                    <li>
                                        <h5>Website</h5>
                                        <p><a href="{{ route('jobDetails') }}">http://www.example.com</a></p>
                                    </li>
                                    <li>
                                        <h5>Salary</h5>
                                        <p>$200 - $300 Per  Month</p>
                                    </li>
                                    <li>
                                        <h5>Experience Need</h5>
                                        <p>2-3 Yrs</p>
                                    </li>
                                    <li>
                                        <h5>Apply Within</h5>
                                        <p>25th March, 2025</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="requirements-widget sidebar-widget">
                                <h3>Requirements</h3>
                                <ul class="clearfix">
                                    <li><span>Age :</span> 25th March, 2025</li>
                                    <li><span>Sex :</span> Male/ Female</li>
                                    <li><span>Education :</span> CSE enginear</li>
                                    <li><span>Experience :</span> 1-3 Yrs</li>
                                    <li><span>Skills :</span> Something Related this Job</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="job-details-content">
                            <div class="text-box mb_60">
                                <h3>Job Description</h3>
                                <p>A Software Engineer is a professional who applies engineering principles to the design, development, maintenance, testing, and evaluation of software and systems that make computers or devices function effectively.</p>
                                <p>Software Engineers are proficient in various programming languages and tools, and they continuously update their skills to keep pace with the ever-evolving technology landscape.</p>
                            </div>
                            <div class="text-box mb_55">
                                <h3>Responsibilities</h3>
                                <ul class="list-item">
                                    <li>Collaborate with stakeholders to understand the requirements</li>
                                    <li>Design the overall structure of the software system, including system </li>
                                    <li>Choose appropriate technologies and frameworks to meet project requirements.</li>
                                    <li>Review code written by peers to ensure quality and adherence to standards.</li>
                                    <li>Participate in project planning, including estimating timelines and resources needed.</li>
                                    <li>Optimize software for performance, scalability, and efficiency.</li>
                                </ul>
                            </div>
                            <div class="text-box mb_65">
                                <h3>Advantages</h3>
                                <p>A Software Engineer is a professional who applies engineering principles to the design, development, maintenance, testing, and evaluation of software and systems that make computers or devices function effectively.</p>
                                <p>Software Engineers are proficient in various programming languages and tools, and they continuously update their skills to keep pace with the ever-evolving technology landscape.</p>
                            </div>
                            <ul class="share-box">
                                <li><h5>Share On:</h5></li>
                                <li><a href="{{ route('jobDetails') }}"><i class="icon-22"></i></a></li>
                                <li><a href="{{ route('jobDetails') }}"><i class="icon-23"></i></a></li>
                                <li><a href="{{ route('jobDetails') }}"><i class="icon-24"></i></a></li>
                                <li><a href="{{ route('jobDetails') }}"><i class="icon-25"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- job-details end -->

@endsection


