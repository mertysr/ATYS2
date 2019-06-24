<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasta extends Model
{
    protected $fillable = [
        'istasyon_id','ambulans_id', 'hastane_id','risk','adi','lat_long','bitti_mi',
    ];
}
