<?php

namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
use App\Models\Kullanici as ModelsKullanici;
use App\Models\KullaniciDetay;
use App\Models\Sepet;
use App\Models\sepet_urun;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class KullanicilarController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest")->except("oturumukapat");
    }
    public function giris_form()
    {
        return view("kullanici.oturumac");
    }
    public function giris(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'sifre' => 'required',
        ]);

        if (Auth::attempt(["email" => $request->email, "password" => $request->sifre], $request->has("benihatirla"))) {
            $request->session()->regenerate();
            $aktif_sepet_id = Sepet::firstOrCreate(['kullanici_id' => auth()->id()])->id;
            if (is_null($aktif_sepet_id)) {
                $aktif_sepet = Sepet::create(["kullanici_id" => Auth::id()]);
                $aktif_sepet_id = $aktif_sepet->id;
            }
            session()->put('aktif_sepet_id', $aktif_sepet_id);

            if (Cart::count() > 0) {
                foreach (Cart::content() as $cartItem) {
                    sepet_urun::updateOrCreate(
                        ["sepet_id" => $aktif_sepet_id, 'urun_id' => $cartItem->id],
                        ["adet" => $cartItem->qty, 'fiyati' => $cartItem->price, 'durum' => 'Beklemede']
                    );
                }
            }

            Cart::destroy();
            $sepetUrunler = sepet_urun::where('sepet_id', $aktif_sepet_id)->get();
            foreach ($sepetUrunler as $sepetUrun) {
                Cart::add($sepetUrun->urun->id, $sepetUrun->urun->urun_adi, $sepetUrun->adet, $sepetUrun->fiyati, 1, ['urunslug' => $sepetUrun->urun->slug]);
            }

            return redirect()->intended('/');

        } else {
            $errors = ["email" => "Bilgileriniz kontrol ediniz. Hatalı giriş yaptınız."];
            return back()->withErrors($errors);
        }
    }
    public function kaydol_form()
    {
        return view("kullanici.kaydol");
    }
    public function kaydol(Request $request)
    {
        $request->validate([
            'adsoyad' => 'required|min:5',
            'email' => 'required|unique:kullanici',
            'sifre' => 'required|confirmed',
        ]);
        $kullanici = ModelsKullanici::create([
            'adsoyad' => $request->adsoyad,
            'email' => $request->email,
            'sifre' => Hash::make($request->sifre),
            'aktivasyon_anahtari' => Str::random(60),
            'aktif_mi' => 0,

        ]);
        $kullanici->detay()->save(new KullaniciDetay());
        Mail::to($request->email)->send(new KullaniciKayitMail($kullanici));
        
        Auth::login($kullanici);
        return redirect()->route("anasayfa");
    }
    public function sifre_form()
    {
        return view('kullanici.sifre_form');
    }
    public function aktiflestir($aktivasyon)
    {
        $kullanici = ModelsKullanici::where("aktivasyon_anahtari", $aktivasyon)->first();
        if (!is_null($kullanici)) {
            $kullanici->aktivasyon_anahtari = null;
            $kullanici->aktif_mi = 1;
            $kullanici->save();
            return redirect()->to('/')->with('mesaj', 'Kullanıcı kaydınız aktifleştirildi')->with("mesaj_tur", "success");
        }
    }
    public function cikis(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');

    }
}
