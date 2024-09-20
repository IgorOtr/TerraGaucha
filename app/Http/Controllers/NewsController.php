<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = DB::table('news')->get();
        return view('Admin.manage-news', compact('news'));
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
            'news_title' => 'required',
            'news_date' => 'required',
            'news_content' => 'required',
            'news_status' => 'required'
        ]);

        $news = new News();

        $imgCapa = $request->file('news_capa');
        $img_name = md5($imgCapa->getClientOriginalName().time()) . '.' . $imgCapa->getClientOriginalExtension();
        $imgCapa->move('assets/img/capas_news', $img_name);

        $news->news_title = $validated['news_title'];
        $news->news_date = $validated['news_date'];
        $news->news_content = $validated['news_content'];
        $news->news_status = $validated['news_status'];
        $slug = self::toAscii($validated['news_title'], ' ');
        $news->news_slug = $slug;
        $news->news_capa = $img_name;

        if ($news->save()) {

            $success = 'Notícia criada com sucesso';
            sleep(2);
            return redirect()->route("manage-news", compact('success'));
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $news = DB::table('news')->where('news_slug', $slug)->get();
        return view('Admin.edit-news', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {

        $news = News::find($request->id);

            if ($news) {
                $news->news_title = $request->news_title;
                $news->news_date = $request->news_date;
                $news->news_content = $request->news_content;
                $news->news_status = $request->news_status;
                $slug = self::toAscii($request->news_title, ' ');
                $news->news_slug = $slug;

                    if ($request->hasFile('news_capa')) {

                        $imgCapa = $request->file('news_capa');
                        $img_name = md5($imgCapa->getClientOriginalName().time()) . '.' . $imgCapa->getClientOriginalExtension();
                        $imgCapa->move('assets/img/capas_news', $img_name);

                        $news->news_capa = $img_name;
                    }

                $news->save();

                sleep(2);
        
                $success = 'Notícia atualizada com sucesso';
                return redirect()->route("manage-news", compact('success'));

            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $news = DB::table('news')->where('news_slug', $slug)->get();

        if (!$news) {
            return abort(404);

        } else {

            $news = DB::table('news')->where('news_slug', $slug)->delete();

            sleep(2);

            $success = 'Notícia removida com sucesso';
            return redirect()->route("manage-news", compact('success'));
        }
    }
}
