<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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
