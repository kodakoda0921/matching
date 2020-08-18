<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('ユーザID');
            $table->string('title')->comment('タイトル');
            $table->string('picture')->nullable(true)->comment('アイコン');
            $table->integer('language')->comment('言語');
            $table->integer('area')->comment('所在地名');
            $table->string('overview')->nullable(true)->comment('概要');
            $table->timestamp('update_timestamp')->comment('登録更新タイムスタンプ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
