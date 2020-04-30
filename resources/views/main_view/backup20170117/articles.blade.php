@extends('layouts.default')

@section('title' , $article->title )

@section('content' )

<div class="ar_all_wrapper">

	<h1 class="ar_title">{{ $article->title }}</h1>

	@if( $post_user->id === $watch_user_id )
		<div>
			<a href="/editor/{{ $article_id }}">
			編集
			</a>
		</div>
	@endif

<div class="ar_info_wrapper">

	<div class="ar_author_info_wrapper">
		<div class="ar_author_info_name">
			<a href="/user/{{ $post_user->id }}" class="ar_author_link">
				<img src="/storage/app_images/ex_icon.jpg" class="ar_author_icon_image">
		        {{ $post_user->name }}
		    </a>
		</div>
		@if ( $post_user->id !== $watch_user_id )
		<div
		id="article_fol_button"
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
			<p class="article_fol_num">{{ $article_author_fol_num }}フォロワー</p>
		</div>
		@endif
	</div>

	<div class="article_like_stock_info">
		<span>いいね : {{ $article_like_num }}</span>
		<span>ストック : {{ $article_stock_num }}</span>
	</div>



	@if ( $post_user->id !== $watch_user_id )
    <p
    id="article_like_button"
    data-postuserid="{{ $post_user->id }}"
    data-watchuserid="{{ $watch_user_id }}"
    data-articleid="{{ $article_id }}"
    data-islike="{{ $is_like }}">
		<span id="article_like_span">
		    @if ( $is_like === 1 )
		    いいね
		    @else
		    いいね
		    @endif
		</span>
    </p>
    <p
    id="article_stock_button"
    data-postuserid="{{ $post_user->id }}"
    data-watchuserid="{{ $watch_user_id }}"
    data-articleid="{{ $article_id }}"
    data-isstock="{{ $is_stock }}">
		<span id="article_stock_span">
		    @if ( $is_stock === 1 )
		    ストック
		    @else
		    ストック
		    @endif
		</span>
    </p>

    @endif
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



<div class="main_text">{!! e(nl2br($article->content)); !!}</div>

</div>{{-- ar_all_wrapper --}}

@endsection


@section('script')

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/marked.min.js"></script>
<script>
var main_text = document.getElementsByClassName('main_text').item(0);
main_text.innerHTML = marked(main_text.textContent);

var article_fol_button = document.getElementById('article_fol_button');

$(function() {

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
                $('#article_fol_span').text('フォローしています');
            }else if( result == 2 ){
                is_follow = 0;
				$('#article_fol_span').text('フォローする');
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
                $('#article_like_span').text('いいねしました');
            }else if( result == 2 ){
                is_like = 0;
                $('#article_like_span').text('いいね');
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
                $('#article_stock_span').text('ストックしました');
            }else if( result == 2 ){
                is_stock = 0;
                $('#article_stock_span').text('ストックする');
            }else{

            }
        })
    });


});

</script>

@endsection
