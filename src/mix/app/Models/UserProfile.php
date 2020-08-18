<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserProfile extends Model
{
    public $timestamps = false;
    public $incrementing = true;
    /**
     * ユーザプロフィールテーブル
     *
     */
    protected $fillable = [
         'id', 'user_id', 'sex', 'picture', 'language', 'introduction', 'area', 'update_timestamp'
    ];
    // 関連するモデル
    public function users()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function languages()
    {
        return $this->hasOne('App\Models\Languages', 'id', 'language');
    }
    public function areas()
    {
        return $this->hasOne('App\Models\areas', 'id', 'area');
    }
}
