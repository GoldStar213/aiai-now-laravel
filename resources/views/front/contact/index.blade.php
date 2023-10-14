@extends('layouts.front', [ 'body_class' => 'contact index'])

@section('content')
<div class="contact-area">
    <div class="container">
        <h2 class="contacti-ttl">お問い合わせ</h2>
        <form action="{{ route('front.contact.submit') }}" method="post">
            @csrf
            <div class="contact-box">
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="type">種類</label>
                    <select name="type" required>
                        <option value="1" @if($type == 1){{ 'selected' }}@endif>リクエストリサーチ</option>
                        <option value="2" @if($type == 2){{ 'selected' }}@endif>制作相談</option>
                        <option value="0" @if($type == 0){{ 'selected' }}@endif>その他</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">内容</label>
                    <textarea name="content" required></textarea>
                </div>

                <button type="submit">送信する</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('footer_script')
<script>
$(function() {
});
</script>
@stop