<div class="g_header">
	<div class="g_logo_wrapper">
		<a href="/"><img src="/storage/app_images/momonara_logo.png" id="g_logo_image"></a>
	</div>

	<div class="g_search_wrapper">
		<form action="/search" method="get" name="search_input" class="g_search_form">
			<input type="text" size=30 placeholder="検索" name="search" class="g_header_search_input" required autocomplete="off">
			<input type="submit" value="送信" class="g_search_submit_input">
		</form>
	</div>

	<div class="g_header_after_all_wrapper">
		<div class="g_editor_link_wrapper">
			<a href="/editor/new">
				記事の新規作成
			</a>
		</div>

	        @if (  \Auth::user() )

	        <div class="g_mypage_link_wrapper">
	            <a href="/mypage">
	            {{ \Auth::user()->name }}さん
	            </a>
	        </div>

			<div class="header_menu_icon_wrapper">
				<img src="/storage/app_images/header_menu_icon.png" class="header_menu_icon">
			</div>

			<div class="g_other_info_box_wrapper">


				<div class="g_logout_link_wrapper">
					<a href="{{ route('logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					Logout
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</div>
			</div>

        @else

        <div class="g_user_def_name">ゲストさん</div>
        <div class="g_register_link_wrapper"><a href="/register">新規登録</a></div>
        <div class="g_login_link_wrapper"><a href="/login">ログイン</a></div>

        @endif

		</div><!-- g_header_after_all_wrapper -->



</div>
