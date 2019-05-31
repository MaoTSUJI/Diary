<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    //新しいデーブル、カラム、インデックスをデータベースに追加する為にために使用
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()  //upメソッドが行なった操作を元に戻す。
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }
}
