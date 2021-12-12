<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactController;
use Modules\Contact\Http\Controllers\Setting\CityController;
use Modules\Contact\Http\Controllers\Setting\CountryController;
use Modules\Contact\Http\Controllers\Setting\StateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('contact.')->group(function() {
    Route::prefix('settings')->name('settings.')->group(function () {
        //Country
        Route::resource('countries', CountryController::class)->where(['country' => '([0-9]+)']);
        Route::prefix('countries')->name('countries.')->group(function () {
            Route::patch('{user}/restore', [CountryController::class, 'restore'])->name('restore');
            Route::get('export', [CountryController::class, 'export'])->name('export');
            Route::get('import', [CountryController::class, 'import'])->name('import');
            Route::post('import', [CountryController::class, 'importBulk']);
            Route::post('print', [CountryController::class, 'print'])->name('print');
        });

        //State
        Route::resource('states', StateController::class)->where(['state' => '([0-9]+)']);
        Route::prefix('states')->name('states.')->group(function () {
            Route::patch('{permission}/restore', [StateController::class, 'restore'])->name('restore');
            Route::get('/export', [StateController::class, 'export'])->name('export');
            Route::get('/import', [StateController::class, 'import'])->name('import');
            Route::post('/import', [StateController::class, 'importBulk']);
            Route::post('/print', [StateController::class, 'print'])->name('print');
        });

        //City
        Route::resource('cities', CityController::class)->where(['city' => '([0-9]+)']);
        Route::prefix('cities')->name('cities.')->group(function () {
            Route::patch('{role}/restore', [CityController::class, 'restore'])->name('restore');
            Route::get('permission', [CityController::class, 'permission'])->name('permission');
            Route::get('export', [CityController::class, 'export'])->name('export');
            Route::get('import', [CityController::class, 'import'])->name('import');
            Route::post('import', [CityController::class, 'importBulk']);
            Route::post('print', [CityController::class, 'print'])->name('print');
            Route::get('ajax', [CityController::class, 'ajax'])->name('ajax')->middleware('ajax');
        });
    });
});

Route::prefix('contact')->name('contact.')->group(function() {
    Route::get('/', [ContactController::class, 'index']);
});
