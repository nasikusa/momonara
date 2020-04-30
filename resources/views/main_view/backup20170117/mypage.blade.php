@extends('layouts.default')

@section('title' , 'マイページ - momonara' )

@section('content' )

<p>このページはマイページです</p>

{{ $user->name }}さん、こんにちは

<p>フォロー　 :
	<a href="/follow">
		{{ count($my_follow) }}
	</a>
</p>
<p>フォロワー :
	<a href="/follower">
		{{ count($my_follower) }}
	</a>
</p>

<p>投稿した記事</p>

@for ( $i = 0 ; $i < count( $my_articles ) ; $i++ )

<div>
    <a href="/articles/{{ $my_articles[$i]['id'] }}">
		{{ $my_articles[$i]['title'] }}
	</a>
	<span> <a href="/editor/{{ $my_articles[$i]['id'] }}">編集</a></span>
	<span> 削除</span>
</div>
@endfor


<p>ストックしている記事</p>

@for ( $i = 0 ; $i < count( $my_stocks ) ; $i++ )

<div>
	<a href="/articles/{{ $my_stocks[$i]['id'] }}">
		{{ $my_stocks[$i]['title'] }}
	</a>
</div>

@endfor

@endsection
