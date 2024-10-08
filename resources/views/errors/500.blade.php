@extends('layouts.main')

@section('hero')
    <x-main.hero heroImg="{{ asset('assets/images/error-500.png') }}"></x-main.hero>
@endsection

@section('content')
    <main subpage="wrapper 404">
        <div subpage="middle">
            <div name="wrapper">
                <h1 style="color: red">500 Internal Server Error!</h1>
            </div>
            <div content="wrapper">
                <div am-subpage="text">
                    <h2>{{ session('error') ?? 'Something went wrong. Please try again later.' }}</h2>
                    <h5>{{ env('APP_DEBUG') ? $exception->getMessage() : 'Contact your web master' }}</h5>
                </div>
            </div>
        </div>
    </main>
@endsection
