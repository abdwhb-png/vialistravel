@extends('layouts.main')

@section('trip-finder')
    <x-main.trip-finder></x-main.trip-finder>
@endsection

@section('content')
    {{-- SLIDER --}}
    <div class="js-slide-amount"></div>
    <h2 slider="header" enso>
        Nature News
    </h2>
    <x-main.slider></x-main.slider>
    <div slider="pager" js="slider-pager" hide="sm+"></div>

    {{-- MAIN REGIONS --}}
    <main homepage-regions>
        <div homepage-regions-middle>
            <p homepage-regions-headline>Trips by Region</p>
            <x-main.regions-repeater :$regions></x-main.regions-repeater>
        </div>
    </main>

    {{-- ABOUT --}}
    @include('main.inc.about')
@endsection
