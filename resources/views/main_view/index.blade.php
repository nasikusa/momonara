@extends('layouts.default')

@section('title' , 'momonara')

@section('description' , 'momonaraはCGを使う人のための情報共有サイトです。')

@section('keywords' , 'momonara,ももなら,CG')



@section('content')

<div class="index_all_wrapper">

<div class="index_left_column">

	<div class="index_target_wrapper">
		<p class="index_target_title">記事タイプ選択</p>
		<div class="index_target_button_wrapper">
			<p class="index_target_button index_target_now">フォローユーザー</p>
			<p class="index_target_button">最新</p>
			<p class="index_target_button">フォロータグ</p>
		</div>
	</div>

	<div class="index_follow_article_wrapper">
		<p class="index_article_title">
			フォローユーザーの最新記事
		</p>
		@for ( $i = 0 ; $i < count( $follow_user_articles ) ; $i++ )

		<div class="index_follow_article_content index_article_content">
			<div class="index_article_content_left">
				<!-- <img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img"> -->
				<a href="/user/{{ $follow_user_articles[$i]->user_id }}">
					@if ( ! empty($follow_user_articles[$i]->p_image_name ) )
					<img src="/storage/icon_images/{{$follow_user_articles[$i]->user_id}}/{{ $follow_user_articles[$i]->p_image_name }}" class="index_article_icon_img">
					@else
					<img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img">
					@endif
				</a>
			</div>


			<div class="index_article_content_right">
				<p class="index_latest_article_content_title">
					<a href="/articles/{{ $follow_user_articles[$i]->id }}">
						<span class="index_article_name">
							{{ mb_strimwidth( $follow_user_articles[$i]->title , 0 , 103 , "..." , 'UTF-8' ) }}
						</span>
					</a>
				</p>

				<div class="index_article_ud_wrapper">
					<div class="index_article_ud_1">
						<div class="index_article_author">
							<a href="/user/{{ $follow_user_articles[$i]->user_id }}">
								{{ mb_strimwidth( $follow_user_articles[$i]->name , 0 , 28 , "..." , 'UTF-8' ) }}
							</a>
						</div>
						<div class="index_article_date">
							{{ substr($follow_user_articles[$i]->created_at , 0 , 16) }}
						</div>
					</div>
					<div class="index_article_ud_2">
						<div class="index_follow_article_like_count">
							<img src="/storage/app_images/heart1.png" class="index_fav_icon_image">
							@if ( $follow_user_articles[$i]->like_count == null )
							0
							@else
							{{ $follow_user_articles[$i]->like_count }}
							@endif
						</div>
						<div class="index_follow_article_stock_count">
							<img src="/storage/app_images/stock1.png" class="index_stock_icon_image">
							@if ( $follow_user_articles[$i]->stock_count == null )
							0
							@else
							{{ $follow_user_articles[$i]->stock_count }}
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		@endfor
	</div>

	<div class="index_latest_article_wrapper">
	    <p class="index_article_title">
			最新記事
		</p>

	    @for ( $i = 0 ; $i < count( $latest_articles ) ; $i++ )

	    <div class="index_latest_article_content index_article_content" >
			<div class="index_article_content_left">
				<a href="/user/{{ $latest_articles[$i]->user_id }}">
					@if ( ! empty($latest_articles[$i]->p_image_name ) )
					<img src="/storage/icon_images/{{$latest_articles[$i]->user_id}}/{{ $latest_articles[$i]->p_image_name }}" class="index_article_icon_img">
					@else
					<img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img">
					@endif
				</a>
			</div>
			<div class="index_article_content_right">
				<p class="index_latest_article_content_title">
					<a href="/articles/{{ $latest_articles[$i]->id }}">
						<span class="index_article_name">
							{{ mb_strimwidth( $latest_articles[$i]->title , 0 , 103 , "..." , 'UTF-8' ) }}
						</span>
					</a>
				</p>
				<div class="index_article_ud_wrapper">
					<div class="index_article_ud_1">
						<div class="index_article_author">
							<a href="/user/{{ $latest_articles[$i]->user_id }}">
								{{ mb_strimwidth( $latest_articles[$i]->name , 0 , 28 , "..." , 'UTF-8' ) }}
							</a>
						</div>
						<div class="index_article_date">
							{{ substr($latest_articles[$i]->created_at , 0 , 16) }}
						</div>

					</div>
					<div class="index_article_ud_2">
						<div class="index_latest_article_like_count">
							<img src="/storage/app_images/heart1.png" class="index_fav_icon_image">
							@if ( $latest_articles[$i]->like_count == null )
							0
							@else
							{{ $latest_articles[$i]->like_count }}
							@endif
						</div>
						<div class="index_latest_article_stock_count">
						    <img src="/storage/app_images/stock1.png" class="index_stock_icon_image">
							@if ( $latest_articles[$i]->stock_count == null )
							0
							@else
							{{ $latest_articles[$i]->stock_count }}
							@endif
						</div>
					</div>
				</div>

		    </div>
		</div>

	    @endfor
	</div>

