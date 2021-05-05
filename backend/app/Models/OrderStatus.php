<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = [
        'status_id',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
