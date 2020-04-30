@extends('layouts.default')

@section('title' , 'マイページ - momonara' )

@section('content' )

<div class="mypage_all_wrapper">

	<div class="mp_user_info_wrapper">
		<div class="mp_icon_wrapper">
			<a href="/user/{{ $user->id }}">
				@if ( ! empty( $user->p_image_name ) )
				<img src="/storage/icon_images/{{ $user->id }}/{{ $user->p_image_name }}" class="mp_icon_image">
				@else
				<img src="/storage/app_images/ex_icon.jpg" class="mp_icon_image">
				@endif
			</a>
		</div>
		<div>
			<h1 class="mp_user_name">
				<a href="/user/{{ $user->id }}">
					{{ $user->name }}さん
				</a>
			</h1>
		</div>
		<div class="mp_following_button mp_fol_button">
			<a href="/follow">
				フォロー :
				<span class="mp_fol_num">{{ count($my_follow) }}</span>
			</a>
		</div>
		<div class="mp_follower_button mp_fol_button">
			<a href="/follower">
				フォロワー :
				<span class="mp_fol_num">{{ count($my_follower) }}</span>
			</a>
		</div>
		<div class="config_button_wrapper">
			<a href="/mypage/config/main">
				プロフィールを変更
			</a>
		</div>
	</div>

	<div class="mp_main_content_wrapper">
		<div class="mp_left_column">
		<div class="mp_article_all_wrapper">
			<div class="mp_post_article_wrapper">
				<p class="index_article_title">
					投稿記事
				</p>
				@for ( $i = 0 ; $i < count( $my_articles ) ; $i++ )

				<div class="index_follow_article_content index_article_content">
					<div class="index_article_content_left">
						<!-- <img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img"> -->
						<a href="/user/{{ $my_articles[$i]->user_id }}">
							@if ( ! empty($my_articles[$i]->p_image_name ) )
							<img src="/storage/icon_images/{{$my_articles[$i]->user_id}}/{{ $my_articles[$i]->p_image_name }}" class="index_article_icon_img">
							@else
							<img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img">
							@endif
						</a>
					</div>


					<div class="index_article_content_right">
						<p class="index_latest_article_content_title">
							<a href="/articles/{{ $my_articles[$i]->id }}">
								<span class="index_article_name">
									{{ mb_strimwidth( $my_articles[$i]->title , 0 , 103 , "..." , 'UTF-8' ) }}
								</span>
							</a>
						</p>

						<div class="index_article_ud_wrapper">
							<div class="index_article_ud_1">
								<div class="index_article_author">
									<a href="/user/{{ $my_articles[$i]->user_id }}">
										{{ mb_strimwidth( $my_articles[$i]->name , 0 , 28 , "..." , 'UTF-8' ) }}
									</a>
								</div>
								<div class="index_article_date">
									{{ substr($my_articles[$i]->created_at , 0 , 16) }}
								</div>
							</div>
							<div class="index_article_ud_2">
								<div class="index_follow_article_like_count">
									<img src="/storage/app_images/heart1.png" class="index_fav_icon_image">
									@if ( $my_articles[$i]->like_count == null )
									0
									@else
									{{ $my_articles[$i]->like_count }}
									@endif
								</div>
								<div class="index_follow_article_stock_count">
									<img src="/storage/app_images/stock1.png" class="index_stock_icon_image">
									@if ( $my_articles[$i]->stock_count == null )
									0
									@else
									{{ $my_articles[$i]->stock_count }}
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>

				@endfor
			</div>

			<div class="mp_stock_article_wrapper">
				<p class="index_article_title">
					ストックした記事
				</p>
				@for ( $i = 0 ; $i < count( $my_stocks ) ; $i++ )

				<div class="index_follow_article_content index_article_content">
					<div class="index_article_content_left">
						<!-- <img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img"> -->
						<a href="/user/{{ $my_stocks[$i]->user_id }}">
							@if ( ! empty($my_stocks[$i]->p_image_name ) )
							<img src="/storage/icon_images/{{$my_stocks[$i]->user_id}}/{{ $my_stocks[$i]->p_image_name }}" class="index_article_icon_img">
							@else
							<img src="/storage/app_images/ex_icon.jpg" class="index_article_icon_img">
							@endif
						</a>
					</div>


					<div class="index_article_content_right">
						<p class="index_latest_article_content_title">
							<a href="/articles/{{ $my_stocks[$i]->id }}">
								<span class="index_article_name">
									{{ mb_strimwidth( $my_stocks[$i]->title , 0 , 103 , "..." , 'UTF-8' ) }}
								</span>
							</a>
						</p>

						<div class="index_article_ud_wrapper">
							<div class="index_article_ud_1">
								<div class="index_article_author">
									<a href="/user/{{ $my_stocks[$i]->user_id }}">
										{{ mb_strimwidth( $my_stocks[$i]->name , 0 , 28 , "..." , 'UTF-8' ) }}
									</a>
								</div>
								<div class="index_article_date">
									{{ substr($my_stocks[$i]->created_at , 0 , 16) }}
								</div>
							</div>
							<div class="index_article_ud_2">
								<div class="index_follow_article_like_count">
									<img src="/storage/app_images/heart1.png" class="index_fav_icon_image">
									@if ( $my_stocks[$i]->like_count == null )
									0
									@else
									{{ $my_stocks[$i]->like_count }}
									@endif
								</div>
								<div class="index_follow_article_stock_count">
									<img src="/storage/app_images/stock1.png" class="index_stock_icon_image">
									@if ( $my_stocks[$i]->stock_count == null )
									0
									@else
									{{ $my_stocks[$i]->stock_count }}
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>

				@endfor
			</div>
			</div>
		</div>{{-- mp_left_column --}}
		<div class="mp_right_column">
			<div class="mp_side_user_info_wrapper">
				<div class="mp_side_like_wrapper">
					<img src="/storage/app_images/heart1.png" class="mp_like_total_icon">
					<span>いいね数 : {{ $my_articles_like_count[0]['like_count'] }}</span>
				</div>
				<div class="mp_side_stock_wrapper">
					<img src="/storage/app_images/stock1.png" class="mp_stock_total_icon">
					<span>ストック数 : {{ $my_articles_stock_count[0]['stock_count'] }}</span>
				</div>
			</div>
			<section class="mp_side_article_tag_wrapper">
				<h3 class="mp_side_article_tag_title">よく使うタグ</h3>
				@for( $i = 0 ; $i < count( $my_article_tags ) ; $i++ )
					<div class="mp_side_article_tag_content">
					    <a href="/tag/{{ $my_article_tags[$i]['id'] }}">
							{{ $my_article_tags[$i]['name'] }}
							<!-- ( {{ $my_article_tags[$i]['count'] }} ) -->
						</a>
					</div>
				@endfor
			</section>
			<section class="mp_side_latest_follow_wrapper">
				<h3>最近フォローしたユーザー</h3>
				@for( $i = 0 ; $i < count( $my_latest_follow_user ) ; $i++ )
					<div class="mp_side_latest_follow_content">
					    <a href="/user/{{ $my_latest_follow_user[$i]['id'] }}">
							@if ( ! empty( $my_latest_follow_user[$i]['p_image_name']) )
							<img src="/storage/icon_images/{{ $my_latest_follow_user[$i]['id'] }}/{{ $my_latest_follow_user[$i]['p_image_name'] }}">
							@else
							<img src="/storage/app_images/ex_icon.jpg">
							@endif
							<span>{{ $my_latest_follow_user[$i]['name'] }}</soan>
						</a>
					</div>
				@endfor
			</section>
			<section class="mp_side_latest_followed_wrapper">
				<h3>最近フォローされたユーザー</h3>
				@for( $i = 0 ; $i < count( $my_latest_followed_user ) ; $i++ )
					<div class="mp_side_latest_follow_content">
						<a href="/user/{{ $my_latest_followed_user[$i]['id'] }}">
							@if ( ! empty( $my_latest_followed_user[$i]['p_image_name']) )
							<img src="/storage/icon_images/{{ $my_latest_followed_user[$i]['id'] }}/{{ $my_latest_followed_user[$i]['p_image_name'] }}">
							@else
							<img src="/storage/app_images/ex_icon.jpg">
							@endif
							<span>{{ $my_latest_followed_user[$i]['name'] }}</span>
						</a>
					</div>
				@endfor
			</section>
		</div>{{-- mp_right_column --}}
	</div>{{-- mp_main_content_wrapper --}}
</div>{{-- mypage_all_wrapper --}}

@endsection
