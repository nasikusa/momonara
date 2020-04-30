<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
    <meta name="theme-color" content="rgb(0, 136, 213)">
    <meta name="application-name" content="momonara">
    <meta http-equiv="content-language" content="ja">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href='http://youkan.info/favicon.ico' type="image/vnd.microsoft.icon">
    <link rel="apple-touch-icon" href="http://youkan.info/favicon.ico">

	{{-- fonts --}}
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
	{{-- stylesheet --}}
	<link rel="stylesheet" type="text/css" href="/css/main.css">

</head>
<body>
	@include('main_view.header')

	@yield('content')

	{{-- urlにeditorと入っている場合はfooterを読み込まない --}}
	@if (! preg_match('/\/editor\//u' , url()->current()) &&
	strpos(url()->current(),'login') === false &&
	strpos(url()->current(),'register') === false )

		@include('main_view.footer')

	@endif

    @yield('script')

</body>
