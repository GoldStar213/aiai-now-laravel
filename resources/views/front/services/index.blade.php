@extends('layouts.front', [ 'body_class' => 'service'])

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
<section id="service-list-area" class="service-list-area">
    <div class="container">
        <div class="service-list-content">
            <p class="service-list-result-count">
                @if (!empty(app('request')->input('cat')))
                    @php
                    $cat = App\Models\Category::where('id', app('request')->input('cat'))->first();
                    @endphp
                    <span>ジャンル「{{ $cat->title }}」の検索結果：</span>
                @elseif (!empty(app('request')->input('region')))
                    @php
                    $reg = App\Models\Region::where('id', app('request')->input('region'))->first();
                    @endphp
                    <span>国「{{ $reg->name }}」の検索結果：</span>
                @elseif (!empty(app('request')->input('sort')) && app('request')->input('sort') == 'ranking')
                <span>人気順の検索結果：</span>
                @elseif (!empty(app('request')->input('sort')) && app('request')->input('sort') == 'recent')
                <span>新着順の検索結果：</span>
                @elseif (!empty(app('request')->input('sort')) && app('request')->input('sort') == 'point')
                <span>評価順の検索結果：</span>
                @elseif (!empty(app('request')->input('orig_id')))
                <span>オリジナルID「{{ app('request')->input('orig_id') }}」の検索結果：</span>
                @else
                <span>全てのサービス：</span>
                @endif
                {{ $count }}件
            </p>
            <div class="service-list-sidebar">
                <div class="service-list-sidebar-block active">
                    <button type="button" id="btn-change-select-option" class="service-list-sidebar-block-ttl">検索条件変更</button>
                    <div class="service-list-sidebar-block-body">
                        <select id="select-option">
                            <option value="">条件を選択してください</option>
                            <option value="cat" @if (!empty(app('request')->input('cat'))){{ 'selected'}}@endif>ジャンルから選ぶ</option>
                            <option value="region" @if (!empty(app('request')->input('region'))){{ 'selected'}}@endif>国別選択</option>
                            <option value="ranking" @if (!empty(app('request')->input('sort')) && app('request')->input('sort') == 'ranking'){{ 'selected'}}@endif>人気順</option>
                            <option value="recent" @if (!empty(app('request')->input('sort')) && app('request')->input('sort') == 'recent'){{ 'selected'}}@endif>新着順</option>
                            <option value="point" @if (!empty(app('request')->input('sort')) && app('request')->input('sort') == 'point'){{ 'selected'}}@endif>評価順</option>
                        </select>

                        @if (empty(app('request')->input('cat')))
                        <select id="select-category" class="select-sup-option" style="display: none;">
                        @else
                        <select id="select-category" class="select-sup-option">
                        @endif
                            <option value="">ジャンルを選択してください</option>
                            @foreach ($categories as $cat)
                            @if (app('request')->input('cat') == $cat->id)
                            <option value="{{ $cat->id }}" selected>{{ $cat->title }}</option>
                            @else
                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endif
                            @endforeach
                        </select>

                        @if (empty(app('request')->input('region')))
                        <select id="select-region"class="select-sup-option" style="display: none;">
                        @else
                        <select id="select-region"class="select-sup-option">
                        @endif
                            <option value="">国を選択してください</option>
                            @foreach ($regions as $reg)
                            @if (app('request')->input('region') == $reg->id)
                            <option value="{{ $reg->id }}" selected>{{ $reg->name }}</option>
                            @else
                            <option value="{{ $reg->id }}">{{ $reg->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="service-list-main">
                @if (!empty($services) && $services->count() > 0)
                <div class="service-list-main-service-list">
                    @foreach ($services as $service)
                    <div class="service-list-main-service-item">
                        <div class="service-list-main-service-fig">
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
                        <div class="service-list-main-service-infos">
                            <?php $flag_style = !empty($service->region) ? "background: url('" . asset('img/') . "/common/flags/" . $service->region->code . ".png') no-repeat;'" : ""; ?>
                            <a class="service-list-main-service-infos-avatar" href="{{ route('front.services.index') }}?region={{ $service->region_id }}" style="{{ $flag_style }}">
                            </a>
                            <a class="service-list-main-service-infos-main" href="{{ route('front.services.show', $service->id) }}"">
                                <span class="title">{{ $service->title }}</span>
                                @if (!empty($service->category))
                                <span class="price">{{ $service->category->title }}</span>
                                @else
                                <span class="price">未分類</span>
                                @endif
                            </a>
                            <div class="service-list-main-service-infos-sub">
                                <div class="service-list-main-service-infos-sub-rating">
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
                                    <p class="service-list-main-service-infos-sub-rating-txt">{{ number_format($service->rating / 200, 1, '.', ',') }}</p>
                                </div>
                                <div class="service-list-main-service-infos-sub-like">
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

                {{ $services->appends($_GET)->links() }}
                @else
                <p class="service-list-main-service-empty">条件に一致されるサービスはありません。</p>
                @endif
            </div>
        </div>
    </div>
</section>

<div id="option-modal">
    <div id="option-modal-box">
        <div class="option-modal-box-header">
            <p class="option-modal-box-header-ttl">検索条件の変更</p>
            <a id="option-modal-box-close"></a>
        </div>
        <div class="option-modal-box-body">
            <ul class="option-list">
                <li class="option-item" id="opt-modal-cat">ジャンル別</li>
                <li class="option-item" id="opt-modal-region">国別</li>
                <li class="option-item" id="opt-modal-ranking">ランキング</li>
                <li class="option-item" id="opt-modal-recent">新着</li>
                <li class="option-item" id="opt-modal-point">評価</li>
            </ul>
        </div>
    </div>
</div>
@stop

@section('footer_script')
<script>
$(function() {
    $('#select-option').on('change', function() {
        $('.select-sup-option').hide();

        if ($(this).val() == 'cat') {
            $('#select-category').show();
        } else if ($(this).val() == 'region') {
            $('#select-region').show();
        } else if ($(this).val() == 'ranking') {
            window.location.href = '{{ route('front.services.index') }}' + '?sort=ranking';
        } else if ($(this).val() == 'recent') {
            window.location.href = '{{ route('front.services.index') }}' + '?sort=recent';
        } else if ($(this).val() == 'point') {
            window.location.href = '{{ route('front.services.index') }}' + '?sort=point';
        }

        return false;
    });

    $('#select-region').on('change', function() {
        if ($(this).val() != '') {
            window.location.href = '{{ route('front.services.index') }}' + '?region=' + $(this).val();
        }
        return false;
    });

    $('#select-category').on('change', function() {
        if ($(this).val() != '') {
            window.location.href = '{{ route('front.services.index') }}' + '?cat=' + $(this).val();
        }
        return false;
    });

    $('#btn-change-select-option').on('click', function() {
        if (window.innerWidth <= 480) {
            $('#option-modal').fadeIn(300);
        }
    });

    $('#option-modal-box-close').on('click', function() {
        $('#option-modal').fadeOut(100);
    });

    $('.option-item').on('click', function() {
        $('#option-modal').fadeOut(100);

        if ($(this).attr('id') == 'opt-modal-cat') {
            $('#nav-category').addClass('active');
        } else if ($(this).attr('id') == 'opt-modal-region') {
            $('#nav-region').addClass('active');
        } else if ($(this).attr('id') == 'opt-modal-ranking') {
            window.location.href = '{{ route('front.services.index') }}' + '?sort=ranking';
        } else if ($(this).attr('id') == 'opt-modal-recent') {
            window.location.href = '{{ route('front.services.index') }}' + '?sort=recent';
        } else if ($(this).attr('id') == 'opt-modal-point') {
            window.location.href = '{{ route('front.services.index') }}' + '?sort=point';
        }
    });
});
</script>
@if (!empty(\Auth::user()))
<script>
$(function() {
    $('.service-list-main-service-item .like').on('click', function() {
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