<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = DB::table('locations')->get();
        return view('Admin.manage-locations', compact('locations'));
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
       
        $validated = $request->validate([
            'loc_name' => 'required',
            'loc_phone' => 'required',
            'loc_address' => 'required',
            'loc_resume' => 'required',
            'loc_status' => 'required'
        ]);

        $location = new Location();
        $locationImages = new LocationImage();

        $imgCapa = $request->file('loc_capa');
        $img_name = md5($imgCapa->getClientOriginalName().time()) . '.' . $imgCapa->getClientOriginalExtension();
        $imgCapa->move('assets/img/capas_locations', $img_name);

        $location->loc_name = $validated['loc_name'];
        $location->loc_phone = $validated['loc_phone'];
        $location->loc_address = $validated['loc_address'];
        $location->loc_resume = $validated['loc_resume'];
        $location->loc_status = $validated['loc_status'];
        $location->loc_capa = $img_name;

        if ($location->save()) {

            $img = $request->file('loc_images');

            for ($i = 0; $i < count($img); $i++) { 
            
                $imgs = $img[$i];
                $imgs_name = md5($imgs->getClientOriginalName().time()) . '.' . $imgs->getClientOriginalExtension();
                
                if ($imgs->move('assets/img/locations', $imgs_name)) {
                    
                    $locationImages->img_name = $imgs_name;
                    $locationImages->loc_id = $location->id;
                    
                    $locationImages->save();
                }
            }   

            $message = 'Location criada com sucesso.';
            return view('Admin.manage-locations', compact('message'));

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
