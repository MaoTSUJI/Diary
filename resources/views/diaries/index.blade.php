@extends('layout')

@section('tittle')
Diary一覧
@endsection

@section('content')

	{{-- 画像の表示 --}}
	{{-- <img src="{{ asset('/img/taisho.jpg') }}" alt=""> --}}

	<a href="{{ route('diary.create')}}" class="btn btn-outline-primary">新規投稿</a>
	@foreach($diaries as $diary)
		<div class="m-4 p-4 border border-primary">
			<p>{{ $diary['title'] }}</p>
			<p>{{ $diary['body'] }}</p>
			@if($diary->img_url)
				<img src="/{{ str_replace('public/', 'storage/', $diary->img_url) }}">
			@endif
			<p>{{ $diary['created_at'] }}</p>

			{{-- ユーザーでログインしている時だけ表示 --}}
			@if(Auth::check() && Auth::user()->id == $diary['user_id'] )
				<a class="btn btn-outline-success" href="{{ route('diary.edit', ['id' => $diary['id']]) }}"><i class="fas fa-edit"></i></a>
				<form action="{{ route('diary.destroy', ['id' => $diary['id']]) }}" method="POST" class="d-inline">
			    @csrf
			    @method('delete')
			    <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
				</form>
			@endif

			{{-- いいね機能まわりの表示 --}}
			{{-- divタグやと改行されてしまう --}}
			@if(Auth::check() && $diary->likes->contains(function($user){
				return $user->id == Auth::user()->id;
			}))
				{{-- いいねされてたら、いいねを取り消すボタンを設置 --}}
				<form style="display: inline;" class="form-inline" method="post" action="{{ route('diary.dislike', ['id'=> $diary['id']]) }}">
					@csrf
					<button type="submit" class="btn btn-outline-danger">
						<i class="fas fa-thumbs-up"></i>
						<span>{{ $diary->likes->count() }}</span>
					</button>
				</form>


			@else()
				{{-- いいねされてなければ、いいねボタンを設置 --}}
				<form style="display: inline;" class="form-inline" method="post" action="{{ route('diary.like', ['id'=> $diary['id']]) }}">
					@csrf
					<button type="submit" class="btn btn-outline-primary">
						<i class="fas fa-thumbs-up"></i>
						<span>{{ $diary->likes->count() }}</span>
					</button>
				</form>
			@endif

		</div>
	@endforeach
@endsection