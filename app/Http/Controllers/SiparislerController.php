<?php

namespace App\Http\Controllers;

use App\Models\Siparis;
use Illuminate\Support\Facades\Auth;

class SiparislerController extends Controller
{
    public function index()
    {
        $siparisler = Siparis::with('sepet')->whereHas('sepet', function ($query) {
            $query->where('kullanici_id', Auth::id());
        })->orderByDesc('created_at')->get();
        return view("siparisler", compact("siparisler"));
    }
    public function detay($id)
    {
        $siparis = Siparis::with('sepet.sepet_urunler')->whereHas('sepet', function ($query) {
            $query->where('kullanici_id', Auth::id());
        })->where('siparis.id', $id)->firstOrFail();
        return view("detay", compact('siparis'));
    }
}
