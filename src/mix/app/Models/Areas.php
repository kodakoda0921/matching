<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Areas extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    /**
     * 言語テーブル
     *
     */
    protected $fillable = [
         'id','area'
    ];
}
