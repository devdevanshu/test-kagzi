@extends('layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/faq.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/download.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title='Frequently Asked Question';
    $subTitle='Frequently Asked Question';
@endphp

@section('content')

        <!-- testimonial-page-section -->
        <section class="testimonial-page-section pt_110 pb_120">
            <div class="auto-container">
                <div class="row clearfix">
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
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-box ml_70">
                            <figure class="image image-hov-one"><img src="{{ asset('assets/images/resource/faq-1.jpg') }}" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-page-section end -->

        <!-- download-section -->
        <section class="download-section alternat-3 pb_120">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-20.png') }}')"></div>
                    <div class="row align-items-center">
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
                        <div class="col-lg-4 col-md-12 col-sm-12 image-column">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/resource/book-2.png') }}" alt=""></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- download-section end -->

@endsection


