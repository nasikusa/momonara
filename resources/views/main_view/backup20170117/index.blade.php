@extends('layouts.default')

@section('title' , 'momonara')

@section('description' , 'momonaraはCGを使う人のための情報共有サイトです。')

@section('keywords' , 'momonara,ももなら,CG')



@section('content')

<div class="index_main_content">

	<div class="index_follow_article_wrapper">
		フォローしているユーザーの最新記事
	</div>

	@for ( $i = 0 ; $i < count( $follow_user_articles ) ; $i++ )

	<div class="index_follow_article_content">
		<p>
            <a href="/user/{{ $follow_user_articles[$i]['user_id'] }}">
                {{ $follow_user_articles[$i]['name'] }}
            </a>
        </p>
        <p>
            {{ substr($follow_user_articles[$i]['created_at'] , 0 , 16) }}
        </p>
        <p class="index_latest_article_content_title">
            <a href="/articles/{{ $follow_user_articles[$i]['id'] }}">
            {{ $follow_user_articles[$i]['title'] }}
            </a>
        </p>
	</div>

	@endfor

    <p>最新の記事</p>

    @for ( $i = 0 ; $i < count( $latest_articles ) ; $i++ )

    <div class="index_latest_article_content" >
        <p>
            <a href="/user/{{ $latest_articles[$i]['user_id'] }}">
                {{ $latest_articles[$i]['name'] }}
            </a>
        </p>
        <p>
            {{ substr($latest_articles[$i]['created_at'] , 0 , 16) }}
        </p>
        <p class="index_latest_article_content_title">
            <a href="/articles/{{ $latest_articles[$i]['id'] }}">
            {{ $latest_articles[$i]['title'] }}
            </a>
        </p>
    </div>

    @endfor

</div>

@endsection
