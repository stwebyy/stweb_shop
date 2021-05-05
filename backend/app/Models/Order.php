<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'price',
        'order_status_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\OrderStatus');
    }

    public function orderItems()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
