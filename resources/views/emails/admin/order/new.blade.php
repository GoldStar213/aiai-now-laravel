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
        以下の新規申請が届けました。<br>
        ==================================================<br>
        注文タイトル：{{ $order->title }}<br>
        ==================================================
        <br>
        詳細の申請内容は<a href="{{ route('admin.orders.edit', $order->id) }}" target="_blank">こちら</a>からご確認ください。<br>
        よろしくお願いいたします。
    </p>
</body>
</html>