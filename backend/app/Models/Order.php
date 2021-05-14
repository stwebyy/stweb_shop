<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_status_id',
        'order_number',
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
        return $this->belongsToMany('App\Models\Product', 'order_items')->withPivot('quantity');
    }
}
