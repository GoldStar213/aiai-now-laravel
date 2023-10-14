<div class="orders-group">
    <h3 class="orders-group-ttl"><span>{{ $title }} ({{ $orders->count() }})</span></h3>

    <div class="orders-group-order-list">
        @forelse ($orders as $item)
        <div class="orders-group-order-item">
            <div class="orders-group-order-fig">
                <a href="{{ route('front.services.show', $item->service->id) }}" target="_brank" style="background: url('{{ $item->service->getFirstMediaUrl('images') }}');"></a>
            </div>
            <div class="orders-group-order-infos">
                <?php $flag_style = !empty($item->service->region) ? "background: url('" . asset('img/') . "/common/flags/" . $item->service->region->code . ".png') no-repeat;'" : ""; ?>
                <a class="orders-group-order-infos-avatar" href="" style="{{ $flag_style }}">
                </a>
                <a class="orders-group-order-infos-main" href="{{ route('front.services.show', $item->service->id) }}"">
                    <span class="title">{{ $item->service->title }}</span>
                    @if (!empty($item->service->category))
                    <span class="price">{{ $item->service->category->title }}</span>
                    @else
                    <span class="price">未分類</span>
                    @endif
                </a>
            </div>
        </div>
        @empty
        <p class="order-group-order-none">該当の申請はありません。</p>
        @endforelse
    </div>
</div>