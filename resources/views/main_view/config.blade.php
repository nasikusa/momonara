@extends('layouts.default')

@section('title' , "設定画面")

@section('content')
<div class="con_wrapper">
    <div class="con_left_column">
		@include('main_view.config_side_menu')
	</div>
    <div class="con_right_column">
		<form action="/mypage/config/change" method="post" enctype="multipart/form-data" id="config_main_form">
			{{ csrf_field() }}
			<div class="con_form_content">
				<div class="con_form_left">
					プロフィール画像
				</div>
				<div class="con_form_right">
					@if( ! empty( $config_p_image_name) )
					<img src="/storage/icon_images/{{ Auth::user()->id }}/{{ $config_p_image_name }}" alt="icon_image" class="con_icon_image">
					<p class="con_icon_upload_about">画像は200×200のサイズにリサイズされます。大きさが大きい場合は、1 : 1の大きさになるようにトリミングされます。jpeg、png形式の画像のみ投稿可能です。</p>
					@else
					<img src="/storage/app_images/ex_icon.jpg" alt="icon_image">
					<p>現在はデフォルトのアイコンです</p>
					@endif
					    <input type="file" id="con_icon_image_form" name="my_profileimage" accept="image/*">
				</div>
			</div>

			<div class="con_form_content">
				<div class="con_form_left">
					ニックネーム
				</div>
				<div class="con_form_right">
					<input type="text" name="my_name" value="{{ $config_name }}" class="con_name_input" autocomplete="off" required  spellcheck="false"></input>
				</div>
			</div>

			<div class="con_form_content">
				<div class="con_form_left">
					自己紹介
				</div>
				<div class="con_form_right">
					<textarea name="my_introduction" cols="40" rows="20" class="con_selfintro_textarea" autocomplete="off" spellcheck="false">{{ $config_selfintro }}</textarea>
				</div>
			</div>

			<div class="con_submit_input_wrapper"><input type="submit" value="送信する" class="con_submit_input"></div>

		</form>
	</div>{{-- config_right_column --}}
</div>{{-- con_wrapper --}}



@endsection


@section('script')

@if ($errors->has('my_profileimage'))
<script>alert("{{ $errors->first('my_profileimage') }}")</script>
@endif
@if ($errors->has('my_name'))
<script>alert("{{ $errors->first('my_name') }}")</script>
@endif
@if ($errors->has('my_introduction'))
<script>alert("{{ $errors->first('my_introduction') }}")</script>
@endif

<script>

var side_menu = document.getElementsByClassName('con_nav_button');
var profile = side_menu[0];
var mail = side_menu[1];
var password = side_menu[2];

profile.children[0].classList.add('con_add_back_class');

</script>

@endsection
