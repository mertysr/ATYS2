<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Istasyon extends Model
{

    protected $fillable = [
        'adi', 'lat_long',
    ];
}
