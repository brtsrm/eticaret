<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Siparis as ModelsSiparis;
use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiparisController extends Controller
{

    public function index()
    {

        $list = ModelsSiparis::with("sepet.kullanici")->orderByDesc("created_at")->paginate(8);
        return view("yonetim.siparis.index", compact("list"));
    }

    public function form($id = 0)
    {

        if ($id > 0) {
            $entry = ModelsSiparis::with('sepet.sepet_urunler.urun')->find($id);
            
        }     
        return view("yonetim.siparis.form", compact("entry",));

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


        $request->validate([
            "adsoyad" => "required",
            "telefon" => "required",
        ]);

        $data = $request->only('adsoyad','telefon', "ceptelefon", "adres", "durum");


        if ($id > 0) {
            $entry = ModelsSiparis::where('id', $id)->firstOrFail();
            $entry->update($data);
        }

        return redirect()->route('yonetim.siparis.duzenle', $entry->id)->with("mesaj",  "Güncellendi" )->with("mesaj_tur", "success");

    }
    public function sil($id)
    {
        ModelsSiparis::destroy($id);
        return redirect()
            ->route("yonetim.siparis")
            ->with("mesaj", "Kayıt Silindi")
            ->with("mesaj_tur", "success");
    }

}
