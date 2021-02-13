<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\Kullanici;
use App\Models\KullaniciDetay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KullaniciController extends Controller
{
    public function oturumac()
    {
        return view('yonetim.oturumac');
    }
    public function oturumacform(Request $request)
    {

        $request->validate([
            "email" => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
            "yoneticimi" => 1,
            "aktif_mi" => 1,
        ];

        if (Auth::guard('yonetim')->attempt($credentials, $request->has($request->rememberme))) {
            return redirect()->route("yonetim.anasayfa");
        } else {
            return back()->withInput()->withErrors(["email" => "Bilgilerinizi Kontrol ediniz."]);
        }

    }
    public function oturumukapat(Request $request)
    {
        Auth::guard('yonetim')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('yonetim.oturumac');
    }

    public function index()
    {
        $list = Kullanici::orderByDesc("created_at")->paginate(8);
        return view("yonetim.kullanici.index", compact("list"));
    }

    public function form($id = 0)
    {

        $entry = new Kullanici;
        if ($id > 0) {
            $entry = Kullanici::find($id);

        }
        return view("yonetim.kullanici.form", compact("entry"));

    }

    public function arama(Request $request)
    {
        $arama = $request->arama;
        $list = Kullanici::where('adsoyad', 'like', "%$arama%")->orWhere("email", "like", "%arama%")->orderByDesc("created_at")->paginate(8);
        $request->flash();
        return view("yonetim.kullanici.index", compact("list"));
    }
    public function kaydet(Request $request, $id = 0)
    {

        $request->validate([
            "adsoyad" => "required",
            "adsoyad" => "required",
        ]);

        $data = $request->only('adsoyad', 'email', 'aktif_mi');

        if ($request->filled("sifre")) {
            $data["sifre"] = Hash::make($request->sifre);
        }
        $data["aktif_mi"] = $request->has("aktif_mi") ? 1 : 0;
        $data["yoneticimi"] = $request->has("yoneticimi") ? 1 : 0;

        if ($id > 0) {
            $entry = Kullanici::where('id', $id)->firstOrFail();
            $entry->update($data);
            KullaniciDetay::updateOrCreate(
                ["kullanici_id" => $id],
                ["adres" => $request->adres, "telefon" => $request->telefon, "ceptelefon" => $request->ceptelefon]
            );
        } else {
            $entry = Kullanici::create($data);
            $entry->save();
        }

        return redirect()->route('yonetim.kullanici.duzenle', $entry->id)->with("mesaj", ($id > 0 ? "Güncellendi" : "Kaydedildi"))->with("mesaj_tur", "success");

    }
    public function sil($id)
    {
        Kullanici::destroy($id);
        return redirect()
            ->route("yonetim.kullanici")
            ->with("mesaj", "Kayıt Silindi")
            ->with("mesaj_tur", "success");
    }
}
