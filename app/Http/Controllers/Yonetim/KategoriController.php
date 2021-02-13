<?php

namespace App\Http\Controllers\yonetim;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{

    public function index()
    {

        $list = Kategori::orderByDesc("created_at")->paginate(8);
        $ustKategoriler = Kategori::whereRaw("ust_id is null")->get();
        return view("yonetim.kategori.index", compact("list", "ustKategoriler"));
    }

    public function form($id = 0)
    {

        $entry = new Kategori;
        if ($id > 0) {
            $entry = Kategori::find($id);
        }

        $kategoriler = Kategori::orderBy("ust_id")->get();

        return view("yonetim.kategori.form", compact("entry", "kategoriler"));

    }

    public function arama(Request $request)
    {
        $arama = $request->arama;
        $ustKategoriler = $request->ustKategoriler;
        $list = Kategori::where('kategori_adi', 'like', "%$arama%")
            ->where("ust_id", $ustKategoriler)
            ->orderByDesc("created_at")->paginate(8);
        $request->flash();
        
        $ustKategoriler = Kategori::whereRaw("ust_id is null")->get();
        return view("yonetim.kategori.index", compact("list","ustKategoriler"));
    }
    public function kaydet(Request $request, $id = 0)
    {

        $data = $request->only('kategori_adi', 'ust_id', "slug");
        if (!$request->filled('slug')) {
            $data['slug'] = Str::slug($request->kategori_adi);
            $request->merge(['slug' => $data["slug"]]);
        }
        $request->validate([
            "kategori_adi" => "required",
            "slug" => ($request->orginial_slug != $request->slug ? "unique:kategori,slug" : ''),
        ]);

        if ($id > 0) {
            $entry = Kategori::where('id', $id)->firstOrFail();
            $entry->update($data);
        } else {
            $entry = Kategori::create($data);
            $entry->save();
        }

        return redirect()->route('yonetim.kategori.duzenle', $entry->id)->with("mesaj", ($id > 0 ? "Güncellendi" : "Kaydedildi"))->with("mesaj_tur", "success");

    }
    public function sil($id)
    {

        $kategori = Kategori::find($id);
        $kategori->urunler()->detach();
        $kategori->delete();
        return redirect()
            ->route("yonetim.kategori")
            ->with("mesaj", "Kayıt Silindi")
            ->with("mesaj_tur", "success");
    }

}
