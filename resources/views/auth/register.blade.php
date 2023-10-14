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
                <p class="auth-main-lead">ご登録いただいたメールアドレスに会員登録の承認メールを送信いたします。</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">ユーザー名</label>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                        @if ($errors->get('email'))
                            @foreach ($errors->get('email') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">パスワード</label>
                        <input type="password" name="password" required autocomplete="new-password">
                        @if ($errors->get('password'))
                            @foreach ($errors->get('password') as $error)
                                <span class="error">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">パスワードの確認</label>
                        <input type="password" name="password_confirmation" required>
                    </div>

                    <button type="submit">会員登録メールを送信</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
