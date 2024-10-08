@extends('layouts.main')

@section('hero')
    <x-main.hero heroImd="{{ asset('assets/images/404-hero.jpg') }}"></x-main.hero>
@endsection

@section('content')
    <main subpage="wrapper 404">
        <div subpage="middle">
            <div name="wrapper">
                <h1 style="color: green">Thank you for your submission!</h1>
            </div>
            <div content="wrapper">
                <div am-subpage="text">
                    We have received your message and will get back to you as soon as possible.
                </div>
            </div>
        </div>
    </main>
@endsection
