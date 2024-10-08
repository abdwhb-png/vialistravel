<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\UpdateController;

// Route::fallback(function () {
//     return redirect()->to('/');
// });

Route::get('/enter-portal', function () {
    return redirect('/login');
})->name('enter-portal');

Route::domain('portal.' . env('APP_URL'))->name('portal.')->group(function () {
    Route::get('join-staff', function () {
        return view('auth.join-staff');
    })->name('join-staff')->middleware('guest');

    Route::middleware(['auth', 'role:admin|superadmin|root'])->group(function () {
        Route::get('/', function () {
            return redirect('/dashboard');
        });

        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/trips', 'trips')->name('trips');
            Route::get('/regions', 'regions')->name('regions');
            Route::get('/legal-pages', 'legalPages')->name('legalPages');
            Route::get('/site-pages', 'sitePages')->name('sitePages');
            Route::any('/restore-page/{id}', 'restorePage')->name('restorePage');
            Route::get('/data/{type}/{id}', 'showData')->name('showData');
        });

        Route::controller(CreateController::class)->group(function () {
            Route::post('/create-page', 'createPage')->name('createPage');
            Route::post('/create-data/{type}', 'createData')->name('createData');
        });

        Route::controller(UpdateController::class)->group(function () {
            Route::post('/update-settings', 'updtSettings')->name('updt-settings');
            Route::post('/update-social-links', 'updtSocialLinks')->name('updt-socialLinks');
            Route::post('/update-page/{type}/{id}', 'updtPage')->name('updt-page');
            Route::post('/update-data/{type}', 'updtData')->name('updt-data');

            Route::post('/interest-regions', 'interestRegions')->name('interest-regions');
            Route::post('/wildlife-regions', 'wildlifeRegions')->name('wildlife-regions');
            Route::post('/country-region', 'countryRegion')->name('country-region');
            Route::post('/update-trip/{section}', 'updateTrip')->name('update-trip');
            Route::post('/update-region/{section}', 'updateRegion')->name('update-region');
        });

        Route::controller(DeleteController::class)->group(function () {
            Route::any('/delete-page/{page}', 'deletePage')->name('deletePage');
            Route::any('/delete-data/{type}/{id?}', 'deleteData')->name('deleteData');
            Route::post('/mass-delete-data/{type}/{id?}', 'massDeleteData')->name('massDeleteData');
        });

        Route::controller(MediaController::class)->group(function () {
            Route::post('/upload-data-media/{type}', 'uplDataMedia')->name('uplDataMedia');
            Route::any('/delete-trip-photo/{id?}', 'deleteTripPhoto')->name('deleteTripPhoto');
        });
    });
});
