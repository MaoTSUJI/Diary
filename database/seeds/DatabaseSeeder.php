<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        //このファイルを読み込むと、下のコマンドが実行される
        //php artisan db:seed --class=UsersTableSeeder
		    $this->call(DiariesTableSeeder::class);
		    //php artisan db:seed --class=DiariesTableSeeder

    }
}
