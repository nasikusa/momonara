@extends('layouts.default')

@section('title' , 'momonara')

@section('description' , 'momonaraは3DCGを使う人のための情報共有サイトです。')

@section('keywords' , 'momonara,ももなら,CG,3DCG')



@section('content')


<div class="fv_description_wrapper">

	<div class="fv_description_text_wrapper">

		<p class="fv_desc_first_text">3DCGをみんなで攻略しよう</p>
		<p class="fv_desc_second_text"><span>momonara</span>は<span>3DCG</span>の<span>知識共有サイト</span>です</p>

		<div class="fv_desc_reglog_wrapper">
			<p class="fv_desc_register">
				<a href="/register">
					新規登録
				</a>
			</p>
			<p class="fv_desc_login">
				<a href="/login">
					ログイン
				</a>
			</p>
		</div>

	</div>

	<div class="index_main_video_over_wrapper"></div>

	<!-- <div class="index_main_video_wrapper"> -->
	@if ( $random_num === 0  )
		<video src="/storage/app_videos/main1_2mbps_10sec_24fps.mp4" autoplay playsinline muted class="index_main_video" loop="true" data-object-fit="cover">
	@elseif ( $random_num === 1 )
		<video src="/storage/app_videos/main2_2mbps_10sec_24fps.mp4" autoplay playsinline muted class="index_main_video" loop="true" data-object-fit="cover">
	@elseif ( $random_num === 2 )
		<video src="/storage/app_videos/main3_2mbps_10sec_24fps.mp4" autoplay playsinline muted class="index_main_video" loop="true" data-object-fit="cover">
	@else
		<video src="/storage/app_videos/main4_2mbps_10sec_24fps.mp4" autoplay playsinline muted class="index_main_video" loop="true" data-object-fit="cover">
	@endif
	<!-- </div> -->

</div>

<div class="fv_wrapper">


	<div class="fv_feature_wrapper">
		<div class="fv_feature_title_wrapper">
			<p class="fv_feature_title">features</p>
		</div>

		<div class="fv_feature_content_wrapper">

			<div class="fv_feature_content">
				<div class="fv_feature_image_wrapper">
					<img src="/storage/app_images/blender/feature_index2.png" class="fv_feature_image">
					<img src="/storage/app_images/blender/feature_index2_after.png" class="fv_feature_image_after">
				</div>
				<div class="fv_feature_text_wrapper">
					<p class="fv_feature_content_title">無料で記事作成</p>
					<p class="fv_feature_content_description">記事作成に料金はかかりません。簡単な登録からサクッと始められます。</p>
				</div>

			</div>
			<div class="fv_feature_content">
				<div class="fv_feature_image_wrapper">
					<img src="/storage/app_images/blender/feature_index3.png" class="fv_feature_image">
					<img src="/storage/app_images/blender/feature_index3_after.png" class="fv_feature_image_after">
				</div>
				<div class="fv_feature_text_wrapper">
					<p class="fv_feature_content_title">3DCGに特化</p>
					<p class="fv_feature_content_description">3DCGを中心とした記事が多く、興味のある記事が集まってきています。</p>
				</div>
			</div>

		</div>

	</div>


</div>


<div class="fv_cg_img_wrapper" id="fv_cg_img_wrapper_1">
		<p>教えあえば、もっと楽しい。</p>
</div>
<div class="fv_cg_img_wrapper" id="fv_cg_img_wrapper_2">
		<p>つながりあえば、もっと強い。</p>
</div>


<!-- <div class="fv_test_container">
  <img class="fv_test_media" data-object-fit="cover" src="/storage/app_images/blender/flat6.png" alt="">

</div> -->







@endsection


@section("script")
<script src="/js/objectFitPolyfill.min.js"></script>
<script>

var feature_image_wrapper = document.getElementsByClassName('fv_feature_image_wrapper');
var feature_image_before = document.getElementsByClassName('fv_feature_image');
var feature_image_after = document.getElementsByClassName('fv_feature_image_after');

for(i = 0 ; i < feature_image_wrapper.length ; i++ )
{

	feature_image_wrapper.item(i).addEventListener('mouseenter' , function(){
		this.children[0].classList.toggle('fv_feature_image_opa_sub');
		this.children[1].classList.toggle('fv_feature_image_opa_add');
	});
	feature_image_wrapper.item(i).addEventListener('mouseleave' , function(){
		this.children[0].classList.toggle('fv_feature_image_opa_sub');
		this.children[1].classList.toggle('fv_feature_image_opa_add');
	});
}



//
// console.log(document.body.scrollHeight);
// console.log(document.body.clientHeight);
//
// var window_width = window.innerWidth;
// var window_height = window.innerHeight;
// console.log(window_height);
//
// var cg_img1_wrapper = document.getElementsByClassName('fv_cg_img1_wrapper').item(0);
//
// var cg_img1_wrapper_rect = cg_img1_wrapper.getBoundingClientRect();
// console.log(cg_img1_wrapper_rect);
//
// var scroll_top;
// window.addEventListener('scroll' , function(){
// 	scroll_top = window.pageYOffset;
// 	window_height = window.innerHeight;
// 	console.log(scroll_top);
// });

</script>

@endsection
