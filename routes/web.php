<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//get('URLリクエスト','対象コントローラー＠対象メソッド')を呼び出す
//->name('名前')はなくても使える
Route::get('/', 'DiaryController@index')->name('diary.index'); //追加
Route::get('diary/create', 'DiaryController@create')->name('diary.create');	//投稿画面
	 //追加
Route::post('diary/create', 'DiaryController@store')->name('diary.create');	//保存処理
Route::delete('diary/{id}/delete', 'DiaryController@destroy')->name('diary.destroy');	//削除処理
//{}は対応するメソッドの引数になる


// オブジェクト指向のクラスメソッド
// クラス名::メソッド
// オブジェクト->メソッド
// Car::start();

// RESTFUL設計
// GET 取得
// POST 作成
// PATCH 更新
// DELETE 削除

// localhost:8000/aaa ← GET
// localhost:8000/aaa ← POST
// localhost:8000/aaa ← PATCH
// localhost:8000/aaa ← DELETE