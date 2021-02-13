<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnasayfaController extends Controller
{
    public function index()
    {

        $cokSatanUrunler = DB::select("
                select u.urun_adi,sum(su.adet) adet
                from siparis si
                inner join sepet s on s.id=si.sepet_id
                inner join sepet_urun su on s.id=su.sepet_id
                inner join urun u on u.id = su.urun_id
                group by u.urun_adi
                order by sum(su.adet) desc
        ");
        $aylaraGore = DB::select("

            select
                DATE_FORMAT(si.created_at,'%Y-%m-%d')  ay,sum(su.adet) adet
                from siparis si
                inner join sepet s on s.id=si.sepet_id
                inner join sepet_urun su on s.id=su.sepet_id
                group by date_format(si.created_at, '%Y-%m-%d')
                order by date_format(si.created_at, '%Y-%m-%d') 

        ");
        return view("yonetim.anasayfa", compact('cokSatanUrunler','aylaraGore'));
    }

}
