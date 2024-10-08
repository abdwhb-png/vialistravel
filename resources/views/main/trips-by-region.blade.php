@extends('layouts.main')

@section('hero')
    <x-main.hero :heroImg="$item->medias()['hero']" :pageName="$item->title" :list="$bread"></x-main.hero>
@endsection

@section('content')
    <div main="wrapper">
        <main subpage="wrapper destination-w-repeater">
            <div subpage="middle">
                <div content="wrapper" enso="">
                    {!! $item->description !!}
                </div>

                <div repeater-wrapper="" settings="vertical">
                    <div repeater="title destination" js-destination-title="1" enso="">{{ $item->title . ' Trips' }}
                    </div>
                    <x-main.trips-repeater :trips="$item->trips"></x-main.trips-repeater>
                </div>

            </div>

            <div trip-name-vert="wrapper 1">
                <div trip-name-vert="sticky">
                    {{ $item->title }}
                </div>
            </div>
        </main>
    </div>
@endsection
