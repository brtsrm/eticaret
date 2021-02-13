<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Sepet extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "sepet";
    protected $fillable = ['kullanici_id'];

    public function sepet()
    {
        return $this->hasOne(siparis::class);
    }
    public function sepet_urunler()
    {
        return $this->hasMany(sepet_urun::class);
    }
    public function aktif_sepet_id()
    {
        $aktif_sepet = DB::table("sepet")
            ->leftJoin('siparis', 'siparis.sepet_id', '=', 'id')
            ->where('sepet.kullanci_id', Auth::id())
            ->whereRaw('siparis.id is null')
            ->orderByDesc('sepet.created_at')
            ->select('sepet.id')
            ->first();
        if (!is_null($aktif_sepet)) {
            return $aktif_sepet->id;
        }
    }
    public function sepet_urun_adet()
    {
        return DB::table('sepet_urun')->where('sepet_id', $this->id)->sum('adet');
    }
    public function kullanici()
    {
        return $this->belongsTo(Kullanici::class)->withDefault();
    }
}
