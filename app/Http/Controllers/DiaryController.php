<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// require_once('別のファイル');のイケてる版
//$_POSTを受け取るクラス

use App\Diary;  //Diaryのクラスを使えるようにする

class DiaryController extends Controller
{
    //一覧画面を表示する
    public function index() {
    	// dd('Hello Laravel');
    	// dump and die関数というLaravelに用意された関数
    	// var_dumpとdieを組み合わせたもの
    	// die関数は、それ以降の動作を無視してまう。
    	// Laravel開発の必須ツールです

        //モデルファイルを使ってデータを取得する
        $diaries = Diary::all()->toArray();
        //SELECT * FROM diaries WHERE 1 を実行し$diariesに入れる
        //all()メソッドは対応するテーブルから、全てのセレクト
        // dd($diaries);

    	return view('diaries.index', ['diaries' => $diaries]);
    	//view関数はresources/view/内にあるファイルを取得する関数
    	//view('ファイル名')もしくは
    	//view('フォルダ名.ファイル名')のように記述する
    	//view('welcome')
    	//view('diaries.edit')
    	//ファイル名は.bladeの前のみ
        //view(C, [B => A]);
        // Aの変数を、Bの変数名に変えてCのViewに送る
    }

    //投稿画面
    public function create(){

    	return view('diaries.create');
    }
    //保存処理
    public function store(Request $request){
        // dd('ほげ');
        //POST 送信データの受け取り
        //$_POSTの代わりにRequestクラスを使用します。
        // dd($request); +requestに保存されていることを確認
        // INSRT INTO テーブル名(カラム) VALUE(値)
        // INSERT INTO diaries (title, body) VALUE ($_POST['title'], $_POST['body'])
        // INSERT INTO diaries (title, body) VALUE ($request->title, $request->body)
        // MODELクラスDiaryを使用する
        $diary = new Diary(); //インスタンス化
        $diary->title = $request->title;
        $diary->body = $request->body;
        $diary->save();

        //一覧ページに戻る（リダイレクト処理）
        return redirect()->route('diary.index'); //header()と同じような処理

    }

}

//対応するDBのDiaryモデルはdiariesテーブルの中の
//勝手にpublicの変数が定義される

