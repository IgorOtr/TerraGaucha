<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeGalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromocoesController;

Route::get('/', function () { return view('index'); })->name('home');
Route::get('/locations', function () { return view('locations'); })->name('locations');
Route::get('/our-story', function () { return view('our-story'); })->name('our-story');
Route::get('/contact-us', function () { return view('contact-us'); })->name('contact-us');
Route::get('/faqs', function () { return view('faqs'); })->name('faqs'); 
Route::get('/reservation', function () { return view('reservation'); })->name('reservation'); 
Route::get('/group-dining', function () { return view('group-dining'); })->name('group-dining'); 
Route::get('/terra-club', function () { return view('terra-club'); })->name('terra-club'); 
Route::get('/gift-cards', function () { return view('gift-cards'); })->name('gift-cards'); 
Route::get('/careers', function () { return view('careers'); })->name('careers'); 

Route::middleware('auth')->group(function () {

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
            Route::get('/edit/{id}', [PromocoesController::class, 'edit'])->name('edit-promo'); 
            Route::get('/delete/{id}', [PromocoesController::class, 'destroy'])->name('delete-promo'); 
            Route::post('/add-promotion', [PromocoesController::class, 'store'])->name('add-promotion');
            Route::post('/update-promotion', [PromocoesController::class, 'update'])->name('update-promotion');
        });
    
        Route::group(["prefix" => "Contact"], function () {
    
            Route::get('/manage', [ContactController::class, 'index'])->name('manage-contacts'); 
        });

        Route::group(["prefix" => "Home-Gallery"], function () {
    
            Route::get('/manage', [HomeGalleryController::class, 'index'])->name('manage-home-gallery'); 
        });
    
    });
});

require __DIR__.'/auth.php';
