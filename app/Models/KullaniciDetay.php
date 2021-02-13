<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KullaniciDetay extends Model
{
    use HasFactory;
    protected $table = 'kullanici_detay';
    protected $guarded = [];
    public $timestamps = null;

    public function kullanici()
    {
        return $this->belongsTo(Kullanici::class);
    }

}
