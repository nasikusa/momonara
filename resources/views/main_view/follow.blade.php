@extends('layouts.default')

@section('title' , 'フォロー - momonara' )

@section('content' )

<div class="fo_all_wrapper">

	<h1 class="fo_title">フォローしているユーザー</h1>

	<div class="fo_user_wrapper">
		@for ($i = 0 ; $i < count( $following_user ) ; $i++)

		<div class="fo_user_content">
			<a href="/user/{{ $following_user[$i]['id'] }}" class="fo_user_link">
				<div class="fo_user_icon_wrapper">
					<img src="/storage/app_images/ex_icon.jpg" class="fo_user_icon_image">
				</div>
				<div class="fo_user_name">
					{{ $following_user[$i]['name'] }}
				</div>
			</a>
		</div>

		@endfor
	</div>
</div>

@endsection
