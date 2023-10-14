@php
$type_ttl = [ '', '翻訳申請', '申請代行相談' ];
@endphp

@section('css')
@stop

<div class="card">
    <div class="card-header">
        <h3 class="card-title">申請情報（{{ $type_ttl[$order->type] }}）</h3>
        <div class="card-tools">
            <a class="btn btn-primary btn-toggle">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <div class="row">
            <div class="col col-8">
                <label>サビース名</label>
                <div class="row">
                    <div class="col col-11">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $order->service->title }}" disabled />
                        </div>
                    </div>

                    <div class="col col-1">
                        <a class="btn btn-primary" href="{{ route('admin.services.edit', $order->service->id) }}" target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col col-4">
                <label>ユーザー名</label>
                <div class="row">
                    <div class="col col-11">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $order->user->name }}" disabled />
                        </div>
                    </div>

                    <div class="col col-1">
                        <a class="btn btn-primary" href="{{ route('admin.users.edit', $order->user->id) }}" target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<form action="{{ route('admin.orders.message', $order->id) }}" method="post">
    @csrf
    <input type="hidden" name="order" value="{{ $order->id }}" >
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">メッセージ</h3>
            <div class="card-tools">
                <a class="btn btn-primary btn-toggle">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-8">
                    <div class="table-msg-wrapper">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="80px">種類</th>
                                    <th>内容</th>
                                    <th width="180px">日付</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $msg)
                                <?php
                                $tr_style = ($msg->send_id == 0) ? 'background: #f2f2f2' : '';
                                ?>
                                <tr style="{{ $tr_style }}">
                                    <td>{{ ($msg->send_id == 0) ? '送信' : '受信'; }}</td>
                                    <td>{!! nl2br($msg->content) !!}</td>
                                    <td>{{ $msg->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col col-4">
                    <div class="form-group">
                        <select id="select-status" class="form-control" name="status">
                            <option value="0">変更状態の選択</option>
                            <option value="1">確認する</option>
                            <option value="-1">拒否する</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">メッセージ</label>
                        <textarea id="text-message" class="form-control" style="resize: none;" rows="3" name="message" required></textarea>
                    </div>

                    <button id="btn-change-status" type="submit" class="btn btn-block btn-primary">メッセージ送信</button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</form>

@section('adminlte_js')
<script>
$(document).ready(function() {
    $('.btn-toggle').on('click', function() {
        $(this).toggleClass('closed');

        if ($(this).hasClass('closed')) {
            $(this).parent().parent().parent().find('.card-body').slideUp(300);
        } else {
            $(this).parent().parent().parent().find('.card-body').slideDown(300);
        }

        return false;
    });

    $('#select-status').on('change', function() {
        $('#text-message').prop('required', false);

        if ($(this).val() == 1) {
            $('#text-message').val("注文は確認しました。\nこれから注文の詳細内容についてご相談いたします。");
        } else if ($(this).val() == -1) {
            $('#text-message').val("本当に申し訳ございません。\nこれから注文の詳細内容についてご相談いたします。");
        } else {
            $('#text-message').prop('required', true);
        }

        return false;
    });
});
</script>
@stop