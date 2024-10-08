@extends('layouts.main')

@section('hero')
@endsection

@section('trip-finder')
    <x-main.trip-finder></x-main.trip-finder>
@endsection

@section('content')
    <div main="wrapper">
        <main subpage="wrapper search">
            <div subpage="middle">
                <div repeater-wrapper="" settings="vertical">
                    <h2 search-results="headline">
                        {{ count(app('request')->input()) ? 'Search Results' : 'Our Trips' }}
                    </h2>
                    <div class="js-search-error-generic {{ $trips->count() ? 'hide' : 'show' }}" enso="">
                        Sorry, there are no trips that match your criteria. Please try another search. We also offer custom
                        departures year-round on many of our adventures. Please call an Adventure Specialist for more
                        information at {{ $site_settings->phone }}.
                    </div>
                    <x-main.trips-repeater :$trips></x-main.trips-repeater>
                </div>
            </div>
        </main>
    </div>
@endsection
