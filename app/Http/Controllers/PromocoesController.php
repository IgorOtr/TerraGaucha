<?php

namespace App\Http\Controllers;

use App\Models\Promocoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromocoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = DB::table('promocoes')->get();
        return view('Admin.manage-promotions', compact('promotions'));
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
            'promo_title' => 'required',
            'promo_content' => 'required',
            'promo_subcontent' => 'required',
            'promo_restriction' => 'required',
            'promo_status' => 'required',
        ]);

        $promo = new Promocoes();

        $imgCapa = $request->file('promo_capa');
        $img_name = md5($imgCapa->getClientOriginalName().time()) . '.' . $imgCapa->getClientOriginalExtension();
        $imgCapa->move('assets/img/capas_promo', $img_name);

        $promo->promo_title = $validated['promo_title'];
        $promo->promo_content = $validated['promo_content'];
        $promo->promo_subcontent = $validated['promo_subcontent'];
        $promo->promo_restriction = $validated['promo_restriction'];
        $promo->promo_capa = $img_name;
        $promo->promo_status = $validated['promo_status'];

        if ($request->promo_btn_title != null and $request->promo_btn_title != null) {

            $promo->promo_btn_link = $request->promo_btn_link;
            $promo->promo_btn_title = $request->promo_btn_title;
        } else {

            $promo->promo_btn_link = '';
            $promo->promo_btn_title = '';
        }

        $promo->save();

        $success = 'Promoção/Evento criado(a) com sucesso';
        return redirect()->route("manage-promo", compact('success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Promocoes $promocoes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promocoes $promocoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocoes $promocoes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocoes $promocoes)
    {
        //
    }
}
