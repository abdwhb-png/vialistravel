<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ $site_name }} | {{ $page_name }}</title>
    <meta name="Description"
        content="{{ $site_name }} provides once-in-a-lifetime experiences, including African safaris, polar bear adventures, and Galapagos Islands cruises." />

    <!-- To index or not to index, that is the question  -->
    <meta name="robots" content='all' />

    <!-- Flavor Flavicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" js-set-favicon />

    <!-- Styles for all templates -->
    <link rel="preload"
        href="{{ asset('assets/css/global.css') . '?v=' . filemtime(public_path('assets/css/global.css')) }}"
        as="style" onload="this.rel='stylesheet'" />
    @if (Route::currentRouteName() != 'home')
        <link rel="stylesheet" href="{{ asset('assets/css/subpage.css') }}">
    @endif

    <!-- Styles for this template -->
    @if (Route::currentRouteName() == 'home')
        <link
            rel="stylesheet"href="/templates/homepage-video/styles2ac3.css?ckcachebust=04D0EE117CC3B7573A0F48E1E05F8ACB" />
    @elseif (Route::currentRouteName() == 'region')
        <link rel="stylesheet" href="{{ asset('assets/css/destination.css') }}">
    @elseif (Route::currentRouteName() == 'trip')
        <link rel="stylesheet" href="{{ asset('/assets/css/trip/' . request()->route('trip_section') . '.css') }}">
        @if (request()->route('trip_section') == 'reviews')
            <link rel="stylesheet" href="{{ asset('assets/css/trip/trip-reviews.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/trip/trip-reviews2.css') }}">
        @endif
        <link rel="stylesheet"
            href="/templates/subpage-w-repeater/style99f2.css?ckcachebust=B4FE60A8F8F292DCAAD60440D480EFB5">
    @elseif(in_array(Route::currentRouteName(), ['our-trips', 'regions']))
        <link rel="stylesheet" href="/templates/our-trips/stylef2b3.css?ckcachebust=B4FE60A8F8F292DCAAD60440D480EFB5">
        <link rel="stylesheet"
            href="/templates/search-results/style31e9.css?ckcachebust=B4FE60A8F8F292DCAAD60440D480EFB5">
    @else
    @endif

    <!-- Bip it, bop it, squish it, squash it -->
    <link rel="stylesheet"
        href="/cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min18c4.css?ckcachebust=744313577" />

    <!-- jQuery lives on (2023) -->
    <script src="/cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min18c4.js?ckcachebust=744313577"></script>
    <script defer src="/cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min18c4.js?ckcachebust=744313577"></script>

    <!-- Scripts -->
    @vite(['resources/js/main.js'])

</head>
