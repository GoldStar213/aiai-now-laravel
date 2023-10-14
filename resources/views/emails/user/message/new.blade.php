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
        運営者から以下のメッセージが届きました。<br>
        ==================================================<br>
        申請タイトル：{{ $order->service->title }}<br>
        ==================================================
        <br>
        詳細は<a href="{{ route('user.orders.show', $order->id) }}" target="_blank">こちら</a>からご確認ください。<br>
        よろしくお願いいたします。
    </p>
</body>
</html>