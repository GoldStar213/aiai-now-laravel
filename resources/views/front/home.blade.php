@extends('layouts.front', [ 'body_class' => 'home blog'])

<?php
function custom_number_format($n, $precision = 1) {
    if ($n < 1000) {
        $n_format = number_format($n);
    } else if ($n < 1000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000, $precision) . 'k';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000, $precision) . 'm';
    }

    return $n_format;
}
?>

@section('content')
<section id="main-visual">
    <div class="container">
        <div id="mv-swiper" class="swiper mv-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a class="mv-item" href="{{ route('front.about.index') }}#search">
                        <div class="mv-item-fig" style="background: url({{ asset('img/home/slide-01.png') }}) no-repeat;"></div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="mv-item" href="{{ route('front.about.index') }}#member">
                        <div class="mv-item-fig" style="background: url({{ asset('img/home/slide-02.png') }}) no-repeat;"></div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="mv-item" href="{{ route('front.about.index') }}#orders">
                        <div class="mv-item-fig" style="background: url({{ asset('img/home/slide-03.png') }}) no-repeat;"></div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="mv-item" href="{{ route('front.about.index') }}#member">
                        <div class="mv-item-fig" style="background: url({{ asset('img/home/slide-04.jpg') }}) no-repeat;"></div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="mv-item" href="{{ route('front.about.index') }}#company">
                        <div class="mv-item-fig" style="background: url({{ asset('img/home/slide-05.png') }}) no-repeat;"></div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="mv-item" href="">
                        <div class="mv-item-fig" style=""></div>
                    </a>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" aria-current="true"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
    </div>
</section>

