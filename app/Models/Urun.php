<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'urun';
    private $kerem;
    public function kategori()
    {
        return $this->belongsToMany(kategori::class, 'kategori_urun');
    }
    public function getKerem(){
        return $this->kerem;
    }
    public function setKerem($alsin){
        $this->kerem = $alsin;
    }
    public function detay()
    {
        return $this->hasOne(UrunDetay::class, 'urun_id')->withDefault();
    }

}
