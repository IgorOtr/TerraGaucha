<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', function () { return view('index'); })->name('home'); 

Route::group(["prefix" => "Admin"], function () {

    Route::get('/', function () { return view('Admin.index'); })->name('home-admin'); 

    Route::group(["prefix" => "Locations"], function () {

        Route::get('/manage', [LocationController::class, 'index'])->name('manage-locations'); 
        Route::post('/add-location', [LocationController::class, 'store'])->name('add-location');
    });

    // Route::group(["prefix" => "Contact"], function () {

    //     Route::get('/manage', [LocationController::class, 'index'])->name('manage-locations'); 
    //     Route::post('/add-location', [LocationController::class, 'store'])->name('add-location');
    // });

});
