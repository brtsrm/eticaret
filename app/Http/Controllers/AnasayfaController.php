<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Urun;

class AnasayfaController extends Controller
{
    public function index()
    {
        $kategoriler = Kategori::whereRaw('ust_id is null')->get();
        $urun_gunun_firsati = Urun::select('urun.*')
            ->join('urun_detay', 'urun_detay.urun_id', 'urun.id')
            ->where('urun_detay.goster_gunun_firsati', 1)
            ->orderBy('id', 'desc')
            ->first();

        $urunler_slider = Urun::select('urun.*')
            ->join('urun_detay', 'urun_detay.urun_id', 'urun.id')
            ->where('urun_detay.goster_slider', 1)
            ->orderBy('id', 'desc')->take(5)->get();

        $goster_cok_satan = Urun::select('urun.*')
            ->join('urun_detay', 'urun_detay.urun_id', 'urun.id')
            ->where('urun_detay.goster_cok_satan', 1)
            ->orderBy('id', 'desc')->take(5)->get();

        $goster_one_cikan = Urun::select('urun.*')
            ->join('urun_detay', 'urun_detay.urun_id', 'urun.id')
            ->where('urun_detay.goster_one_cikan', 1)
            ->orderBy('id', 'desc')->take(5)->get();

        $goster_indirimli = Urun::select('urun.*')
            ->join('urun_detay', 'urun_detay.urun_id', 'urun.id')
            ->where('urun_detay.goster_indirimli', 1)
            ->orderBy('id', 'desc')->take(5)->get();

        return view("anasayfa", compact("kategoriler", "urunler_slider", 'urun_gunun_firsati', "goster_indirimli", "goster_one_cikan", "goster_cok_satan"));
    }
}
