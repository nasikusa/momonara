@extends('layouts.default')

@section('title' , '{{ $name }} . さんのマイページ - momonara' )

@section('content' )

<p>{{ $name }}さんのユーザーページ</p>
<p>{{  substr($created_at , 0 , 16 ) }}に登録</p>


投稿記事( 最新順 )<br>

@for ( $i = 0 ; $i < count( $latest_articles ) ; $i++ )

<div>
    <a href="/articles/{{ $latest_articles[$i]['id'] }}}">
        {{ $latest_articles[$i]['title'] }}
    </a>
</div>

@endfor

@endsection
