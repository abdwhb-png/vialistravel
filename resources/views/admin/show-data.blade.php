@extends('layouts.admin')


@section('navbar')
    <x-admin.navbar :pageName="str_replace('s', '', $type) . ' view'"></x-admin.navbar>
@endsection

@section('content')
    <x-admin.show-data-header :$type :$item :$deleteRoute> </x-admin.show-data-header>

    @if ($type == 'regions')
        <x-admin.show-region :$type :$item></x-admin.show-region>
    @elseif($type == 'trips')
        <x-admin.show-trip :$type :$item></x-admin.show-trip>
    @elseif($type == 'countries')
        <x-admin.show-country :$item></x-admin.show-country>
    @elseif($type == 'interests')
        <x-admin.show-interest :$item></x-admin.show-interest>
    @elseif($type == 'wildlives')
        <x-admin.show-wildlife :$item></x-admin.show-wildlife>
    @endif
@endsection
