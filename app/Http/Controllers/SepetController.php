<?php

namespace App\Http\Controllers;

use App\Models\Sepet;
use App\Models\sepet_urun;
use App\Models\Urun;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SepetController extends Controller
{
    public function index()
    {
        return view("sepet");
    }
    public function ekle(Request $request)
    {
        $urun = Urun::find($request->id);

        $cartItem = Cart::add($urun->id, $urun->urun_adi, 1, $urun->fiyati, 1, ["urunslug" => $urun->slug]);
        if (Auth::check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            if (!$aktif_sepet_id) {

                $aktif_sepet = Sepet::create([
                    'kullanici_id' => Auth::id(),
                ]);
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id', $aktif_sepet_id);
            }
            sepet_urun::updateOrCreate(
                ['sepet_id' => $aktif_sepet_id, 'urun_id' => $urun->id],
                ['adet' => $cartItem->qty, 'fiyati' => $urun->fiyati, 'durum' => 'Beklemede']
            );
        }

        return redirect()->route("sepet")->with("mesaj_tur", "success")->with("mesaj", "Ürün sepete eklenmiştir");

    }
    public function kaldir($rowid, Request $request)
    {
        if (Auth::check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            $sepetUrunId = Cart::get($rowid);

            sepet_urun::where('sepet_id', $aktif_sepet_id)->where("urun_id", $sepetUrunId->id)->delete();
        }
        Cart::remove($rowid);
        return redirect()->route("sepet")->with("mesaj_tur", "success")->with("mesaj", "Ürün sepetten kaldırıldı");
    }
    public function bosalt()
    {

        if (Auth::check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            sepet_urun::where('sepet_id', $aktif_sepet_id)->delete();
        }
        Cart::destroy();
        return redirect()->route("sepet")->with("mesaj_tur", "success")->with("mesaj", "Sepet Boşaltılmıştır");
    }
    public function guncelle(Request $request, Response $response)
    {

        $validator = Validator::make($request->all(), [
            'urunadet' => 'required|numeric|between:1,5',
        ]);

        $urunRowId = $request->urunrowid;
        $urunAdet = $request->urunadet;

        if ($validator->fails()) {

            session()->flash("mesaj_tur", "danger");
            session()->flash("mesaj", "Adet Sayısı 1 ile 5 arası olmalıdır ");
        } else {

            $sonuc = Cart::update($urunRowId, $urunAdet);

            session()->flash("mesaj_tur", "success");
            session()->flash("mesaj", "Sepet Eklenmiştir");
            if (Auth::check()) {
                $aktif_sepet_id = session('aktif_sepet_id');
                $sepetUrunId = Cart::get($urunRowId);

                sepet_urun::where('sepet_id', $aktif_sepet_id)->where("urun_id", $sepetUrunId->id)
                    ->update(["adet" => $urunAdet]);
            }
            return $response->setContent(["urun_adet" => $sonuc->qty]);
        }

    }
}
