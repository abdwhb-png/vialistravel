<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h5 class="h5 text-xl text-gray-800 leading-tight">{{ __("You're logged in, ") }}
                        {{ auth()->user()->full_name ?? auth()->user()->username }}</h5>
                    <br>
                    Welcome to your Adventure Portal, where you can access important documents for your future trips
                    with Natural Habitat Adventures and share photos and videos from your past adventures. Click the
                    trips below to get started.
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h5 class="h5 text-xl text-gray-800 leading-tight">
                        <bi class="bi-calandar-check"></bi> Upcoming Adventures
                    </h5>
                    <br>
                    You currently have no future adventures booked.
                    Visit <a class="" href="{{ route('home') }}">our website</a> to select your
                    next adventure,
                    or call <span class="text-warning">{{ $site_settings->phone }}</span> to speak with an Adventure
                    Specialist.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
