@extends('layouts.default')

@section('title' , 'momonara')

@section('description' , 'momonaraはCGを使う人のための情報共有サイトです。')

@section('keywords' , 'momonara,ももなら,CG')



@section('content')

<div class="fv_description_wrapper">

	<div class="fv_description_text_wrapper">

		<p><b>momonara</b>へようこそ！</p>

		<p><b>momonara</b>は<b>3DCG</b>を使う人のための<b>知識共有サイト</b>です</p>

	</div>

</div>

<div class="fv_wrapper">


	<div class="fv_feature_wrapper">
		<div class="fv_feature_title_wrapper">
			<p class="fv_feature_title">Features</p>
		</div>

		<div class="fv_feature_content_wrapper">

			<div class="fv_feature_content">
				<img src="/storage/app_images/fv_image1.png" class="fv_feature_image">
				<p class="fv_feature_content_title">無料で記事作成</p>
				<p class="fv_feature_content_description">記事作成に料金はかかりません。簡単な登録からサクッと始められます。</p>

			</div>
			<div class="fv_feature_content">
				<img src="/storage/app_images/fv_image2.png" class="fv_feature_image">
				<p class="fv_feature_content_title">3DCGに特化</p>
				<p class="fv_feature_content_description">3DCGを中心とした記事が多く、興味のある記事が集まってきています。</p>

			</div>

		</div>

	</div>

</div>


@endsection
