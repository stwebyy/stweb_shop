<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status_id',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
