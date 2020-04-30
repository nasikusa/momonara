@extends('layouts.default')

@section('title' , "パスワード設定画面 - mononara")

@section('content')
<div class="con_wrapper">
    <div class="con_left_column">
		@include('main_view.config_side_menu')
	</div>
    <div class="con_right_column">
		<form action="/mypage/config/change_password" method="post" id="config_main_form">
			{{ csrf_field() }}

			<div class="con_form_content">
				<div class="con_form_left">
					現在のパスワード
				</div>
				<div class="con_form_right">
					<input type="password" name="my_current_password" class="con_email_input" required autofocus autocomplete="off"></input>
				</div>
			</div>
			<div class="con_form_content">
				<div class="con_form_left">
					新しいパスワード
				</div>
				<div class="con_form_right">
					<input type="password" name="my_password" class="con_email_input" required autocomplete="off"></input>
				</div>
			</div>
			<div class="con_form_content">
				<div class="con_form_left">
					新しいパスワード（確認）
				</div>
				<div class="con_form_right">
					<input type="password" name="my_password_confirm" class="con_email_input" required autocomplete="off"></input>
				</div>
			</div>

			<div class="con_submit_input_wrapper"><input type="submit" value="送信する" class="con_submit_input"></div>

		</form>
	</div>{{-- config_right_column --}}
</div>{{-- con_wrapper --}}



@endsection


@section('script')

<script>

var side_menu = document.getElementsByClassName('con_nav_button');
var profile = side_menu[0];
var mail = side_menu[1];
var password = side_menu[2];

password.children[0].classList.add('con_add_back_class');

</script>

@endsection
