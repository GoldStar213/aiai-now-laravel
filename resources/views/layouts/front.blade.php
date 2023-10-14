<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache">

        <title>{{ env('APP_NAME') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon-iphone-144.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/favicon-iphone-144.png') }}">

        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    </head>
    <body class="{{ $body_class }}">
        <header>
            <div class="container">
                <div class="site-header">
                    <div class="shl">
                        <h1 class="logo">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('img/') }}/logo.png" alt="">
                            </a>
                        </h1>
                    </div>
                    <div class="shr">
                        @if (empty(\Auth::user()))
                        <a class="btn-login">ログイン</a>
                        @else
                        <div class="shr-panel">
                            <a class="shr-panel-icon avatar" href="{{ route('dashboard') }}">
                                <img src="{{ asset('img/') }}/common/icon-avatar.svg" alt="">
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <div id="search-row" class="search-row">
            <form action="{{ route('front.services.index') }}" method="GET">
                <div class="shl-search-form-wrapper">
                    <div class="shl-search-form-category">
                        <select id="shl-search-form-category-select">
                            <option>すべてのジャンル</option>
                            @foreach ($categories as $cat)
                            <option>{{ $cat->title }}</option>
                            @endforeach
                        </select>
                        <span class="shl-search-form-category-ttl">すべてのジャンル</span>
                    </div>
                    <div class="shl-search-form-keyword">
                        <input type="text" name="keyword" value="@if (!empty(app('request')->input('keyword'))){{ app('request')->input('keyword') }}@endif" placeholder="キーワード検索">
                    </div>
                    <button type="submit">
                        <img src="{{ asset('storage/assets/img/') }}/common/icon-search.svg" alt="">
                    </button>
                </div>
            </form>
        </div>

        <nav id="global-nav" class="global-nav">
            <ul class="menu-list">
                <li class="menu-item has-submenu">
                    <a class="menu-item-link" href="{{ route('front.about.index') }}">AIAI-NOWとは？</a>
                </li>
                <li class="menu-item">
                    <a class="menu-item-link" href="{{ route('front.about.index') }}#orders">代行依頼する</a>
                </li>
                @if (empty(\Auth::user()))
                <li class="menu-item">
                    <a class="menu-item-link" href="{{ route('front.about.index') }}#member">会員登録</a>
                </li>
                @endif
                <li class="menu-item">
                    <a class="menu-item-link" href="{{ route('front.about.index') }}#orders">制作依頼相談</a>
                </li>
                <li class="menu-item">
                    <a class="menu-item-link" href="{{ route('front.about.index') }}#company">法人様向けサービス</a>
                </li>
            </ul>
        </nav>

        <div id="content" class="content">
            @yield('content')
        </div>

        <div id="login-modal">
            <div id="login-modal-box">
                <div class="login-modal-box-header">
                    <p class="login-modal-box-header-ttl">ログイン</p>
                    <a id="login-modal-box-close"></a>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-modal-box-body">
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" name="password" required>
                        </div>

                        <div class="form-group-check">
                            <label for="remember_me">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>ログイン情報を保持する</span>
                            </label>
                        </div>

                        <button type="submit">ログイン</button>

                        @if (Route::has('password.request'))
                        <div class="password-reset-row">
                            <a class="password-reset" href="{{ route('password.request') }}">パスワード再設定</a>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="footer-logo">
                    <img src="{{ asset('img/') }}/logo-w.png" alt="">
                </div>
            </div>
            <p class="copyright">© 2023 AIAI-NOW</p>
        </footer>

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
                    <a href="{{ route('front.about.index') }}#search">
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
                    <a href="{{ route('front.about.index') }}#orders">
                        <span class="icon">
                            <img src="{{ asset('img/common/bottom/icon-order-gray.png') }}" alt="">
                        </span>
                        <span class="text">代行依頼</span>
                    </a>
                </li>

                <li class="nav-bottom-menu-item">
                    <a href="{{ route('front.about.index') }}#orders">
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

        <div id="nav-category" class="nav-category">
            <div id="nav-category-bg" class="nav-category-bg nav-category-close"></div>
            <div class="container">
                <p class="nav-cat-ttl">
                    ジャンル別
                    <span id="nav-category-close" class="nav-category-close">
                        <img src="{{ asset('img/common/icon-xmark-solid.svg') }}" >
                    </span>
                </p>
                <div class="nav-cat-list-wrapper">
                    <div class="nav-cat-list">
                        @foreach ($categories as $cat)
                        <a href="{{ route('front.services.index') }}?cat={{ $cat->id }}" class="nav-cat-item">
                            @php
                            $bg_style = !empty($cat->getFirstMediaUrl('images')) ? "background: url('" . $cat->getFirstMediaUrl('images') . "') no-repeat;" : '';
                            @endphp
                            <div class="nav-cat-item-fig" style="{{ $bg_style }}"></div>
                            <p class="nav-cat-item-ttl">{{ $cat->title }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if (!empty($regions))
        <div id="nav-region" class="nav-region">
            <div id="nav-region-bg" class="nav-region-bg nav-region-close"></div>
            <div class="container">
                <p class="nav-reg-ttl">
                    国別選択
                    <span id="nav-region-close" class="nav-region-close">
                        <img src="{{ asset('img/common/icon-xmark-solid.svg') }}" >
                    </span>
                </p>
                <div class="nav-reg-list-wrapper">
                    <div class="nav-reg-list">
                        @foreach ($regions as $reg)
                        <a href="{{ route('front.services.index') }}?region={{ $reg->id }}" class="nav-reg-item">
                            <?php $flag_style = "background: url('" . asset('img/') . "/common/flags/" . $reg->code . ".png') no-repeat;'"; ?>
                            <div class="nav-reg-item-fig" style="{{ $flag_style }}">
                            </div>
                            <p class="nav-reg-item-ttl">{{ $reg->name }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
        @yield('footer_script')
    </body>
</html>
