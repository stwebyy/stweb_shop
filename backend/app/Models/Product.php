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
        return $this->belongsToMany('App\Models\Order', 'order_items');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'products_has_tags');
    }

    public function carts()
    {
        return $this->belongsToMany('App\Models\Cart', 'carts_has_products');
    }
}
