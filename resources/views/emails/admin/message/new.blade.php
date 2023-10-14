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
        ユーザーから新着のメッセージが届けました。<br>
        ==================================================<br>
        注文タイトル：{{ $order->service->title }}<br>
		メールアドレス：{{ $order->user->email }}<br>
        ==================================================
        <br>
        詳細は<a href="{{ route('admin.orders.edit', $order->id) }}" target="_blank">こちら</a>からご確認ください。<br>
        よろしくお願いいたします。
    </p>
</body>
</html>