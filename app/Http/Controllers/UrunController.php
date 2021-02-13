<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Illuminate\Http\Request;

class UrunController extends Controller
{
    public function index($urunAdi)
    {
        $urun = Urun::whereSlug($urunAdi)->firstOrFail();
        $kategori = $urun->kategori()->distinct()->get();
        return view("urun", compact("urun", "kategori"));
    }
    public function urun_ara(Request $request)
    {
        $requestItemSearch = $request->input("ara");
        $itemsSearch =
        Urun::where("urun_adi", 'like', "%$requestItemSearch%")
            ->orWhere("aciklama", "like", "%$requestItemSearch%")
            ->paginate(5);
        $request->flash();
        return view("ara", compact("itemsSearch"));

    }
}
