<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joins extends Model
{
    public $timestamps = false;
    public $incrementing = true;

    /**
     * 参加テーブル
     *
     */
    protected $fillable = [
        'id', 'user_id', 'meeting_id', 'approval'
   ];

    // 関連するモデル
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function meetings()
    {
        return $this->hasOne('App\Models\Meetings', 'id', 'meeting_id');
    }
}
