@extends('layouts.front', [ 'body_class' => 'order'])

@section('content')
<section id="order-thanks" class="order-thanks">
    <div class="container">
        <p class="order-thanks-txt">
            申請いただきありがとうございます。
        </p>
        <a class="order-show-link" href="{{ route('user.orders.show', $order) }}">
            申請内容を見る
        </a>
    </div>
</section>
@stop