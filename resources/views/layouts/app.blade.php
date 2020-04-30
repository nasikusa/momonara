<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="rl_wrapper">
        <nav class="rl_nav">
                <div class="rl_app_link_wrapper">
                    <a class="rl_app_link" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="rl_nav">

                    <ul class="rl_nav_wrapper">
                        @guest
                            <li class="rl_reglog_link_wrapper"><a href="{{ route('login') }}">ログイン</a></li>
                            <li class="rl_reglog_link_wrapper"><a href="{{ route('register') }}">新規登録</a></li>
                        @else
                            <li>
                                <a href="#">
                                    {{ Auth::user()->name }}
                                </a>

                                <ul>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
