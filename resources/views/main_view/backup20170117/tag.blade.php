@extends('layouts.default')

@section('title' , "{{ $search_word }} の検索結果 - momonara")


@section('content')
<h1>{{ $search_word }}の検索結果</h1>

<p>検索結果 : {{ count($tag_article_list) }}件</p>

	@if( count($tag_article_list) > 0 )

		@for( $i = 0 ; $i < count($tag_article_list) ; $i++ )

		<div>
			<a href="/articles/{{ $tag_article_list[$i]['id'] }}">
				{{ $tag_article_list[$i]['title'] }}
			</a>
		</div>

		@endfor

	@else

		<div>該当する記事はありませんでした。</div>

	@endif

@endsection
