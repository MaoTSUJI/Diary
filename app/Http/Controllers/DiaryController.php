<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// require_once('別のファイル');のイケてる版

class DiaryController extends Controller
{
    public function index() {
    	// dd('Hello Laravel');
    	// dump and die関数というLaravelに用意された関数
    	// var_dumpとdieを組み合わせたもの
    	// die関数は、それ以降の動作を無視してまう。
    	// Laravel開発の必須ツールです

    	return view('diaries.index');
    	//view関数はresources/view/内にあるファイルを取得する関数
    	//view('ファイル名')もしくは
    	//view('フォルダ名.ファイル名')のように記述する
    	//view('welcome')
    	//view('diaries.edit')
    	//ファイル名は.bladeの前のみ
    }

    public function create(){
    	return view('diaries.create');
    }

}
