<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingReadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_reads', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->comment('ユーザID');
            $table->integer('meeting_comment_id')->comment('勉強会チャットコメントid');
            $table->boolean('read_flg')->comment('既読フラグ');
            $table->timestamp('update_timestamp')->comment('作成タイムスタンプ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_reads');
    }
}
