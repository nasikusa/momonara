@extends('layouts.default')

@section('title' , "設定画面")


@section('content')

<div clsss="config_page_all">

	<form action="/mypage/config/change">

		<div>プロフィール画像 : <input type="file" name="my_profileimage" accept="image/*"></div>

		<div>ニックネーム : <input type="text" name="my_name" size=50></input></div>

		<div>自己紹介 : <textarea name="my_introduction" cols="40" rows="20"></textarea></div>

		<div><input type="submit" value="送信する"></div>

	</form>

	<div><a href="/mypage/config/email">メールアドレスの変更ページを開く（新しいタブ）</a></div>
	<div><a href="/mypage/config/password">パスワードの変更ページを開く(新しいタブ)</a></div>

</div>

@endsection
