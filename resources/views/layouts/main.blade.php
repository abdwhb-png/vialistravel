<!DOCTYPE html>
<html lang="en" class="js-scroll-trigger">

@include('main.inc.head')

<body js-set-gradient gradient='{{ in_array(Route::currentRouteName(), ['our-trips', 'regions']) ? 'light' : 'dark' }}'>
    {{-- HEADER --}}
    <x-main.header></x-main.header>
    {{-- HERO --}}
    @section('hero')
        <x-main.hero></x-main.hero>
    @show
    {{-- TRIP FINDER --}}
    @section('trip-finder')
    @show

    @yield('content')

    {{-- NEWSLETTER --}}
    @include('main.inc.newsletter')
    {{-- AWARDS --}}
    @include('main.inc.reputation')


    {{-- FOOTER --}}
    <x-main.footer></x-main.footer>

    <!-- Magic CTA -->
    @include('main.inc.cta')


    <!-- Modals -->
    <x-main.modals></x-main.modals>


    <!-- Mobile nav site -->
    @include('main.inc.mobile-nav')

    <!-- For pdf generation -->
    <!-- Page url for PDF generation -->
    <div hide="all" class="js-page-url">/</div>


    <!-- Schema -->
    @include('main.inc.scripts')
</body>

</html>
