@extends('layout')

@section('title')
マイページ
@endsection

@section('content')
    {{-- ユーザー情報を表示 --}}
    <div class="m-4 p-4 border border-secondary">
        <h5 class="mb-4">Mypage Infomation</h5>
        @if(Auth::check())
            <p>名前：{{ $users['name'] }}</p>
            <p>Eメール：{{ $users['email'] }}</p>
        @endif

    </div>
    {{-- ユーザーのdiary情報を表示 --}}
    <a href="{{ route('diary.create')}}" class="btn btn-outline-primary">新規投稿</a>
    {{ $diaries = $users->diaries }}
    @foreach($diaries as $diary)
        <div class="m-4 p-4 border border-primary">
            <p>{{ $diary['title'] }}</p>
            <p>{{ $diary['body'] }}</p>
            <p>{{ $diary['created_at'] }}</p>

            {{-- ログインユーザーのダイアリーデータを表示 --}}
            @if(Auth::check() && Auth::user()->id == $diary['user_id'] )
                <a class="btn btn-outline-success" href="{{ route('diary.edit', ['id' => $diary['id']]) }}"><i class="fas fa-edit"></i></a>
                <form action="{{ route('diary.destroy', ['id' => $diary['id']]) }}" method="POST" class="d-inline">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                </form>
            @endif
        </div>
    @endforeach

@endsection