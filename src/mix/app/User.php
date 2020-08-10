<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 01 Jul 2019 03:00:04 +0000.
 */

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

/**
 * Class Users
 *
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','twitter_id'
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
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
        //return Crypt::encrypt($this->login_password);
    }


    public function getLoginPasswordAttribute($value)
    {
        return Crypt::decrypt($value);
    }


    public function setLoginPasswordAttribute($value)
    {
        $this->attributes['login_password'] = Crypt::encrypt($value);
    }
}
