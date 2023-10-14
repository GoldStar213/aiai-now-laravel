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
        お世話になります。<br>
		タイトル：{{ $order->service->title }}<br>
		の注文は運営者から確認しました。<br>
		これからサイト内でメッセージのやり取りで、<br>
		注文の同意手続きが出来ました。<br>
        よろしくお願いいたします。
    </p>
</body>
</html>