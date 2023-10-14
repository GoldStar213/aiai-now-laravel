@php
$type_ttl = [
	'その他', 'リクエストリサーチ', '制作依頼'
];

$status_ttl = [
	'未確認', '確認済', '完了済'
];
@endphp

@if ($target == 'store')
<form action="{{ route('admin.contacts.store') }}" method="post">
@elseif ($target == 'update')
<form action="{{ route('admin.contacts.update', $contact->id) }}" method="post">
    <input type="hidden" name="_method" value="put">
@endif
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">お問い合わせ情報</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-4">
                    <div class="form-group">
                        <label for="name">メールアドレス</label>
                        <input type="text" class="form-control" value="{{ $contact->email }}" disabled />
                    </div>
                </div>

                <div class="col col-4">
                    <div class="form-group">
                        <label for="name">種類</label>
                        <input type="text" class="form-control" value="{{ $type_ttl[$contact->type] }}" disabled />
                    </div>
                </div>

                <div class="col col-4">
                    <div class="form-group">
                        <label for="name">状態</label>
                        <select class="form-control" name="status" required>
                            <option value="0" @if($contact->status == 0){{ 'selected' }}@endif>未確認</option>
                            <option value="1" @if($contact->status == 1){{ 'selected' }}@endif>確認済</option>
                            <option value="2" @if($contact->status == 2){{ 'selected' }}@endif>完了済</option>
                        </select>
                    </div>
                </div>

                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">内容</label>
                        <textarea class="form-control" style="height: 200px; resize: none;" disabled />{{ $contact->content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            @if ($target == 'store')
            <button type="submit" class="btn btn-block btn-success">追加</button>
            @elseif ($target == 'update')
            <button type="submit" class="btn btn-block btn-primary">編集</button>
            @endif
        </div>
    </div>
</form>