<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingReads extends Model
{
    public $timestamps = false;
    public $incrementing = true;
    /**
     * 言語テーブル
     *
     */
    protected $fillable = [
        'id', 'user_id', 'meeting_comment_id', 'read_flg'
    ];

    // 関連するモデル
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function meeting_comments()
    {
        return $this->belongsTo('App\Models\MeetingComments', 'id', 'meeting_comment_id');
    }
}
