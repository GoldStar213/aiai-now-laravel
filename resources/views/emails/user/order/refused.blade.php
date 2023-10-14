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
        本当に申し訳ございません。<br>
		タイトル：{{ $order->service->title }}<br>
		の注文は拒否されました！<br>
		具体的な内容は運営者とご連携ください。<br>
        よろしくお願いいたします。
    </p>
</body>
</html>