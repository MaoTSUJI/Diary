@extends('layout')

@section('tittle')
Diary新規作成
@endsection

@section('content')
	<section class="container m-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route('diary.create') }}" method="POST">
                		{{-- Laravelでフォームを実装する場合に必須 --}}
                    @csrf
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" class="form-control" name="title" id="title" />
                    </div>
                    <div class="form-group">
                        <label for="body">本文</label>
                        <textarea class="form-control" name="body" id="body"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection