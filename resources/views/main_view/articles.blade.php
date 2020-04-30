@extends('layouts.default')

@section('title' , $article->title )

@section('content' )

<div class="ar_all_wrapper">

	<h1 class="ar_title">{{ $article->title }}</h1>

	@if( $post_user->id === $watch_user_id )
		<div class="article_edit_button_wrapper">
			<a href="/editor/{{ $article_id }}">
			編集ページに移動する
			</a>
		</div>
	@endif

<div class="ar_info_wrapper">

	<div class="ar_author_info_wrapper">
		<div class="ar_author_info_name">
			<a href="/user/{{ $post_user->id }}" class="ar_author_link">
				@if ( ! empty($post_user->p_image_name) )
				<img src="/storage/icon_images/{{ $post_user->id }}/{{ $post_user->p_image_name }}" class="ar_author_icon_image">
				@else
				<img src="/storage/app_images/ex_icon.jpg" class="ar_author_icon_image">
				@endif
		        {{ $post_user->name }}
		    </a>
		</div>
		@if ( $post_user->id !== $watch_user_id )
		<div
		id="article_fol_button"

		@if ( $is_follow == 1 )
		class='article_followed'
		@endif

		data-postuserid="{{ $post_user->id }}"
		data-watchuserid="{{ $watch_user_id }}"
		data-isfollow="{{ $is_follow }}">
			<p class="article_fol_text">
				@if ( $is_follow == 1 )
				フォロー済み
				@else
				フォローする
				@endif
			</p>
		</div>
		@endif

			<div
			id="article_like_button"

			@if ( $is_like === 1 )
			class="article_ajax_button article_liked"
			@else
			class="article_ajax_button"
			@endif

			data-postuserid="{{ $post_user->id }}"
			data-watchuserid="{{ $watch_user_id }}"
			data-articleid="{{ $article_id }}"
			data-islike="{{ $is_like }}">
				<div id="article_like_span" class="article_like_stock_button">
					<p>
						<img src="/storage/app_images/heart1.png" class="article_good_count_img">
						<span class="article_like_stock_num ">
							{{ $article_like_num }}
						</span>
					</p>
				</div>
			</div>
			<div
			id="article_stock_button"

			@if ( $is_stock === 1 )
			class="article_ajax_button article_stocked"
			@else
			class="article_ajax_button"
			@endif

			data-postuserid="{{ $post_user->id }}"
			data-watchuserid="{{ $watch_user_id }}"
			data-articleid="{{ $article_id }}"
			data-isstock="{{ $is_stock }}">
				<div id="article_stock_span" class="article_like_stock_button">
					<p>
						<img src="/storage/app_images/stock1.png" class="article_stock_count_img">
						<span class="article_like_stock_num">
							{{ $article_stock_num }}
						</span>
					</p>
				</div>
			</div>
	</div>
</div>

<div class="article_tag_space">

	@for($i = 0 ; $i < count($article_tag_array) ; $i++)

	<div class="article_tag_content">
		<a href="/tag?tag={{ $article_tag_array[$i] }}">
			{{ $article_tag_array[$i] }}
		</a>
	</div>

	@endfor

</div>



<div class="main_text markdown-body">{{ $article->content }}</div>

</div>{{-- ar_all_wrapper --}}

@endsection


@section('script')

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/marked.min.js"></script>
<script>

marked.setOptions({
	sanitize: true,
	breaks: true,
	// smartLists : true,
});

var main_text = document.getElementsByClassName('main_text').item(0);
main_text.innerHTML = marked(main_text.textContent);
main_text.classList.add('main_text_add_opa');


var article_fol_button = document.getElementById('article_fol_button');

$(function() {

	var like_count_text = $('.article_like_stock_num').eq(0);
	var stock_count_text = $('.article_like_stock_num').eq(1);
	var like_button = $('#article_like_button');
	var stock_button = $('#article_stock_button');
	var follow_button = $('#article_fol_button');

	console.log(stock_count_text[0].innerHTML);

	// stock_count_text[0].innerHTML = Number(stock_count_text[0].innerHTML) + 1;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});

    /*
	 * フォローボタン実行時のajax処理
	 */
    var is_follow = $('#article_fol_button').data('isfollow');
    $('#article_fol_button').on('click' , function() {
		// 記事を書いたユーザーのID
        var follow_user_id = $(this).data('postuserid');
		// 現在見ているユーザーのID (非ログイン時は -1 )
        var watch_user_id = $(this).data('watchuserid');

        if( watch_user_id === -1 ){
            location.href = "/login";
            return false;
        }

        $.post('/follow_ajax' , {
            follow_id : follow_user_id,
            user_id :  watch_user_id,
            is_follow : is_follow

        } , function( result ) {
            if( result == 1 ){
                is_follow = 1;
                $('.article_fol_text').text('フォロー済み');
				follow_button.addClass('article_followed');
            }else if( result == 2 ){
                is_follow = 0;
				$('.article_fol_text').text('フォローする');
				follow_button.removeClass('article_followed');
            }else{

            }
        })
    });

	/*
	 * いいねボタン実行時のajax処理
	 */
    var is_like = $('#article_like_button').data('islike');
    $('#article_like_button').on('click' , function() {
		// 記事を書いたユーザーのID
        var like_user_id = $(this).data('postuserid');
		// 現在見ているユーザーのID (非ログイン時は -1 )
        var watch_user_id = $(this).data('watchuserid');
		// 記事のID
        var article_id = $(this).data('articleid');

        if( watch_user_id === -1 ){
            location.href = "/login";
            return false;
        }

        $.post('/like_ajax' , {
            like_user_id : like_user_id,
            watch_user_id :  watch_user_id,
            article_id : article_id,
            is_like : is_like
        } , function( result ) {
            if( result == 1 ){
                is_like = 1;
				like_count_text[0].innerHTML = Number(like_count_text[0].innerHTML) + 1;
				like_button.addClass('article_liked');
            }else if( result == 2 ){
                is_like = 0;
				like_count_text[0].innerHTML = Number(like_count_text[0].innerHTML) - 1;
				like_button.removeClass('article_liked');
            }else{

            }
        })
    });


	/*
	 * ストックボタン実行時のajax処理
	 */
    var is_stock = $('#article_stock_button').data('isstock');
    $('#article_stock_button').on('click' , function() {
		// 記事を書いたユーザーのID
        var stock_user_id = $(this).data('postuserid');
		// 現在見ているユーザーのID (非ログイン時は -1 )
        var watch_user_id = $(this).data('watchuserid');
		// 記事のID
        var article_id = $(this).data('articleid');

        if( watch_user_id === -1 ){
            location.href = "/login";
            return false;
        }

        $.post('/stock_ajax' , {
            stock_user_id : stock_user_id,
            watch_user_id :  watch_user_id,
            article_id : article_id,
			is_stock : is_stock
        } , function( result ) {
            if( result == 1 ){
                is_stock = 1;
                stock_count_text[0].innerHTML = Number(stock_count_text[0].innerHTML) + 1;
				stock_button.addClass('article_stocked');
            }else if( result == 2 ){
                is_stock = 0;
				stock_count_text[0].innerHTML = Number(stock_count_text[0].innerHTML) - 1;
				stock_button.removeClass('article_stocked');
            }else{

            }
        })
    });


});

</script>

@endsection
