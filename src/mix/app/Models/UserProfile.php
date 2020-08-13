<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserProfile extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    /**
     * ユーザプロフィールテーブル
     *
     */
    protected $fillable = [
         'id', 'sex', 'picture', 'language', 'introduction', 'area', 'update_timestamp'
    ];
    // 関連するモデル
    public function users()
    {
        return $this->hasOne('App\User', 'id', 'id');
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
