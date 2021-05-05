<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'first_name_ruby',
        'last_name_ruby',
        'email',
        'email_verified_at',
        'password',
        'role_id',
        'postal_code',
        'gender',
        'birthday',
        'pref_id',
        'city',
        'block',
        'building',
        'phone_number',
    ];

    /**
     * ユーザーの権限を取得
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * ユーザーの都道府県を取得
     */
    public function pref()
    {
        return $this->belongsTo('App\Models\Pref');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
