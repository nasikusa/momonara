@extends('layouts.default')

@section('title' , "{{ $search_word }} の検索結果 - momonara")


@section('content')
<h1>{{ $search_word }}の検索結果</h1>

<p>検索結果 : {{ count($search_result_article_data) }}件</p>

	@if( count($search_result_article_data) > 0 )

		@for( $i = 0 ; $i < count($search_result_article_data) ; $i++ )

		<div>
			<a href="/articles/{{ $search_result_article_data[$i]['id'] }}">
				{{ $search_result_article_data[$i]['title'] }}
			</a>
		</div>

		@endfor

	@else

		<div>該当する記事はありませんでした。</div>

	@endif

@endsection
