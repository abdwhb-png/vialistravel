@extends('layouts.main')

@section('hero')
    <x-main.hero heroImg="{{ asset('assets/images/error-404.jpg') }}"></x-main.hero>
@endsection

@section('content')
    <main subpage="wrapper 404">
        <div subpage="middle">
            <div name="wrapper">
                <h1>404 Error. This page is missing. We are looking for it!</h1>
            </div>
            <div content="wrapper">
                <div am-subpage="text">
                    Please try the following:<br><br>
                    <ul>
                        <li>Make sure the website address is spelled correctly.</li>
                        <li>Click the <a href="/">Back To Home</a> button and try another link.</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
