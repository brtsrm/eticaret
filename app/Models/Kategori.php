<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'kategori';

    public function urunler()
    {
        return $this->belongsToMany(Urun::class, 'kategori_urun');
    }

    public function ust_kategori()
    {
        return $this->belongsTo(Kategori::class, 'ust_id')->withDefault([
            "kategori_adi" => 'Ana Kategori',
        ]);
    }

}
