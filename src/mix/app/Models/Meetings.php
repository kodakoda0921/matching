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
         'id','user_id', 'title', 'picture', 'language', 'area', 'overview'
    ];
}
