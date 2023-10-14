@extends('layouts.front', [ 'body_class' => 'service show'])

<?php
function getYoutubeEmbedUrl($url) {
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}
?>

@section('content')
<section id="service-detail" class="service-detail">
    <div class="container">
        <div class="service-detail-lead">
            <div class="service-detail-lead-wrapper">
                <div class="service-detail-lead-fig">
                    <h2 class="service-detail-lead-ttl">{{ $service->title }}</h2>
                    <div class="service-detail-lead-fig-content" style="background: url('{{ $service->getFirstMediaUrl('images') }}') no-repeat;"></div>
                </div>

                @if (!empty(\Auth::user()))
                @if (!\Auth::user()->is_ordered($service->id, 1))
                <form action="{{ route('front.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service" value="{{ $service->id }}">
                    <input type="hidden" name="user" value="{{ \Auth::user()->id }}">
                    <input type="hidden" name="type" value="1">
                    <button type="submit" class="service-detail-link white" href="{{ route('login') }}">翻訳相談</button>
                </form>
                @endif
                @else
                <a class="service-detail-link white btn-login">翻訳相談</a>
                @endif

                @if (!empty(\Auth::user()))
                @if (!\Auth::user()->is_ordered($service->id, 2))
                <form action="{{ route('front.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service" value="{{ $service->id }}">
                    <input type="hidden" name="user" value="{{ \Auth::user()->id }}">
                    <input type="hidden" name="type" value="2">
                    <button type="submit" class="service-detail-link" href="{{ route('login') }}">申請代行相談</button>
                </form>
                @endif
                @else
                <a class="service-detail-link btn-login">申請代行相談</a>
                @endif
            </div>
        </div>

        <div class="service-detail-info">
            <div class="service-detail-texts">
                <p class="service-detail-infos-txt">
                    <span>サービス名</span>
                    {{ $service->title }}
                </p>

                <p class="service-detail-infos-txt">
                    <span>オリジナルID</span>
                    @if (!empty($service->original_id))
                    {{ strtoupper(substr($service->original_id, -4)) }}
                    @else
                    無し
                    @endif
                </p>

                <p class="service-detail-infos-txt">
                    <span>ジャンル</span>
                    @if (!empty($service->category))
                    {{ $service->category->title }}
                    @else
                    未分類
                    @endif
                </p>

                <p class="service-detail-infos-txt">
                    <span>国</span>
                    @if (!empty($service->region))
                    {{ $service->region->name }}
                    @else
                    指定されていません。
                    @endif
                </p>

                <p class="service-detail-infos-txt line-limit">
                    <span>内容</span>
                    @if (!empty($service->content))
                    {!! nl2br($service->content); !!}
                    @endif
                </p>

                <p class="service-detail-infos-txt">
                    <span>料金</span>
                    @if (!empty($service->price))
                    {!! nl2br($service->price); !!}
                    @else
                    指定されていません。
                    @endif
                </p>

                <p class="service-detail-infos-txt">
                    <span>種類</span>
                    @if (!empty($service->type))
                    {!! nl2br($service->type); !!}
                    @else
                    指定されていません。
                    @endif
                </p>

                <div class="service-comments">
                    <div class="service-comments-head">
                        <p class="service-comments-head-ttl">
                            コメント({{ $comments->count() }}件/平点：{{ number_format($service->rating / 200, 1, '.', ',') }})
                        </p>
                        <div class="star-ratings white">
                            <div class="fill-ratings" style="width: {{ $service->rating / 10 }}%;">
                                <span>★★★★★</span>
                            </div>
                            <div class="empty-ratings">
                                <span>★★★★★</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-comments-body">
                        @if (!empty($comments) && $comments->count() > 0)
                        <div class="service-comments-list">
                            @foreach ($comments as $comment)
                            <div class="service-comments-item">
                                <div class="service-comments-item-head">
                                    <p class="service-detail-infos-txt service-comments-item-head-ttl">
                                        <span>{{ $comment->title }}</span>
                                    </p>
                                    <div class="star-ratings">
                                        <div class="fill-ratings" style="width: {{ $comment->rating * 20 }}%;">
                                            <span>★★★★★</span>
                                        </div>
                                        <div class="empty-ratings">
                                            <span>★★★★★</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="service-detail-infos-txt">
                                    {!! nl2br(e($comment->content)) !!}
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="service-detail-infos-txt">このサービスについてのコメントはありません。</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="service-detail-video">
                <?php                
                // $embeded_url = getYoutubeEmbedUrl($service->youtube_url);
                // $embeded_url = $service->youtube_url;
                $embeded_url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>", $service->youtube_url);
                ?>
                {!! $embeded_url !!}
            </div>
        </div>
    </div>
</section>
@stop