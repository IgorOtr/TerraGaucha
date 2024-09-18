<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', function () { return view('index'); })->name('home');

Route::group(["prefix" => "Admin"], function () {

    Route::get('/', function () { return view('Admin.index'); })->name('home-admin'); 

    Route::group(["prefix" => "Locations"], function () {

        Route::get('/manage', [LocationController::class, 'index'])->name('manage-locations'); 
        Route::get('/edit/{slug}', [LocationController::class, 'edit'])->name('edit-locations'); 
        Route::get('/delete/{slug}', [LocationController::class, 'destroy'])->name('delete-locations'); 
        Route::post('/add-location', [LocationController::class, 'store'])->name('add-location');
        Route::post('/update-location', [LocationController::class, 'update'])->name('update-location');
    });

    Route::group(["prefix" => "TerraNews"], function () {

        Route::get('/manage', function () { return view('Admin.manage-news'); })->name('manage-news'); 
        // Route::get('/edit/{slug}', [LocationController::class, 'edit'])->name('edit-news'); 
        // Route::get('/delete/{slug}', [LocationController::class, 'destroy'])->name('delete-news'); 
        // Route::post('/add-news', [LocationController::class, 'store'])->name('add-location');
        // Route::post('/update-news', [LocationController::class, 'update'])->name('update-news');
    });

    // Route::group(["prefix" => "Contact"], function () {

    //     Route::get('/manage', [LocationController::class, 'index'])->name('manage-locations'); 
    //     Route::post('/add-location', [LocationController::class, 'store'])->name('add-location');
    // });

});
