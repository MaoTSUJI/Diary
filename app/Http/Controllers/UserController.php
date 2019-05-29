<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;  //Diaryのクラスを使えるようにする
use Illuminate\Support\Facades\Auth;
//Authクラスを使えるようにする


class UserController extends Controller
{
    public function userlist(){
    	//モデルファイルを使ってデータを取得する
        $userlist = User::all()->toArray();
        //SELECT * FROM users WHERE 1 を実行し$userlistに入れる
        //all()メソッドは対応するテーブルから、全てのセレクト
        // dd($users);

        return view('diaries.userlist', ['userlist' => $userlist]);
        //view(C, [B => A]);
        // Aの変数を、Bの変数名に変えてCのViewに送る

    }
}
