<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon-iphone-144.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/favicon-iphone-144.png') }}">

        <link href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('libs/bootstrap/css/bootstrap-grid.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/user.css') }}" rel="stylesheet">

        <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    </head>
    <body class="{{ $body_class }}">
        @include('user.header')

        <div id="content" class="content">
            @yield('content')
        </div>

        <nav id="nav-bottom" class="nav-bottom">
            <ul class="nav-bottom-menu-list">
                <li class="nav-bottom-menu-item">
                    <a href="{{ route('index') }}">
                        <span class="icon">
                            @if (Request::url() === route('index'))
                            <img src="{{ asset('img/common/bottom/icon-home-red.png') }}" alt="">
                            @else
                            <img src="{{ asset('img/common/bottom/icon-home-gray.png') }}" alt="">
                            @endif
                        </span>
                        <span class="text @if (Request::url() === route('index')){{ 'current' }}@endif">ホーム</span>
                    </a>
                </li>

                <li class="nav-bottom-menu-item">
                    <a href="{{ route('front.services.index') }}">
                        <span class="icon">
                            @if (strpos(Request::url(), route('front.services.index')) !== false)
                            <img src="{{ asset('img/common/bottom/icon-search-red.png') }}" alt="">
                            @else
                            <img src="{{ asset('img/common/bottom/icon-search-gray.png') }}" alt="">
                            @endif
                        </span>
                        <span class="text @if (strpos(Request::url(), route('front.services.index')) !== false){{ 'current' }}@endif">探す</span>
                    </a>
                </li>

                <li class="nav-bottom-menu-item">
                    <a href="">
                        <span class="icon">
                            <img src="{{ asset('img/common/bottom/icon-order-gray.png') }}" alt="">
                        </span>
                        <span class="text">申請</span>
                    </a>
                </li>

                <li class="nav-bottom-menu-item">
                    <a href="{{ env('GOOGLE_FORM_URL') }}" target="_blank">
                        <span class="icon">
                            <img src="{{ asset('img/common/bottom/icon-help-gray.png') }}" alt="">
                        </span>
                        <span class="text">相談</span>
                    </a>
                </li>

                <li class="nav-bottom-menu-item">
                    @if (empty(\Auth::user()))
                    <a class="btn-login">
                    @else
                    <a href="{{ route('dashboard') }}">
                    @endif                    
                        <span class="icon">
                            @if (strpos(Request::url(), 'mypage') !== false)
                            <img src="{{ asset('img/common/bottom/icon-mypage-red.png') }}" alt="">
                            @else
                            <img src="{{ asset('img/common/bottom/icon-mypage-gray.png') }}" alt="">
                            @endif
                        </span>
                        <span class="text @if (strpos(Request::url(), 'mypage') !== false){{ 'current' }}@endif">マイページ</span>
                    </a>
                </li>
            </ul>
        </nav>

        <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
        @yield('footer_script')
    </body>
</html>