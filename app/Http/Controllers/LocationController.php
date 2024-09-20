<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

    public function toAscii($str, $replace = array(), $delimiter = '-')
	{
		if (!empty($replace)) {
			$str = str_replace((array)$replace, ' ', $str);
		}
		$clean = str_replace('�', 'c', $str);
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'loc_name' => 'required',
            'loc_phone' => 'required',
            'loc_email' => 'required',
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
        $location->loc_email = $validated['loc_email'];
        $location->loc_address = $validated['loc_address'];
        $location->loc_resume = $validated['loc_resume'];
        $location->loc_status = $validated['loc_status'];
        $slug = self::toAscii($validated['loc_name'], ' ');
        $location->slug = $slug;

        $location->loc_capa = $img_name;

        $location->save();

        $img = $request->file('loc_images');

        for ($i = 0; $i < count($img); $i++) { 
            
            $imgs = $img[$i];
            $imgs_name = md5($imgs->getClientOriginalName().time()) . '.' . $imgs->getClientOriginalExtension();
                
            if ($imgs->move('assets/img/locations', $imgs_name)) {
                    
                $locationImages->img_name = $imgs_name;
                $locationImages->loc_id = $location->id;
                    
                $image = $locationImages::create([
                    "img_name" => $imgs_name,
                    "loc_id" => $location->id
                ]);

                sleep(1);
            } 
    
        }

        $success = 'Location criada com sucesso';
        return redirect()->route("manage-locations", compact('success'));
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
    public function edit(string $slug)
    {
        $locations = DB::table('locations')->where('slug', $slug)->get();
        return view('Admin.edit-locations', compact('locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $location = Location::find($request->id);

        if ($location) {

            $location->loc_name = $request->loc_name;
            $location->loc_phone = $request->loc_phone;
            $location->loc_email = $request->loc_email;
            $location->loc_address = $request->loc_address;
            $location->loc_resume = $request->loc_resume;
            $location->loc_status = $request->loc_status;

            if ($request->hasFile('loc_capa')) {

                $imgCapa = $request->file('loc_capa');
                $img_name = md5($imgCapa->getClientOriginalName().time()) . '.' . $imgCapa->getClientOriginalExtension();
                $imgCapa->move('assets/img/capas_locations', $img_name);

                $location->loc_capa = $img_name;
            }

            $location->save();

            sleep(2);

            $success = 'Location atualizada com sucesso';
            return redirect()->route("manage-locations", compact('success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $location = DB::table('locations')->where('slug', $slug)->get();

        if (!$location) {
            return abort(404);

        } else {

            $location = DB::table('locations')->where('slug', $slug)->delete();

            sleep(2);

            $success = 'Location removida com sucesso';
            return redirect()->route("manage-locations", compact('success'));
        }

    }
}
