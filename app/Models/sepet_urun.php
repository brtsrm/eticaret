<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sepet_urun extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'sepet_urun';
    protected $guarded = [];
    public function urun()
    {
        return $this->belongsTo(Urun::class);
    }
}
