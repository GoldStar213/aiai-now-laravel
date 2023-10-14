@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">申請管理</h1>
@stop

@php
$status_ttl = [ '新着', '確認', '完了', '拒否' ];
$type_ttl = [ '', '翻訳相談', '申請代行相談' ];
@endphp

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">申請一覧</h3>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <table id="table-user-list" class="table table-bordered">
            <thead>
                <tr>
                    <th>種類</th>
                    <th>サービス名</th>
                    <th>ユーザー</th>
                    <th>状態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $type_ttl[$order->type] }}</td>
                    <td>{{ $order->service->title }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $status_ttl[$order->status] }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.orders.edit', $order->id) }}">
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