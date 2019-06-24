<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulans extends Model
{
    protected $fillable = [
        'istasyon_id','adi', 'numarasi','dolu_mu',
    ];
}
