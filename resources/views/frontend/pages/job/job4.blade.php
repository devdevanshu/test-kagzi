@extends('layouts.layout')

@php
    $title='Job Apply';
    $subTitle='Job Apply'; 
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/job.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

        <!-- job-form-section -->
        <section class="job-form-section dark-section pt_110 pb_90">
            <div class="auto-container">
                <div class="sec-title centred pb_70 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">REQUEST NEEDED TALENT</span>
                    <h2 class="title-animation">Talented Professionals Needed</h2>
                    <p class="title-animation">We are on the lookout for talented professionals who are eager to contribute to our <br />innovative and dynamic team.</p>
                </div>
                <form method="post" action="{{ route('job') }}">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                            <div class="form-inner">
                                <div class="title-box">
                                    <div class="icon-box"><i class="icon-39"></i></div>
                                    <h3>Basic Infomation</h3>
                                    <p>Please fill out your contact person details here.</p>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="fname" placeholder="First Name" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="lname" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="phone" placeholder="Phone" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="address" placeholder="Address" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                            <div class="form-inner">
                                <div class="title-box">
                                    <div class="icon-box"><i class="icon-40"></i></div>
                                    <h3>Qualification</h3>
                                    <p>Please fill out your contact person details here.</p>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="education" placeholder="Education" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <div class="select-box">
                                            <select class="wide">
                                               <option data-display="Skills">Skills</option>
                                               <option value="1">Executive</option>
                                               <option value="2">Training</option>
                                               <option value="3">Career</option>
                                               <option value="4">Payroll</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="experience" placeholder="Experience" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="qualities" placeholder="Qualities" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <div class="upload-box">
                                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-24.png') }}" alt=""></div>
                                            <input name="files[]" id="filer_input" multiple="multiple" type="file">
                                            <button type="button">Upload Photo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-column">
                            <div class="form-inner">
                                <div class="form-group">
                                    <textarea name="message" placeholder="Additional Information..."></textarea>
                                </div>
                                <div class="form-group message-btn centred">
                                    <button type="submit" class="theme-btn btn-one">Apply For Job</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- job-form-section end -->

@endsection


