<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hastane extends Model
{
    protected $fillable = [
        'adi', 'lat_long',
    ];
}
