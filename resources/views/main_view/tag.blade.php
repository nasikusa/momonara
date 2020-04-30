@extends('layouts.default')

@section('title')
{{ $search_word }} のタグ検索結果 - momonara
@endsection


@section('content')

<div class="search_all_wrapper">

	<h1 class="search_title">「{{ $search_word }}」のタグ検索結果</h1>

	<p>{{ count($search_result_article_data) }}件の記事がありました</p>

		@if( count($search_result_article_data) > 0 )

		<div class="index_follow_article_wrapper">
			@for ( $i = 0 ; $i < count( $search_result_article_data ) ; $i++ )

			<div class="index_follow_article_content index_article_content">
				<div class="index_article_content_left">
					<!-- <img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img"> -->
					<a href="/user/{{ $search_result_article_data[$i]['user_id'] }}">
						@if ( ! empty($search_result_article_data[$i]['p_image_name'] ) )
						<img src="/storage/icon_images/{{$search_result_article_data[$i]['user_id']}}/{{ $search_result_article_data[$i]['p_image_name'] }}" class="index_article_icon_img">
						@else
						<img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img">
						@endif
					</a>
				</div>


				<div class="index_article_content_right">
					<p class="index_latest_article_content_title">
						<a href="/articles/{{ $search_result_article_data[$i]['id'] }}">
							<span class="index_article_name">
								{{ mb_strimwidth( $search_result_article_data[$i]['title'] , 0 , 103 , "..." , 'UTF-8' ) }}
							</span>
						</a>
					</p>

					<div class="index_article_ud_wrapper">
						<div class="index_article_ud_1">
							<div class="index_article_author">
								<a href="/user/{{ $search_result_article_data[$i]['user_id'] }}">
									{{ mb_strimwidth( $search_result_article_data[$i]['name'] , 0 , 28 , "..." , 'UTF-8' ) }}
								</a>
							</div>
							<div class="index_article_date">
								{{ substr($search_result_article_data[$i]['created_at'] , 0 , 16) }}
							</div>
						</div>
						<div class="index_article_ud_2">
							<div class="index_follow_article_like_count">
								<img src="/storage/app_images/heart1.png" class="index_fav_icon_image">
								@if ( $search_result_article_data[$i]['like_count'] == null )
								0
								@else
								{{ $search_result_article_data[$i]['like_count'] }}
								@endif
							</div>
							<div class="index_follow_article_stock_count">
								<img src="/storage/app_images/stock1.png" class="index_stock_icon_image">
								@if ( $search_result_article_data[$i]['stock_count'] == null )
								0
								@else
								{{ $search_result_article_data[$i]['stock_count'] }}
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			@endfor
		</div>

		@else

			<div>該当する記事はありませんでした。</div>

		@endif

</div>

@endsection
