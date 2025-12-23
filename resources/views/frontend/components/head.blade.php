<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - Kagzi' : 'Kagzi - InfoTech' }}</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/odometer.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/elpath.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/color.css') }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/purple-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/module-css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/module-css/page-title.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/module-css/service-details.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/module-css/footer.css') }}" rel="stylesheet">

    <!-- Custom Global CSS -->
    <style>
    :root {
        --primary-color: #977EFF;
        --secondary-color: #7A5FD6;
        --light-gray: #F8F6FF;
        --border-gray: #E8DFFE;
        --text-color: #666;
        --dark-text: #111;
    }

    /* Utility Classes */
    .pt_120 { padding-top: 120px; }
    .pb_90 { padding-bottom: 90px; }
    .pt_100 { padding-top: 100px; }
    .pb_100 { padding-bottom: 100px; }
    .mb_10 { margin-bottom: 10px; }
    .mb_20 { margin-bottom: 20px; }
    .mb_30 { margin-bottom: 30px; }
    .mb_50 { margin-bottom: 50px; }
    .mb_60 { margin-bottom: 60px; }
    .mr_10 { margin-right: 10px; }
    .mt_15 { margin-top: 15px; }
    .mt_50 { margin-top: 50px; }

    /* Section Title Styles */
    .sec-title h2 {
        font-size: 36px;
        font-weight: 700;
        color: var(--dark-text);
        margin: 15px 0;
    }

    .sec-title .sub-title {
        display: inline-block;
        background-color: rgba(151, 126, 255, 0.1);
        color: var(--primary-color);
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    /* Button Styles */
    .theme-btn {
        display: inline-block;
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-one {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-one:hover {
        background-color: #6B4FCC;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(151, 126, 255, 0.3);
    }

    /* Form Styles */
    .form-group input,
    .form-group textarea,
    .form-group select {
        border: 1px solid var(--border-gray);
        border-radius: 6px;
        padding: 12px 15px;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(151, 126, 255, 0.1);
    }
    </style>

    <?php echo (isset($css) ? $css : '')?>
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
</head>

