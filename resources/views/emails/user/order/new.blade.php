<!-- HTMLコード -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $data['title'] }}</title>
    <style>
        p {
            color: #000000;
        }
    </style>
</head>

<body>
    <p>
        この度はAIAI-NOWをご利用いただき誠にありがとうございます。<br>
        以下の申請を受信しました。<br>
        ==================================================<br>
        申請タイトル：{{ $order->title }}<br>
        ==================================================
        <br>
        申請要請の確認中ですが、2~3日間の営業内で対応いたします。<br>
        よろしくお願いいたします。
    </p>
</body>
</html>