@extends('frontend.layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/error.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $breadcrumb='false';
@endphp

@section('content')

        <!-- error-section -->
        <section class="error-section centred pt_200 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-25.png') }}')"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>404</h1>
                    <h3>Page Not Found</h3>
                    <p>This page doesn’t exist or was removed! We suggest you <br />go back to home.</p>
                    <a href="{{ route('home') }}" class="theme-btn btn-one">Back to Homepage</a>
                </div>
            </div>
        </section>
        <!-- error-section end -->

@endsection


