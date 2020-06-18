@extends('layouts.default')

@section('content')
<div class="rl_wrapper">
	<div class="rl_form_outer_wrapper">
		<div class="rl_form_wrapper">
            <div class="rl_title">ログイン ( Login )</div>
            <div>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div>
                        <label class="rl_form_label">Eメールアドレス</label>

                        <div>
                            <input id="email" type="email" class="form-control rl_form_input" name="email" value="{{ old('email') }}" required autofocus autocomplete="off">

                            @if ($errors->has('email'))
                                <p class="rl_error_wrapper">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="rl_form_label">パスワード</label>

                        <div>
                            <input id="password" type="password" class="form-control rl_form_input" name="password" required autocomplete="off">

                            @if ($errors->has('password'))
                                <p class="rl_error_wrapper">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label>
                            <input class="rl_form_checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>継続ログインする
                        </label>
                    </div>

                    <div>
                        <div>
                            <button type="submit" class="rl_login_button">
                                ログイン
                            </button>

                            <!-- <a class="rl_password_forget_anchor" href="{{ route('password.request') }}">
                                パスワードを忘れてしまいましたか？
                            </a> -->
                        </div>
                    </div>
                </form>
	    </div>
    </div>
</div>

	<div class="rl_back_image_wrapper">
		@php
        $random_num = rand(0,6);
		$back_image_name = "";
		switch($random_num){
			case 0:
			    // タイル
				$back_image_name = "back1b.jpg";
				break;
			case 1:
			    // ブルーホワイト
			    $back_image_name = "back10.png";
				break;
			case 2:
			    // 斜め視点の正方形（紫、オレンジ）
			    $back_image_name = "back3a.jpg";
				break;
			case 3:
			    // 深海
				$back_image_name = "back14a.png";
				break;
			case 4:
			    // 動物園カラー
			    $back_image_name = "back12a.png";
				break;
			case 5:
			    // 水平 ブルーオレンジ
			    $back_image_name = "back8b.png";
				break;
			case 6:
			    // どろどろ
			    $back_image_name = "back11a.png";
				break;
		}
		@endphp
		<img src="/storage/app_images/blender/{{ $back_image_name }}" class="rl_back_image" data-object-fit="cover">
	</div>

</div>
@endsection

@section('script')
<script src="/js/objectFitPolyfill.min.js"></script>
@endsection
