@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">ユーザー管理</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">ユーザー一覧</h3>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <table id="table-user-list" class="table table-bordered">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="d-flex">
                        <a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form id="form-delete-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger mx-1 btn-delete" data-target="{{ $user->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@stop

@section('adminlte_js')
<script type="text/javascript">
$(function() {
    $('.btn-delete').on('click', function() {
        if (confirm('本当に削除しますか？')){
            $target = $(this).data('target');
            $('#form-delete-' + $target).submit();
            return true;
        }
    });
});
</script>
@stop