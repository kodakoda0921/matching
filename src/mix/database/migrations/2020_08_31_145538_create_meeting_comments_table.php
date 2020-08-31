<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->comment('ユーザID');
            $table->integer('meeting_id')->unsigned()->comment('勉強会ID');
            $table->string('comment');
            $table->timestamp('update_timestamp')->comment('投稿タイムスタンプ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_comments');
    }
}
