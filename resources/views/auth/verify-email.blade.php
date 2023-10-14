<x-guest-layout>
    <div class="auth">
        <div class="auth-container">
            <div class="auth-head">
                <h1 class="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('img/') }}/logo.png" alt="">
                    </a>
                </h1>
            </div>

            <div class="auth-main">
                <h2 class="auth-main-ttl">会員登録</h2>
                <p class="auth-main-lead">
                    会員登録ありあとうございます。<br>
                    会員登録を完了するため、認証メールを送信しました。<br>
                    メールに記載されているリンクをクリックし会員登録を完了させてください。
                    @if (session('status') == 'verification-link-sent')
                    <span class="green">
                        認証メールを再度送信しました！
                    </span>
                    @endif
                </p>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit">認証メールを再送信する</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout">ログアウト</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
