<footer class="footer">

	<div class="footer_wrapper_1">
		<div><a href="/about">momonaraとは？</a></div>
		{{-- <div><a href="/termsofuse">利用規約</a></div> --}}
		{{-- <div><a href="/privacy">プライバシー</a></div> --}}
		{{-- <div><a href="/question">お問い合わせ</a></div> --}}

		 @if (  \Auth::user() )

		 <div>
			 <a href="{{ route('logout') }}"
			 onclick="event.preventDefault();
			 document.getElementById('logout-form').submit();">
			 ログアウト
			 </a>
			 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				 {{ csrf_field() }}
			 </form>
		 </div>

		 @else

		 <div><a href="/register">新規登録</a></div>
		 <div><a href="/login">ログイン</a></div>

		 @endif
	</div>

</footer>
