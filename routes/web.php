<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', function () { return view('index'); })->name('home');

Route::group(["prefix" => "Admin"], function () {

    Route::get('/', function () { return view('Admin.index'); })->name('home-admin'); 
    Route::get('/faqs', function () { return view('faqs'); })->name('faqs'); 
    Route::get('/reservation', function () { return view('reservation'); })->name('reservation'); 

    Route::group(["prefix" => "Locations"], function () {

        Route::get('/manage', [LocationController::class, 'index'])->name('manage-locations'); 
        Route::get('/edit/{slug}', [LocationController::class, 'edit'])->name('edit-locations'); 
        Route::get('/delete/{slug}', [LocationController::class, 'destroy'])->name('delete-locations'); 
        Route::post('/add-location', [LocationController::class, 'store'])->name('add-location');
        Route::post('/update-location', [LocationController::class, 'update'])->name('update-location');
    });

    // Route::group(["prefix" => "Contact"], function () {

    //     Route::get('/manage', [LocationController::class, 'index'])->name('manage-locations'); 
    //     Route::post('/add-location', [LocationController::class, 'store'])->name('add-location');
    // });

});
