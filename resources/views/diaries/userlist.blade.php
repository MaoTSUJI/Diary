@extends('layout')

@section('title')
ユーザー一覧
@endsection

@section('content')

    
    <div class="m-4 p-4 border border-secondary">
        <h5 class="mb-4">Users</h5>
            @foreach($userlist as $user)
                @if(Auth::check())
                    <p>{{ $user['name'] }}</p>
                @endif
            @endforeach
    </div>


@endsection