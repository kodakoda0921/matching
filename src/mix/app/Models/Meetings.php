<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Meetings extends Model
{
    public $timestamps = false;
    public $incrementing = true;
    /**
     * 言語テーブル
     *
     */
    protected $fillable = [
         'id','user_id', 'title', 'picture', 'language', 'area', 'overview', 'event_date'
    ];

    // 関連するモデル
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
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
