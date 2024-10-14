<?php

namespace App\Http\Controllers;

use App\Models\HomeGallery;
use Illuminate\Http\Request;

class HomeGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin/manage-gallery');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeGallery $homeGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeGallery $homeGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeGallery $homeGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeGallery $homeGallery)
    {
        //
    }
}
