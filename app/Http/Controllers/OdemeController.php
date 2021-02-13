<?php

namespace App\Http\Controllers;

use App\Models\Siparis;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OdemeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('oturumac')->with("mesaj_tur", "info")->with("mesaj", "Ödeme işlemi için oturum açmanız gerekiyor. Kullanıcınız yoksa lütfen kullanıcı kaydı oluşturunuz.");
        } else if (count(Cart::content()) == 0) {
            return redirect()->route('anasayfa')->with("mesaj_tur", "info")->with("mesaj", "Sepetinizde her hangi bir ürün bulunmamaktadır ve bu bölüme geçiş yapamazsınız.");
        }
        $kullanicidetay = Auth::user()->detay;
        return view("odeme",compact("kullanicidetay"));
    }
    public function odemeyap(Request $request)
    {
        $siparis = $request->all();
        $siparis["sepet_id"] = session('aktif_sepet_id');
        $siparis["banka"] = "Garanti";
        $siparis["telefon"] = $request->telefon;
        $siparis["ceptelefonu"] = "Garanti";
        $siparis["taksit_sayisi"] = 1;
        $siparis["durum"] = 'Siparişiniz Alındı';
        $siparis["siparis_tutari"] = Cart::subtotal();

        Siparis::create($siparis);
        Cart::destroy();
        session()->forget('aktif_sepet_id');

        return redirect()->route('siparisler')
        ->with('mesaj_tur','success')
        ->with('mesa','Ödeme başarılı bir şekilde alınmıştır.');
    }
}
