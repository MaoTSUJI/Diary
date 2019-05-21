<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;	//DBクラスを使用
use Carbon\Carbon;	//Carbonクラスを使う　日付、時刻の処理をするのに使える

class DiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     // * @return void
     */
    public function run()
    {
        $diaries = [
        	[
        		'title' => 'セブでプログラミング',
	        	'body' => '気がつけばもうあと1ヶ月'
        	],
        	[
        		'title' => 'やり残したことは、、、',
	        	'body' => '筋トレだ'
        	],
        	[
        		'title' => 'いや、チーム開発でしょ！',
	        	'body' => '絶対リリース'
        	]
        ];

      foreach ($diaries as $diary) {
      	DB::table('diaries')->insert([ //INSERT INTO文が実行されている
      		'title' => $diary['title'],
      		'body' => $diary['body'],
      		'created_at' => Carbon::now(),
      		'updated_at' => Carbon::now()
      	]);

      }
    }
}
