@extends('layouts.main')

@section('hero')
    <x-main.hero :pageName="$page->name" :list="$bread"></x-main.hero>
@endsection

@section('content')
    <div main="wrapper">
        <input mobile-nav-section="toggle" id="mobile-nav-section" type="checkbox" class="hide-off-canvas">
        <div tripnav-section="wrapper" js-tripnav-section-wrapper="" hide="lg+">
            <x-main.mobile-breadcrumb :pageName="$page->name" :list="$bread"></x-main.mobile-breadcrumb>
            <label tripnav-section="bar" for="mobile-nav-section">
                <div tripnav-section="hamburger"><span tripnav-section="icon"></span></div>
            </label>
        </div>
        {{-- SUBPAGE WRAPPER --}}
        <main subpage="wrapper subpage">
            <div subpage="middle">
                <div name="wrapper" enso="">
                    <h1>
                        Our mission is conservation through exploration: protecting our planet by inspiring travelers.
                    </h1>
                </div>
                <div content="wrapper" enso="">
                    {!! $page->content !!}
                </div>
            </div>

            <div trip-name-vert="wrapper 1">
                <div trip-name-vert="sticky">
                    {{ $sectionTitle }}
                </div>
            </div>
        </main>
    </div>
@endsection
