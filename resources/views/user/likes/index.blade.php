@extends('layouts.app', [ 'body_class' => 'user mypage likes'])

@section('content')
<section id="likes" class="likes">
    <div class="container">
        <h2 class="mypage-ttl">「いいね！」のサービス</h2>

        <div class="like-service-list">
            @foreach ($like_services as $service)
            <div class="like-service-item">
                <div class="like-service-fig">
                    <a class="service" href="{{ route('front.services.show', $service->id) }}" style="background: url('{{ $service->getFirstMediaUrl('images') }}');"></a>
                    <a class="like" data-good="{{ $service->id }}">
                        @if (\Auth::user()->is_like_service($service->id))
                        <img src="{{ asset('img/') }}/common/icon-like-solid.svg" alt="">
                        @else
                        <img src="{{ asset('img/') }}/common/icon-like-regular.svg" alt="">
                        @endif
                    </a>
                </div>
                <div class="like-service-infos">
                    <?php $flag_style = !empty($service->region) ? "background: url('" . asset('img/') . "/common/flags/" . $service->region->code . ".png') no-repeat;'" : ""; ?>
                    <a class="like-service-infos-avatar" href="" style="{{ $flag_style }}">
                    </a>
                    <a class="like-service-infos-main" href="{{ route('front.services.show', $service->id) }}"">
                        <span class="title">{{ $service->title }}</span>
                        @if (!empty($service->category))
                        <span class="price">{{ $service->category->title }}</span>
                        @else
                        <span class="price">未分類</span>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@stop

@section('footer_script')
<script>
$(function() {
    $('.like-service-item .like').on('click', function() {
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

                window.location.href = "{{ route('user.likes') }}";
            }
        });
    });
});
</script>
@stop