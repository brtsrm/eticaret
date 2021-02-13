<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index($slug_kategori, Request $request)
    {
        $kategori = Kategori::where("slug", $slug_kategori)->firstOrFail();
        $alt_kategori = Kategori::where('ust_id', $kategori->id)->get();
        $order = $request->input("order");
        
        if ($order == "yeniurun") {
            $urunler =
                 $kategori->
                 urunler()->
                 orderByDesc('updated_at')->
                 paginate();

        } elseif ($order == "coksatan") {   
            $urunler = $kategori->urunler()->join('urun_detay', 'urun_detay.urun_id', 'urun.id')->orderByDesc('urun_detay.goster_cok_satan', 'desc')->paginate();

        } else {
            $urunler = $kategori->urunler()->paginate();
        }
        return view('kategori', compact("kategori", "alt_kategori", "urunler"));
    }

}
