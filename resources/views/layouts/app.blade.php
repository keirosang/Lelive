<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title or 'Niconiconi' }}</title>
    <link rel="shortcut icon" href="{{ url('/favicon.ico') }}">
    <link rel="stylesheet" href="//cdn.bootcss.com/material-design-lite/1.1.1/material.min.css">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link href="//cdn.bootcss.com/material-design-icons/2.2.0/iconfont/material-icons.css" rel="stylesheet">
    <link href="https://fonts.iwch.me/css?family=Open+Sans:600" rel='stylesheet' type='text/css'>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header header-background-image">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title site-title" onclick="window.location='{{ url('/') }}'">{{ $title or 'Niconiconi' }}</span>
            <div class="mdl-layout-spacer"></div>
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="{{ url('/about') }}">About</a>
                @if (Auth::guest())
                    <a class="mdl-navigation__link" href="{{ url('/register') }}">Register</a>
                    <a class="mdl-navigation__link" href="{{ url('/login') }}">Login</a>
                @else
                    <a class="mdl-navigation__link" href="{{ url('/account') }}">{{ Auth::user()->name }}</a>
                    <a class="mdl-navigation__link" href="{{ url('/logout') }}">Logout</a>
                @endif
            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">{{ $title or 'Niconiconi' }}</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="{{ url('/') }}">首页</a>
            <a class="mdl-navigation__link" href="{{ url('/about') }}">关于</a>
            @if (Auth::guest())
                <a class="mdl-navigation__link" href="{{ url('/register') }}">注册</a>
                <a class="mdl-navigation__link" href="{{ url('/login') }}">登录</a>
            @else
                <a class="mdl-navigation__link" href="{{ url('/account') }}">{{ Auth::user()->name }}</a>
                <a class="mdl-navigation__link" href="{{ url('/logout') }}">登出</a>
            @endif
        </nav>
    </div>
    <main class="mdl-layout__content">
        @yield('content')
    </main>
</div>
<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.js"></script>
<script src="//cdn.bootcss.com/material-design-lite/1.1.1/material.min.js"></script>
@yield('js')
</body>
</html>