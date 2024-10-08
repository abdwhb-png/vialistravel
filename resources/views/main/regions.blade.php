@extends('layouts.main')

@section('hero')
@endsection

@section('trip-finder')
    <x-main.trip-finder></x-main.trip-finder>
@endsection

@section('content')
    <main subpage-our-trips="">
        <div subpage-middle="">
            <br>
            <x-main.regions-repeater></x-main.regions-repeater>

            <div destinations="wrapper" hide="sm md">
                @foreach ($destinations as $k => $desti)
                    <div destinations="col {{ $k + 1 }}">
                        @foreach ($desti as $region)
                            <div destinations="group" enso="">
                                <h2 group="header">
                                    <a href="{{ $region->permalink }}"> {{ $region->title }}</a>
                                </h2>
                                <div group="links">
                                    @foreach ($region->countries as $c)
                                        <a
                                            href="{{ route('our-trips', ['country' => $c->permalink]) }}">{{ $c->title }}</a><br>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </main>
@endsection
