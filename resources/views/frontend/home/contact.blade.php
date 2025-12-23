@extends('layouts.layout')

@php
    $title='Contact us';
    $subTitle='Contact us';
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/contact.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
@endphp

@section('content')

        <!-- contact-section -->
        <section class="contact-section pt_110 pb_30">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-12 col-sm-12 info-column">
                            <div class="info-box">
                                <h3>Contact Information</h3>
                                <div class="single-item">
                                    <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-27.png') }}" alt=""></div>
                                    <h4>Corporate Office</h4>
                                    <p>0233 Brisbane Cir. Shiloh, Australia 81063</p>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-27.png') }}" alt=""></div>
                                    <h4>Main Warehouse</h4>
                                    <p>10445 Brisbane Cir. Shiloh, Australia 81063</p>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-28.png') }}" alt=""></div>
                                    <h4>Email Address</h4>
                                    <p><a href="mailto:support@example.com">support@example.com</a><br /><a href="mailto:contact@example.com">contact@example.com</a></p>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-29.png') }}" alt=""></div>
                                    <h4>Phone Number</h4>
                                    <p><a href="tel:2085440141">+(208) 544 -0141</a><br /><a href="tel:2085440142">+(208) 544 -0142</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                            <div class="form-inner">
                                <form method="post" action="#" id="contact-form">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Name <span>*</span></label>
                                            <input type="text" name="username" placeholder="" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label>Phone <span>*</span></label>
                                            <input type="text" name="phone" placeholder="" required>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Email Address <span>*</span></label>
                                            <input type="email" name="email" placeholder="" required>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Subject <span>*</span></label>
                                            <input type="text" name="subject" placeholder="" required>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>Write Message <span>*</span></label>
                                            <textarea name="message" placeholder=""></textarea>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one" name="submit-form">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-section end -->

        <!-- google-map -->
        <section class="google-map pb_80">
            <div class="auto-container">
                <div class="inner-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55945.16225505631!2d-73.90847969206546!3d40.66490264739892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1601263396347!5m2!1sen!2sbd" width="100%" height="500" frameborder="0" style="border:0; width: 100%" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </section>
        <!-- google-map end -->

@endsection


