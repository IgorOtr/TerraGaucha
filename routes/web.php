<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PromocoesController;

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

        Route::get('/manage', [NewsController::class, 'index'])->name('manage-news'); 
        Route::get('/edit/{slug}', [NewsController::class, 'edit'])->name('edit-news'); 
        Route::get('/delete/{slug}', [NewsController::class, 'destroy'])->name('delete-news'); 
        Route::post('/add-news', [NewsController::class, 'store'])->name('add-news');
        Route::post('/update-news', [NewsController::class, 'update'])->name('update-news');
    });

    Route::group(["prefix" => "Promocoes-e-Eventos"], function () {

        Route::get('/manage', [PromocoesController::class, 'index'])->name('manage-promo'); 
        // Route::get('/edit/{slug}', [NewsController::class, 'edit'])->name('edit-news'); 
        // Route::get('/delete/{slug}', [NewsController::class, 'destroy'])->name('delete-news'); 
        Route::post('/add-promotion', [PromocoesController::class, 'store'])->name('add-promotion');
        // Route::post('/update-news', [NewsController::class, 'update'])->name('update-news');
    });

    // Route::group(["prefix" => "Contact"], function () {

    //     Route::get('/manage', [LocationController::class, 'index'])->name('manage-locations'); 
    //     Route::post('/add-location', [LocationController::class, 'store'])->name('add-location');
    // });

});