<section id="lead" class="lead">
    <div class="container">
        <h3 class="sec-ttl" style="color: #231816;">サービスを探す</h3>

        <div class="lead-search-list">
            <a id="lead-search-cat" class="lead-search-item">
                <div class="lead-search-item-fig">
                    <img class="pc" src="{{ asset('img/') }}/home/lead-01.png" alt="">
                </div>
                <p class="lead-search-item-txt">01.ジャンル<br>から選ぶ</p>
            </a>
            <a id="lead-search-reg" class="lead-search-item">
                <div class="lead-search-item-fig">
                    <img src="{{ asset('img/') }}/home/lead-02.png" alt="">
                </div>
                <p class="lead-search-item-txt">02.地域から<br>選ぶ</p>
            </a>
            <a class="lead-search-item">
                <div class="lead-search-item-fig">
                    <img src="{{ asset('img/') }}/home/lead-03.png" alt="">
                </div>
                <p class="lead-search-item-txt">03.キーワード<br>検索</p>
            </a>
            <a id="lead-search-item-original-id" class="lead-search-item">
                <div class="lead-search-item-fig">
                    <img src="{{ asset('img/') }}/home/lead-04.png" alt="">
                </div>
                <p class="lead-search-item-txt">04.AIAIの<br>オリジナルID</p>
            </a>
            <a id="lead-search-item-original-id" class="lead-search-item">
                <div class="lead-search-item-fig">
                    <img src="{{ asset('img/') }}/home/lead-05.png" alt="">
                </div>
                <p class="lead-search-item-txt">05.AIについての<br>YouTube</p>
            </a>
            <a id="lead-search-item-original-id" class="lead-search-item">
                <div class="lead-search-item-fig">
                    <img src="{{ asset('img/') }}/home/lead-06.png" alt="">
                </div>
                <p class="lead-search-item-txt">06.AIについての<br>収入方法</p>
            </a>
        </div>

        <div class="lead-tabs-wrapper">
            <ul class="lead-tabs">
                <li><a href="#lead-panel-01"><span>新着順</span></a></li>
                <li><a href="#lead-panel-02"><span>いいね！Ranking</span></a></li>
                <li><a href="#lead-panel-03"><span>評価順</span></a></li>
            </ul>
        </div>

        @for ($i = 0; $i < 3; $i++)
        <div id="lead-panel-0{{ $i + 1 }}" class="lead-panel">
            <div class="lead-service-list">
                @foreach ($services[$i] as $service)
                <div class="lead-service-item">
                    <div class="lead-service-item-fig">
                        <a class="service" href="{{ route('front.services.show', $service->id) }}" style="background: url('{{ $service->getFirstMediaUrl('images') }}') no-repeat;"></a>
                        @if (empty(\Auth::user()))
                        <a class="like btn-login">
                            <img src="{{ asset('img/') }}/common/icon-like-regular.svg" alt="">
                        </a>
                        @else
                        <a class="like" data-good="{{ $service->id }}">
                            @if (\Auth::user()->is_like_service($service->id))
                            <img src="{{ asset('img/') }}/common/icon-like-solid.svg" alt="">
                            @else
                            <img src="{{ asset('img/') }}/common/icon-like-regular.svg" alt="">
                            @endif
                        </a>
                        @endif
                    </div>
                    <div class="lead-service-item-infos">
                        <?php $flag_style = !empty($service->region) ? "background: url('" . asset('img/') . "/common/flags/" . $service->region->code . ".png') no-repeat;'" : ""; ?>
                        <a class="lead-service-item-infos-avatar" href="{{ route('front.services.index') }}?region={{ $service->region_id }}" style="{{ $flag_style }}">
                        </a>
                        <a class="lead-service-item-infos-main" href="{{ route('front.services.show', $service->id) }}"">
                            <span class="title">{{ $service->title }}</span>
                            @if (!empty($service->category))
                            <span class="price">{{ $service->category->title }}</span>
                            @else
                            <span class="price">未分類</span>
                            @endif
                        </a>
                        <div class="lead-service-item-infos-sub">
                            <div class="lead-service-item-infos-sub-rating">
                                <div class="star-ratings">
                                    <span class="ico">
                                        <div class="fill-ratings" style="width: {{ $service->rating / 10 }}%;">
                                            <span>★★★★★</span>
                                        </div>
                                        <div class="empty-ratings">
                                            <span>★★★★★</span>
                                        </div>
                                    </span>
                                </div>
                                <p class="lead-service-item-infos-sub-rating-txt">{{ number_format($service->rating / 200, 1, '.', ',') }}</p>
                            </div>
                            <div class="lead-service-item-infos-sub-like">
                                <span class="ico">
                                    <img src="{{ asset('img/') }}/common/icon-like-solid.svg" alt="" />
                                </span>
                                <span class="txt">{{ custom_number_format($service->likes) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="link-more">
                <a class="link-more-link" href="{{ route('front.services.index') }}?{{ $slugs[$i] }}" style="color: #231816;">もっと見る</a>
            </div>
        </div>
        @endfor
    </div>
</section>

<section id="recent-service" class="recent-service">
    <div class="container">
        <h3 class="sec-ttl">新着AIサービス</h3>

        <div class="recent-service-list">
            @foreach ($recent_services as $service)
            <div class="recent-service-item">
                <a class="recent-service-fig" href="{{ route('front.services.show', $service->id) }}" style="background: url('{{ $service->getFirstMediaUrl('images') }}') no-repeat;">
                </a>
                <div class="recent-service-infos">
                    <?php $flag_style = !empty($service->region) ? "background: url('" . asset('img/') . "/common/flags/" . $service->region->code . ".png') no-repeat;'" : ""; ?>
                    <a class="recent-service-infos-avatar" href="{{ route('front.services.index') }}?region={{ $service->region_id }}" style="{{ $flag_style }}">
                    </a>
                    <a class="recent-service-infos-main" href="{{ route('front.services.show', $service->id) }}">
                        <span class="recent-service-infos-ttl">{{ $service->title }}</span>
                        @if (!empty($service->category))
                        <span class="recent-service-infos-cat">{{ $service->category->title }}</span>
                        @else
                        <span class="recent-service-infos-cat">未分類</span>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="link-more">
            <a class="link-more-link" href="{{ route('front.services.index') }}?sort=recent" style="color: #ffffff;">もっと見る</a>
        </div>
    </div>
</section>

<section id="notices" class="notices">
    <div class="container">
        <h3 class="sec-ttl">お知らせ</h3>

        <div class="notices-box">
            <div class="notices-list">
                <a class="notices-item" href="">
                    <span class="notices-item-date"></span>
                    <span class="notices-item-cat cat-news"></span>
                    <p class="notices-item-ttl"></p>
                </a>
            </div>
        </div>

        <div class="link-more">
            <a class="link-more-link yellow" href="">もっと見る</a>
        </div>
    </div>
</section>

@include('front.partials.modal-original-id')
@stop

@section('footer_script')
<script type="text/javascript" src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
<script type="text/javascript">
$(function() {
	var swiper = new Swiper("#mv-swiper", {
        slidesPerView: 1,
        loop: true,
        speed: 1000, 
        autoplay: {
            delay: 6500,
            disableOnInteraction: false
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            481: {
                slidesPerView: 2,
                spaceBetween: 24,
            }, 
            992: {
                slidesPerView: 3,
                spaceBetween: 24,
            }
        }
    });

    $('.lead-tabs a').on('click', function(){
        $('.lead-panel').hide();
        $('.lead-tabs a.active').removeClass('active');
        $(this).addClass('active');
        
        var panel = $(this).attr('href');
        $(panel).fadeIn(300);
        
        return false;
    });
    
    $('.lead-tabs li:first a').click();

    $('#lead-search-cat').on('click', function() {
        // if ($(window).width() <= 480) {
            $('#nav-category').addClass('active');
        // }
        return false;
    });

    $('#lead-search-reg').on('click', function() {
        // if ($(window).width() <= 480) {
            $('#nav-region').addClass('active');
        // }
        return false;
    });

    $('#lead-search-item-original-id').on('click', function() {
        $('#modal-original-id').fadeIn(300);
        return false;
    });

    $('#modal-original-id-box-close').on('click', function() {
        $('#modal-original-id').hide();
        return false;
    });
});
</script>
@if (!empty(\Auth::user()))
<script>
$(function() {
    $('.lead-service-item .like').on('click', function() {
        $icon = $(this).find('img');
        console.log($icon);

        $.ajax({
            type: 'POST',
            url: '{{ route('user.like.service') }}',
            data: {
                _token:$('meta[name="csrf-token"]').attr('content'),
                user: '{{ \Auth::user()->id }}', 
                service: $(this).data('good'), 
            },
            cache: false,
            accept: 'application/json', 
            datatype: 'json',
            success: function(data) {
                if (data.like) {
                    $icon.attr('src', '{{ asset('img/') }}/common/icon-like-solid.svg');
                } else {
                    $icon.attr('src', '{{ asset('img/') }}/common/icon-like-regular.svg');
                }
            }
        });
    });
});
</script>
@endif
@stop