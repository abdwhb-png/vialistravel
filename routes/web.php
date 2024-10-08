<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/conservation/{slug}', 'conservation')->name('conservation');
    Route::get('/our-story/{slug}', 'ourStory')->name('our-story');
    Route::get('/traveler-resources/{slug}', 'travelerResources')->name('traveler-resources');
    Route::get('/legal/{slug}', 'legal')->name('legal');

    Route::get('/our-trips', 'ourTrips')->name('our-trips');
    // Route::get('/search', 'ourTrips')->name('search');
    Route::get('/region/{slug?}', 'region')->name('region');
    Route::get('/trip/{trip_section?}/{slug}', 'trip')->name('trip');
    Route::get('/regions', 'regions')->name('regions');

    Route::get('/contact', function () {
        return view('main.more.contact-us');
    })->name('contact-us');
    Route::get('/awards-media-press', function () {
        return view('main.more.awards-media-press');
    })->name('awards, media & press');
    Route::get('/quality-value-guarantee', function () {
        return view('main.conservation.quality-value-guarantee');
    })->name('quality-value-guarantee');
    Route::get('/carbon-neutral-travel', function () {
        return view('main.conservation.carbon-neutral-travel');
    })->name('carbon-neutral-travel');
    Route::get('/reduicing-waste', function () {
        return view('main.conservation.reduicing-waste');
    })->name('reduicing-waste');

    Route::post('/modal-form/{section?}', 'modalForm')->name('modal-form');
    Route::get('/confirmation', function () {
        return view('main.confirmation');
    })->name('confirmation');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';