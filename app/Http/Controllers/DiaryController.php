<?php

namespace App\Http\Controllers;
//

use Illuminate\Http\Request;
// require_once('別のファイル');のイケてる版
//$_POSTを受け取るクラス

use App\Diary;  //Diaryのクラスを使えるようにする
use App\Http\Requests\CreateDiary; //バリデーションのCreateDiaryクラスを使う

use Illuminate\Support\Facades\Auth;
//Authクラスを使えるようにする

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
        $diaries = Diary::with('likes')->orderBy('id', 'desc')->get();
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
    public function store(CreateDiary $request){    //
        // dd('$request->');
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
        $diary->user_id = Auth::user()->id; //ログインしているユーザーのidを保存
        // dd(Auth::user()->id);
        // storageフォルダに画像をアップロードする
        $diary->img_url = $request->img_url->store('public/diary_img');    //画像データの名前をDBに格納

        $diary->save();

        //一覧ページに戻る（リダイレクト処理）
        return redirect()->route('diary.index'); //header()と同じような処理

    }

    //リクエスト -> http://localhost
    // web.php->Route
    public function destroy($id){   //web.phpの'diary/{id}/deleteにある{id}と同名の引数が定義される'
        // dd($id);

        $diary = Diary::find($id);
        // SELECT * FROM diaries WHERE id=?
        $diary->delete();
        // DELETE FROM テーブル名 WHERE id=? (←SQL文の場合)

        return redirect()->route('diary.index');

    }

    function edit($id){
        $diary = Diary::find($id);
        // SELECT * FROM diaries WHERE id=?
        // $diaryはCollectinという型でできていて、Arrayに変換するにはtoArray()
        return view('diaries.edit', ['diary' => $diary]);
    }

    //更新処理
    function update($id, CreateDiary $request) {
        $diary = Diary::find($id); //1件データ取得

        $diary->title = $request->title; //値を上書き
        $diary->body = $request->body; //値を上書き
        $diary->save(); //保存処理

        return redirect()->route('diary.index');

    }

    function mypage(){
        // $login_user = Auth::user();
        // // $diaries = Diary::find(1);
        // //↑これやと SELECT * FROM diaries WHERE id=1;
        // $diaries = Diary::where('user_id', 1)->get();
        // where('カラム名', 値);
        // SELECT * FROM diaries WHERE カラム名=値

        //Modelのリレーションを使ったパターン
        $login_user = Auth::user(); //ユーザー情報を取得
        // dd($login_user);
        // $diaries = $login_user->diaries;
        // $users = $login_user->users;
        // dd($login_user['password']);

        return view('diaries.mypage', ['users'=>$login_user]);
    }

    function like($id){
        // idをもとにdiaryデータ1件を取得
        $diary = Diary::where('id', $id)->with('likes')->first();
        // dd($diary);
        //with() 
        // likesテーブルに選択されているsiaryとログインしているユーザーのidをINSERTする
        $diary->likes()->attach(Auth::user()->id);
        // INSERT INTO likes (diary_id, user_id) VALUES($diary->id,  Auth::user()->id)

        return redirect()->route('diary.index');

    }

    function dislike($id){
        $diary = Diary::where('id', $id)->with('likes')->first();
        $diary->likes()->detach(Auth::user()->id);
        // DELETE FROM likes WHERE diary_id=$diary->id AND user_id=Auth::user()->id
        return redirect()->route('diary.index');

    }

}

//対応するDBのDiaryモデルはdiariesテーブルの中の
//勝手にpublicの変数が定義される

