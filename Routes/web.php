<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\Individual\ContactController;
use Modules\Contact\Http\Controllers\Setting\BloodGroupController;
use Modules\Contact\Http\Controllers\Setting\CityController;
use Modules\Contact\Http\Controllers\Setting\CountryController;
use Modules\Contact\Http\Controllers\Setting\GenderController;
use Modules\Contact\Http\Controllers\Setting\OccupationController;
use Modules\Contact\Http\Controllers\Setting\RelationController;
use Modules\Contact\Http\Controllers\Setting\ReligionController;
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

Route::name('contact.')->group(function () {
    Route::prefix('settings')->name('settings.')->group(function () {
        //Country
        Route::resource('countries', CountryController::class)->where(['country' => '([0-9]+)']);
        Route::prefix('countries')->name('countries.')->group(function () {
            Route::patch('{country}/restore', [CountryController::class, 'restore'])->name('restore');
            Route::get('export', [CountryController::class, 'export'])->name('export');
            Route::get('import', [CountryController::class, 'import'])->name('import');
            Route::post('import', [CountryController::class, 'importBulk']);
            Route::post('print', [CountryController::class, 'print'])->name('print');
        });

        //State
        Route::resource('states', StateController::class)->where(['state' => '([0-9]+)']);
        Route::prefix('states')->name('states.')->group(function () {
            Route::patch('{state}/restore', [StateController::class, 'restore'])->name('restore');
            Route::get('/export', [StateController::class, 'export'])->name('export');
            Route::get('/import', [StateController::class, 'import'])->name('import');
            Route::post('/import', [StateController::class, 'importBulk']);
            Route::post('/print', [StateController::class, 'print'])->name('print');
        });

        //City
        Route::resource('cities', CityController::class)->where(['city' => '([0-9]+)']);
        Route::prefix('cities')->name('cities.')->group(function () {
            Route::patch('{city}/restore', [CityController::class, 'restore'])->name('restore');
            Route::get('export', [CityController::class, 'export'])->name('export');
            Route::get('import', [CityController::class, 'import'])->name('import');
            Route::post('import', [CityController::class, 'importBulk']);
            Route::post('print', [CityController::class, 'print'])->name('print');
            Route::get('ajax', [CityController::class, 'ajax'])->name('ajax')->middleware('ajax');
        });

        //Blood Group
        Route::resource('blood-groups', BloodGroupController::class)->where(['blood-group' => '([0-9]+)']);
        Route::prefix('blood-groups')->name('blood-groups.')->group(function () {
            Route::patch('{blood-group}/restore', [BloodGroupController::class, 'restore'])->name('restore')->where(['blood-group' => '([0-9]+)']);
            Route::get('export', [BloodGroupController::class, 'export'])->name('export');
            Route::get('import', [BloodGroupController::class, 'import'])->name('import');
            Route::post('import', [BloodGroupController::class, 'importBulk']);
            Route::post('print', [BloodGroupController::class, 'print'])->name('print');
            Route::get('ajax', [BloodGroupController::class, 'ajax'])->name('ajax')->middleware('ajax');
        });

        //Gender
        Route::resource('genders', GenderController::class)->where(['gender' => '([0-9]+)']);
        Route::prefix('genders')->name('genders.')->group(function () {
            Route::patch('{gender}/restore', [GenderController::class, 'restore'])->name('restore');
            Route::get('export', [GenderController::class, 'export'])->name('export');
            Route::get('import', [GenderController::class, 'import'])->name('import');
            Route::post('import', [GenderController::class, 'importBulk']);
            Route::post('print', [GenderController::class, 'print'])->name('print');
            Route::get('ajax', [GenderController::class, 'ajax'])->name('ajax')->middleware('ajax');
        });

        //Occupation
        Route::resource('occupations', OccupationController::class)->where(['occupation' => '([0-9]+)']);
        Route::prefix('occupations')->name('occupations.')->group(function () {
            Route::patch('{occupation}/restore', [OccupationController::class, 'restore'])->name('restore');
            Route::get('export', [OccupationController::class, 'export'])->name('export');
            Route::get('import', [OccupationController::class, 'import'])->name('import');
            Route::post('import', [OccupationController::class, 'importBulk']);
            Route::post('print', [OccupationController::class, 'print'])->name('print');
            Route::get('ajax', [OccupationController::class, 'ajax'])->name('ajax')->middleware('ajax');
        });

        //Relation
        Route::resource('relations', RelationController::class)->where(['relation' => '([0-9]+)']);
        Route::prefix('relations')->name('relations.')->group(function () {
            Route::patch('{relation}/restore', [RelationController::class, 'restore'])->name('restore');
            Route::get('export', [RelationController::class, 'export'])->name('export');
            Route::get('import', [RelationController::class, 'import'])->name('import');
            Route::post('import', [RelationController::class, 'importBulk']);
            Route::post('print', [RelationController::class, 'print'])->name('print');
            Route::get('ajax', [RelationController::class, 'ajax'])->name('ajax')->middleware('ajax');
        });

        //Religion
        Route::resource('religions', ReligionController::class)->where(['religion' => '([0-9]+)']);
        Route::prefix('religions')->name('religions.')->group(function () {
            Route::patch('{religion}/restore', [ReligionController::class, 'restore'])->name('restore');
            Route::get('export', [ReligionController::class, 'export'])->name('export');
            Route::get('import', [ReligionController::class, 'import'])->name('import');
            Route::post('import', [ReligionController::class, 'importBulk']);
            Route::post('print', [ReligionController::class, 'print'])->name('print');
            Route::get('ajax', [ReligionController::class, 'ajax'])->name('ajax')->middleware('ajax');
        });

    });
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::prefix('individual')->group(function () {
        //Contact
        Route::resource('contacts', ContactController::class)->where(['contact' => '([0-9]+)']);
        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::patch('{contact}/restore', [ContactController::class, 'restore'])
                ->name('restore')->where(['contact' => '([0-9]+)']);
            Route::get('export', [ContactController::class, 'export'])->name('export');
            Route::get('import', [ContactController::class, 'import'])->name('import');
            Route::post('import', [ContactController::class, 'importBulk']);
            Route::post('print', [ContactController::class, 'print'])->name('print');
        });
    });
});
