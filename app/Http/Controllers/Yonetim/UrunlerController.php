<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrunlerController extends Controller
{


    public function index()
    {
        
        $entry = new Urun;
        $entry->setKerem(324);
        echo $entry->getKerem();
        $list = Urun::orderByDesc("created_at")->paginate(8);
        return view("yonetim.urunler.index", compact("list"));
    }

    public function form($id = 0)
    {

        $entry = new Urun;
        $urun_kategoriler = [];
        if ($id > 0) {
            $entry = Urun::find($id);
            $urun_kategoriler = $entry->kategori()->pluck('kategori_id')->all();
        }
        $kategoriler = Kategori::all();

        return view("yonetim.urunler.form", compact("entry", "kategoriler", "urun_kategoriler"));

    }

    public function arama(Request $request)
    {
        $arama = $request->arama;
        $ustKategoriler = $request->ustKategoriler;
        $list = Urun::where('urun_adi', 'like', "%$arama%")
            ->where("ust_id", $ustKategoriler)
            ->orderByDesc("created_at")->paginate(8);
        $request->flash();
        $ustKategoriler = Urun::whereRaw("ust_id is null")->get();
        return view("yonetim.urunler.index", compact("list", "ustKategoriler"));
    }
    public function kaydet(Request $request, $id = 0)
    {

        $data = $request->only('urun_adi', "slug", "fiyati", "aciklama");
        if (!$request->filled('slug')) {
            $data['slug'] = Str::slug($request->urun_adi);
            $request->merge(['slug' => $data["slug"]]);
        }
        $request->validate([
            "urun_adi" => "required",
            "fiyati" => "required",
            "slug" => ($request->orginial_slug == $request->slug ? "unique:urun,slug" : ''),
        ]);

        $urunler_detay = $request->only("goster_slider", "goster_gunun_firsati", "goster_once_cikan", "goster_cok_satan", "goster_indirimli");

        $kategoriler = $request->kategoriler;

        if ($id > 0) {
            $entry = Urun::where('id', $id)->firstOrFail();
            $entry->update($data);
            $entry->detay()->update($urunler_detay);
            $entry->kategori()->sync($kategoriler);
        } else {
            $entry = Urun::create($data);
            $entry->save();
            $entry->detay()->create($urunler_detay);
            $entry->kategori()->attach($kategoriler);

        }

        $request->validate([
            "urun_resim" => "image|mimes:jpg,png,jpeg|max:2048",
        ]);
        if ($request->hasFile("urun_resim")) {
            $urun_resim = $request->file('urun_resim');
            $urun_resim = $request->urun_resim;
            $dosya_adi = $entry->id . "-" . time() . "." . $urun_resim->extension();
            if ($urun_resim->isValid()) {
                $urun_resim->move("uploads/urunler/", $dosya_adi);
            }
            UrunDetay::updateOrCreate(
                ["urun_id" => $entry->id],
                ["urun_resim" => $dosya_adi],
            );
        }

        return redirect()->route('yonetim.urunler.duzenle', $entry->id)->with("mesaj", ($id > 0 ? "Güncellendi" : "Kaydedildi"))->with("mesaj_tur", "success");

    }
    public function sil($id)
    {

        $urun = Urun::find($id);
        $urun->kategori()->detach();
        $urun->detay()->delete();
        $urun->delete();
        return redirect()
            ->route("yonetim.urunler")
            ->with("mesaj", "Kayıt Silindi")
            ->with("mesaj_tur", "success");
    }

}
