@extends('frontend.layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/service-details.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title='Workforce System';
    $subTitle='Solutions Details';   
@endphp

@section('content')

        <!-- service-details -->
        <section class="service-details pt_110 pb_120">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="service-sidebar mr_40">
                            <div class="category-widget mb_40">
                                <ul class="category-list clearfix">
                                    <li><a href="{{ route('serviceDetails') }}">Executive Search <i class="icon-42"></i></a></li>
                                    <li><a href="{{ route('serviceDetails2') }}">Training Session <i class="icon-42"></i></a></li>
                                    <li><a href="{{ route('serviceDetails3') }}">Career Growth <i class="icon-42"></i></a></li>
                                    <li><a href="{{ route('serviceDetails4') }}">Payroll Services <i class="icon-42"></i></a></li>
                                    <li><a href="{{ route('serviceDetails5') }}" class="current">Workforce System <i class="icon-42"></i></a></li>
                                    <li><a href="{{ route('serviceDetails6') }}">Temporary Jobs <i class="icon-42"></i></a></li>
                                </ul>
                            </div>
                            <div class="download-widget">
                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-24.png') }}')"></div>
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('assets/images/resource/book-3.png') }}" alt=""></figure>
                                    <h4>The 2025 guide for Optimal Content <span>Management</span></h4>
                                    <button type="button" class="theme-btn btn-one">Download E-book</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="service-details-content">
                            <div class="sec-title mb_70">
                                <span class="sub-title mb_10">Workforce System</span>
                                <h2>The Executive Search Process for Optimal Results</h2>
                                <p class="mt_20">The executive search process is meticulously designed to identify and attract top-tier leadership talent that aligns with an organization’s strategic goals.</p>
                            </div>
                            <figure class="image-box mb_30"><img src="{{ asset('assets/images/service/service-12.jpg') }}" alt=""></figure>
                            <div class="text-box mb_110">
                                <p class="mb_25">It begins with a thorough understanding of the company’s needs, culture, and long-term vision, ensuring that the search is precisely targeted.</p>
                                <p>Leveraging an extensive network and advanced assessment tools, executive search firms meticulously evaluate candidates’ qualifications, experience, and leadership capabilities. The process includes rigorous interviews, reference checks, and often psychometric testing to ensure a comprehensive evaluation.</p>
                            </div>
                            <div class="text-box mb_70">
                                <h2>Finding You The Leaders Of Tomorrow</h2>
                                <p>Trouble that are bound to ensue; and equaly blame belongs those who fail in their duty through weakness of will which is the same as saying through shrinking from toil and pain.</p>
                            </div>
                            <div class="tabs-box mb_50">
                                <ul class="tab-btns tab-buttons">
                                    <li class="tab-btn active-btn" data-tab="#tab-1"><i class="icon-43"></i>Short Time Hiring</li>
                                    <li class="tab-btn" data-tab="#tab-2"><i class="icon-43"></i>Last Minute Hiring</li>
                                    <li class="tab-btn" data-tab="#tab-3"><i class="icon-43"></i>Immediate Hiring</li>
                                </ul>
                                <div class="tabs-content">
                                    <div class="tab active-tab" id="tab-1">
                                        <div class="inner-box">
                                            <figure class="image-box"><img src="{{ asset('assets/images/service/service-8.jpg') }}" alt=""></figure>
                                            <div class="content-box">
                                                <h6>Short Time Hiring</h6>
                                                <p>Lorem ipsum dolor sit amet consectetur. Consequat tellus proin massa lacus. Arcu ullamcorper proin urna rhoncus odio</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-2">
                                        <div class="inner-box">
                                            <figure class="image-box"><img src="{{ asset('assets/images/service/service-8.jpg') }}" alt=""></figure>
                                            <div class="content-box">
                                                <h6>Last Minute Hiring</h6>
                                                <p>Lorem ipsum dolor sit amet consectetur. Consequat tellus proin massa lacus. Arcu ullamcorper proin urna rhoncus odio</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-3">
                                        <div class="inner-box">
                                            <figure class="image-box"><img src="{{ asset('assets/images/service/service-8.jpg') }}" alt=""></figure>
                                            <div class="content-box">
                                                <h6>Immediate Hiring</h6>
                                                <p>Lorem ipsum dolor sit amet consectetur. Consequat tellus proin massa lacus. Arcu ullamcorper proin urna rhoncus odio</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-box">
                                <p class="mb_25">Lorem ipsum dolor sit amet consectetur. Mi luctus at sapien viverra enim pharetra augue. Aliquam tellus amet est amet in non sem adipiscing urna. Neque etiam eu pellentesque velit ultricies dictumst mauris tortor hac.</p>
                                <p>Elit morbi maecenas sit viverra nibh elementum bibendum arcu a. Suscipit magna vitae nulla aenean suspendisse scelerisque montes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-details end -->

@endsection


