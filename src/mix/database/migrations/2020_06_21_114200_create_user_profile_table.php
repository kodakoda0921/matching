<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->integer('id')->comment('ユーザID');
            $table->integer('sex')->comment('性別');
            $table->string('picture')->nullable(true)->comment('アイコン');
            $table->integer('language')->comment('言語');
            $table->string('introduction')->nullable(true)->comment('自己紹介');
            $table->integer('area')->nullable(true)->comment('所在地名');
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
        Schema::dropIfExists('user_profiles');
    }
}
