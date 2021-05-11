<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    /**
     * ユーザーの受注情報を取得
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
