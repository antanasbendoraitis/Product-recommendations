<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Weather extends Model
{
    use QueryCacheable;

    protected $fillable = [
        'id',
        'weather'
    ];

    protected $cacheFor = 300;
}
