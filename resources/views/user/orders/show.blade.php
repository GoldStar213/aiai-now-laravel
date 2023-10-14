@extends('layouts.app', [ 'body_class' => 'user mypage orders'])

@section('content')
<section id="orders" class="orders">
    <div class="container">
        <h2 class="mypage-ttl">申請</h2>
        <div class="row">
            <div class="col-sm-12 col-xl-6">
                <div class="form-group">
                    <label for="title">サービス名</label>
                    <p class="mypage-txt">{{ $order->service->title }}</p>
                    <div class="img-preview">
                        <img src="{{ $order->service->getFirstMediaUrl('images') }}" alt="" />
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-xl-6">
                <div class="form-group mb-2">
                    <label for="title">メッセージ</label>
                    <div id="msg-area" class="msg-area">
                    @forelse ($order->messages as $msg)
                    <?php
                    $style_msg_direction = ($msg->send_id == 0) ? "right" : "left";
                    ?>
                    <div class="msg-item {{ $style_msg_direction }}">
                        @if ($style_msg_direction == "right")
                        <p class="msg-item-head">運営者<span class="date">{{ $msg->created_at->format('Y年m月d日 H:i') }}</span></p>
                        @else
                        <p class="msg-item-head">&nbsp;<span class="date">{{ $msg->created_at->format('Y年m月d日 H:i') }}</span></p>
                        @endif
                        <p class="msg-item-txt">{!! nl2br($msg->content) !!}</p>
                    </div>
                    @empty
                    @endforelse
                    </div>
                </div>
                @if ($order->status == 1)
                <div class="form-group msg-form">
                    <form action="{{ route('user.orders.message') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order" value="{{ $order->id }}">
                        <input type="hidden" name="user" value="{{ \Auth::user()->id }}">
                        <textarea class="form-group" style="resize: none;" rows="3" name="message" required></textarea>
                        <button type="submit" class="btn">メッセージを送信する</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@stop

@section('footer_script')
<script>
$(function() {
    $('#msg-area').scrollTop($('#msg-area').prop("scrollHeight"));
});
</script>
@stop