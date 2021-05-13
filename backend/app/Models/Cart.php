<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'carts_has_products')->withPivot('quantity');
    }
}
