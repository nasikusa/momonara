@extends('layouts.default')

@section('title' , "about - momonara" )

@section('content' )

<div class="ab_all_wrapper">



	<div class="ab_main_content_wrapper">

		<h1 class="ab_title">momonaraとは？</h1>


		<div class="ab_what_wrapper ab_text_wrapper">

			<p class="ab_1_text">
				3DCGをみんなで攻略しよう
				<!-- <img src="/storage/app_images/blender/wrapper1.png"> -->
			</p>
			<p class="ab_2_text">momonaraは<span>3DCG</span>の知識共有サイトです</p>

			<div class="ab_main_image_wrapper">
				<img src="/storage/app_images/blender/main1.png" class="ab_main1_image">
				<!-- <img src="/storage/app_images/blender/main1back2.png" class="ab_main1_back_image"> -->
			</div>

			<div class="ab_hr_wrapper ab_hr1_wrapper">
				<img src="/storage/app_images/blender/hr6.png">
			</div>

		    <div class="ab_3_wrapper">
				<p class="ab_3_text">このサイトが目指すもの</p>
			</div>

			<div class="ab_desc_wrapper">
				<div class="ab_desc_content">
					<img src="/storage/app_images/blender/middle4.png">
					<p>3DCGの世界に技術を共有するスペースを</p>
				</div>
				<div class="ab_desc_content">
					<img src="/storage/app_images/blender/middle3.png">
					<p>知識をシェアされたら、自分もシェアしたくなる</p>
				</div>
				<div class="ab_desc_content">
					<img src="/storage/app_images/blender/middle2.png">
					<p>一人ひとりがもっている知識の集まりが宝になる</p>
				</div>
				<div class="ab_desc_content">
					<img src="/storage/app_images/blender/middle5.png">
					<p>3DCGコミュニティ</p>
				</div>
			</div>

		</div>

		<div class="ab_hr_wrapper ab_hr1_wrapper">
			<img src="/storage/app_images/blender/hr6.png">
		</div>

		<div class="ab_4_wrapper">
			<p class="ab_4_text">特徴</p>
		</div>

		<div class="ab_feature_wrapper">
			<div class="ab_feature_content">
				<img src="/storage/app_images/blender/feature3.png">
				<p>3DCGに特化</p>
			</div>
			<div class="ab_feature_content">
				<img src="/storage/app_images/blender/feature6.png">
				<p>無料で記事作成</p>
			</div>
			<div class="ab_feature_content">
				<img src="/storage/app_images/blender/feature2.png">
				<p>開発者に3DCGの経験あり</p>
			</div>
			<div class="ab_feature_content">
				<img src="/storage/app_images/blender/feature1.png">
				<p>簡単な登録で始められる</p>
			</div>
		</div>

		<div class="ab_4_wrapper">
			<p class="ab_4_text">開発者について</p>
		</div>

		<div class="ab_who_wrapper">
			<div class="ab_who_content">
				<div class="ab_who_item">
					<img src="/storage/app_images/blender/my.jpg" class="ab_who_image">
				</div>
				<div class="ab_who_item">
					<p>
						栂野 真弘 (とがの まさひろ)
						<a href="https://twitter.com/nakanasinokusa" target="_blank">
						<img src="/storage/app_images/twitter_logo_blue.png" class="ab_twitter_logo_my">
						</a>
					</p>
					<p>主な使用言語 : PHP , JavaScrit , HTML , CSS </p>
					<p>ライブラリ・フレームワーク等 : Laravel , jQuery , Three.js , SASS , vagrant , CentOS</p>
					<p>ソフトウェア : Blender(3DCG) , MMD(3DCG) , AfterEffects(動画編集) , PhotoShop(画像加工)</p>
				</div>
			</div>　
				<div class="ab_who_item">
					<a href="https://arusato.net" target="_blank">
						<img src="/storage/app_images/arusato_icon.png" >
					</a>
				</div>
				<div class="ab_who_item">
					<p>
						2016年9月からMMD向け3DCG素材配布サイト「<a href="https://arusato.net" target="_blank">Arusato</a>」を運営
					</p>
				</div>
			</div>
		</div>

		<div class="ab_cg_wrapper">
			<div class="ab_cg_content">
				<div class="ab_cg_item">
					<img src="/storage/app_images/blender/ot2.png">
				</div>
				<div class="ab_cg_item">
					テキスト
				</div>
			</div>
		</div>

		<div>story</div>

		<div class="ab_who_wrapper ab_text_wrapper">
			<p>私が3DCGに初めて触れたのは2年前の6月頃でした。</p>
			<p>MMDでボーカロイド曲のMVを作りたいと思い、１か月ほどかけて動画を作成しました。</p>
			<p>現在は主にBlenderを使用して3DCGを行っていますが、手軽に始められるMMDの存在は大きかったなぁと感じます。</p>
			<p>その後は、3DCG素材の配布サイト「Arusato」を運営したり、twitter等で作品を投稿したり、ボーカロイド曲のMVをまたやらせていただいたりしていました。</p>
			<p>そして今、3DCGを1年半ほど趣味でやってみて思うのは、3DCGは自分が思ったこと、考えたことを実際に作ってみることができて、とても素敵だと思うと同時に、思った以上に知識の共有ができていないのではないか思っています。</p>
			<p>3DCGは思った以上に同じことをすれば、同じような結果になるということが多いと感じます。</p>
			<p>少なくともモデリングであれ、リギングであれ、アニメーションであれ、ソフトウェアの違いはあるものの、共通していることを行っていることが多いと思います。</p>
			<p>そういった共通の知識がもっと、体系的にわかりやすくまとまっていて、みんなで知識を共有できる場所があれば面白いのではないかというのが、このアプリケーションの根底にあります。</p>
		</div>

		</div>


</div>

<div class="ab_cg_image_wrapper">

</div>
<!-- <div class="ab_back_color_wrapper">

</div> -->

<script>

// window.onload = function () {
//
// 	var main_content_wrapper = document.getElementsByClassName('ab_main_content_wrapper').item(0);
//
// 	main_content_wrapper.setAttribute('class' , 'ab_main_content_wrapper_addopa');
//
// 	console.log(main_content_wrapper.className);
// };

// var ab_main_image_wrapper = document.getElementsByClassName('ab_main_image_wrapper').item(0);
//
// var ab_main_image = document.getElementsByClassName('ab_main1_image').item(0);
//
// var ab_main_back_image = document.getElementsByClassName('ab_main1_back_image').item(0);
//
// ab_main_image_wrapper.addEventListener('mouseenter' , function(){
// 	console.log('a');
// 	ab_main_image.classList.add('ab_main_opa');
// 	ab_main_back_image.classList.add('ab_main_back_opa');
// 	// console.log(ab_main_image.classList);
// });
// ab_main_image_wrapper.addEventListener('mouseleave' , function(){
// 	ab_main_image.classList.remove('ab_main_opa');
// 	ab_main_back_image.classList.remove('ab_main_back_opa');
// 	// console.log(ab_main_image.classList);
// });


</script>

@endsection
