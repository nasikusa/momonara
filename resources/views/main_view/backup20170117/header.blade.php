<div class="g_header">
	<div class="g_logo_wrapper">
		<a href="/"><img src="/storage/app_images/momonara_logo.png" id="g_logo_image"></a>
	</div>

	<div class="g_search_wrapper">
		<form action="/search" method="get" name="search_input" class="g_search_form">
			<input type="text" size=30 placeholder="検索ワードを記入してください" name="search">
			<input type="submit" value="送信">
		</form>
	</div>

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
        @else

        <div>ゲストさん</div>
        <div class="g_register_link_wrapper"><a href="/register">新規登録</a></div>
        <div class="g_login_link_wrapper"><a href="/login">ログイン</a></div>

        @endif



</div>
