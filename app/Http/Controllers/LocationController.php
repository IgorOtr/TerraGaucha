<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.manage-locations');
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
        dd($request->all());

        $validated = $request->validate([
            'loc_name' => 'required',
            'loc_phone' => 'required',
            'loc_address' => 'required',
            'loc_resume' => 'required'
        ]);

        $location = new Location();

        $location->loc_name = $validated['loc_name'];
        $location->loc_phone = $validated['loc_phone'];
        $location->loc_address = $validated['loc_address'];
        $location->loc_resume = $validated['loc_resume'];

        if ($candidato->save()) {

            return redirect()->route('manage-locations')->with('message', 'Location criada com sucesso.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
