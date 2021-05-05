<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image',
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function carts()
    {
        return $this->belongsToMany('App\Models\Cart');
    }
}
