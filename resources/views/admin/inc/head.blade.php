<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="4200">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('admin/assets') }}/img/favicon.png">
    <title>
        Portal {{ $page_title }}
    </title>

    <style>
        #page-html * {
            font-size: 0.875rem !important;
            line-height: 1.5;
        }

        .link-blue {
            color: #2152ff;
        }

        .text-u {
            text-decoration: underline !important;
        }

        .indic {
            font-size: 0.75em !important;
            margin-bottom: 0;
        }

        #fixedMiddle {
            position: fixed;
            top: 50%;
            z-index: 99;
        }
    </style>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('admin/assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin/assets') }}/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />

    <!--   Core JS Files   -->
    @include('admin.inc.scripts')

    @vite(['resources/js/admin.js'])
</head>
