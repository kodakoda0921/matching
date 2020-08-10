<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserProfile extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'id','singer', 'mixer', 'update_timestamp'
    ];
    // 関連するモデル
    public function users()
    {
        return $this->hasOne('App\User', 'id', 'id');
    }
}
