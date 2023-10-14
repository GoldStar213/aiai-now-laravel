<header>
    <div class="site-header">
        <h1 class="logo">
            <a href="{{ route('index') }}">
                <img src="{{ asset('img/') }}/logo.png" alt="">
            </a>
        </h1>
    </div>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav id="global-nav" class="global-nav">
        <div class="global-nav-head">
            <a class="global-nav-head-main" href="">
                <div class="global-nav-head-main-avatar">
                    <img src="{{ asset('storage/assets/img/') }}/common/icon-avatar.svg" alt="">
                </div>
                <div class="global-nav-head-main-infos">
                    <p class="global-nav-head-main-infos-username">{{ \Auth::user()->name }}</p>
                    <p class="global-nav-head-main-infos-usermail">{{ \Auth::user()->email }}</p>
                </div>
            </a>
        </div>
        <div class="global-nav-body">
            <ul class="global-menu-list">
                <li class="global-menu-item">
                    <a href="{{ route('user.likes') }}">
                        <span class="ico">
                            <img src="{{ asset('img') }}/common/icon-like-solid-w.svg" alt="" />
                        </span>
                        <span class="txt">いいね！</span>
                    </a>
                </li>
                <li class="global-menu-item border-bottom">
                    <a href="{{ route('user.orders.index') }}">
                        <span class="ico">
                            <img src="{{ asset('img') }}/common/icon-tag-solid-w.svg" alt="" />
                        </span>
                        <span class="txt">申請</span>
                    </a>
                </li>
                <li class="global-menu-item">
                    <form id="form-logout" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="" onclick="event.preventDefault(); $('#form-logout').submit();">
                            <span class="ico">
                                <img src="{{ asset('img') }}/common/icon-logout.svg" alt="" />
                            </span>
                            <span class="txt">ログアウト</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="global-nav-bg"></div>
</header>