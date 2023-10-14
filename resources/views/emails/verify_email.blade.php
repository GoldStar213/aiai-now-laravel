<x-mail::message>
ご登録いただきありがとうございます。<br>
下のボタンをクリックしてメールアドレスを認証してください。<br><br>

<x-mail::button :url="$verify_url">
メールアドレスを認証
</x-mail::button>

<br>
お心当たりのない場合はお手数ですが、破棄していただけますようお願いいたします。<br>
今後とも{{ config('app.name') }}をよろしくお願いいたします。
</x-mail::message>
