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

        sleep(2);

        $success = 'Promoção/Evento criado(a) com sucesso';
        return redirect()->route("manage-promo", compact('success'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promocoes $promocoes, string $id)
    {
        $promotions = DB::table('promocoes')->where('id', $id)->get();
        return view('Admin.edit-promotions', compact('promotions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocoes $promocoes)
    {
        $promo = Promocoes::find($request->id);

        if ($promo) {

            $promo->promo_title = $request->promo_title;
            $promo->promo_content = $request->promo_content;
            $promo->promo_subcontent = $request->promo_subcontent;
            $promo->promo_restriction = $request->promo_restriction;
            $promo->promo_status = $request->promo_status;

            if ($request->hasFile('promo_capa')) {

                $imgCapa = $request->file('promo_capa');
                $img_name = md5($imgCapa->getClientOriginalName().time()) . '.' . $imgCapa->getClientOriginalExtension();
                $imgCapa->move('assets/img/capas_promo', $img_name);

                $promo->promo_capa = $img_name;
            }

            if ($request->promo_btn_title != null and $request->promo_btn_title != null) {

                $promo->promo_btn_link = $request->promo_btn_link;
                $promo->promo_btn_title = $request->promo_btn_title;
            }

            $promo->save();

            sleep(2);

            $success = 'Promoção/Evento atualizado(a) com sucesso';
            return redirect()->route("manage-promo", compact('success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocoes $promocoes, string $id)
    {
        $promocoes = DB::table('promocoes')->where('id', $id)->get();

        if (!$promocoes) {
            return abort(404);

        } else {

            $location = DB::table('promocoes')->where('id', $id)->delete();

            sleep(2);

            $success = 'Promoção/Evento removido com sucesso';
            return redirect()->route("manage-promo", compact('success'));
        }
    }
}
