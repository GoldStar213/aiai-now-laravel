@extends('layouts.app', [ 'body_class' => 'user mypage orders'])

<?php
$status_ttl = [ '確認中', '確認']
?>

@section('content')
<section id="orders" class="orders">
    <div class="container">
        <h2 class="mypage-ttl">申請</h2>

        @if (!empty($orders) && $orders->count() != 0)
        <table class="tbl-orders-list">
            <thead>
                <th>サービス名</th>
                <th>ジャンル</th>
                <th>状態</th>
                <th>操作</th>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->service->title }}</td>
                    <td>
                        @if (!empty($order->service->category))
                        {{ $order->service->category->title }}
                        @endif
                    </td>
                    <td>
                        @if ($order->status >= 0)
                        {{ $status_ttl[$order->status] }}
                        @else
                        拒否
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.orders.show', $order->id) }}">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>
        @else
        <p class="mypage-txt">注文はありません。</p>
        @endif
    </div>
</section>
@stop