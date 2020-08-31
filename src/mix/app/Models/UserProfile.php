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
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function languages()
    {
        return $this->hasOne('App\Models\Languages', 'language', 'id');
    }
    public function areas()
    {
        return $this->hasOne('App\Models\areas', 'area', 'id');
    }
}
