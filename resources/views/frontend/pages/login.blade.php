@extends('frontend.layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/login.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title='Login';
    $subTitle='Login';
@endphp

@section('content')

        <!-- sign-section -->
        <section class="sign-section pt_110 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-25.png') }}')"></div>
            <div class="auto-container">
                <div class="form-inner">
                    <form method="post" action="{{ route('login') }}">
                        <div class="form-group">
                            <label>Email <span>*</span></label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password <span>*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="form-group message-btn">
                            <button type="submit" class="theme-btn btn-one">Log In</button>
                        </div>
                        <span class="text">or</span>
                        <ul class="social-links clearfix">
                            <li>
                                <a href="{{ route('login') }}"><img src="{{ asset('assets/images/icons/icon-25.png') }}" alt="">Continue with Google</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}"><img src="{{ asset('assets/images/icons/icon-26.png') }}" alt="">Continue with Facebook</a>
                            </li>
                        </ul>
                    </form>
                    <div class="other-option">
                        <div class="check-box">
                            <input class="check" type="checkbox" id="checkbox1">
                            <label for="checkbox1">Remember me</label>
                        </div>
                        <button class="forgot-password">Forget password?</button>
                    </div>
                    <div class="lower-text centred"><p>Not registered yet? <a href="{{ route('signup') }}">Create an Account</a></p></div>
                </div>
            </div>
        </section>
        <!-- sign-section end -->

@endsection

