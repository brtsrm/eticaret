<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'siparis';

    protected $fillable = ['sepet_id', 'siparis_tutari', 'banka', 'taksit_sayisi', 'durum','adsoyad','adres','telefon','ceptelefon' ];

    public function sepet()
    {
        return $this->belongsTo(Sepet::class);
    }

}