</div>{{-- index_left_column --}}

<div class="index_right_column">

	<div class="index_user_ranking_wrapper">

		<p class="index_user_ranking_title">人気のユーザー</p>

		<p class="index_user_ranking_week_title">1週間</p>
		<div class="index_user_ranking_week_wrapper">
			@for ( $i = 0 ; $i < count($user_rank_week) ; $i++ )
			<div class="user_like_ranking_content">
				<p class="user_like_ranking_user_info">
					<a href="/user/{{ $user_rank_week[$i]['liked_author_id'] }}">
					@if( ! empty( $user_rank_week[$i]['p_image_name'] ) )
						<img src="/storage/icon_images/{{ $user_rank_week[$i]['liked_author_id'] }}/{{ $user_rank_week[$i]['p_image_name'] }}" class="index_user_ranking_icon">
					@else
						<img src="/storage/app_images/ex_icon.jpg" class="index_user_ranking_icon">
					@endif
					<span class="index_user_rank_name">
						{{ $user_rank_week[$i]['name'] }}
					</span>
					</a>
				</p>
				<!-- <p class="user_like_ranking_like_count">{{ $user_rank_week[$i]['like_count'] }}</p> -->
			</div>
			@endfor
		</div>

		<p class="index_user_ranking_total_title">トータル</p>

		<div class="index_user_ranking_total_wraper">
			@for ( $i = 0 ; $i < count($user_rank_total) ; $i++ )
			<div class="user_like_ranking_content">
				<p class="user_like_ranking_user_info">
					<a href="/user/{{ $user_rank_total[$i]['liked_author_id'] }}">
					@if( ! empty( $user_rank_total[$i]['p_image_name'] ) )
						<img src="/storage/icon_images/{{ $user_rank_total[$i]['liked_author_id'] }}/{{ $user_rank_total[$i]['p_image_name'] }}" class="index_user_ranking_icon">
					@else
						<img src="/storage/app_images/ex_icon.jpg" class="index_user_ranking_icon">
					@endif
					<span class="index_user_rank_name">
						{{ $user_rank_total[$i]['name'] }}
					</span>
					</a>
				</p>
				<!-- <p class="user_like_ranking_like_count">{{ $user_rank_total[$i]['like_count'] }}</p> -->
			</div>
			@endfor
		</div>
	</div>{{-- index_user_ranking_wrapper --}}


	<div class="index_tag_ranking_wrapper">
		<p class="index_tag_ranking_title">人気のタグ</p>

		@for ($i = 0 ; $i < count($tag_ranking) ; $i++ )
		<div class="index_tag_ranking_content">
			<a href="/tag?tag={{ $tag_ranking[$i]['name'] }}">
			{{ $tag_ranking[$i]['name'] }}
			( {{ $tag_ranking[$i]['tag_count'] }} )
			</a>
		</div>
		@endfor
	</div>

</div>{{-- index_right_column --}}

</div>{{-- index_all_wrapper --}}

@endsection

@section('script')
<script>
var index_target_button = document.getElementsByClassName('index_target_button');

for(var i = 0 ; i < index_target_button.length ; i++ ){
	index_target_button[i].addEventListener('click' , function(){

		for(var j = 0 ; j < index_target_button.length ; j++ ){
			index_target_button[j].classList.remove('index_target_now');
		}
		this.classList.add('index_target_now');
	});
}

</script>
@endsection
