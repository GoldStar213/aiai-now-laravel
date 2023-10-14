@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">ジャンル管理</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">ジャンル一覧</h3>
        <div class="card-tools">
            <a class="btn btn-block btn-success" href="{{ route('admin.regions.create') }}">新規追加</a>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <table id="table-user-list" class="table table-bordered">
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>コード</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($regions as $cat)
                <tr>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->code }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.regions.edit', $cat->id) }}">
                            <i class="fas fa-edit"></i>
                        </a>
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