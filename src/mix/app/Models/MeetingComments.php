<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingComments extends Model
{
    protected $fillable = [
        'user_id', 'meeting_id', 'comment'
    ];

    // 関連するモデル
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function meetings()
    {
        return $this->belongsTo('App\Models\Meetings', 'meeting_id', 'id');
    }
}
