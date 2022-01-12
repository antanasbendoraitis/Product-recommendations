<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Product extends Model
{
    use QueryCacheable;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'weather_id'
    ];

    protected $cacheFor = 300;
}
