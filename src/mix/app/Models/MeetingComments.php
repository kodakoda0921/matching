<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingComments extends Model
{
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'id', 'user_id', 'meeting_id', 'comment'
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
    public function meetingReads()
    {
        return $this->hasMany('App\Models\MeetingReads', 'meeting_comment_id', 'id');
    }
}
