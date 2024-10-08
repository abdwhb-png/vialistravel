<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Enter portal | {{ $site_name }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" js-set-favicon />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 auth-bg">

        <div class="w-full sm:max-w-md mt-6 px-6 py-6 login-wrap shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6">
                <a href="/" style="text-align: center">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    <h2 class="h2">{{ $site_name }} PORTAL</h2>
                </a>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
