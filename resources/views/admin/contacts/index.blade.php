@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">お問い合わせ管理</h1>
@stop

@php
$type_ttl = [
	'その他', 'リクエストリサーチ', '制作依頼'
];

$status_ttl = [
	'未確認', '確認済', '完了済'
];
@endphp

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">お問い合わせ一覧</h3>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <table id="table-contact-list" class="table table-bordered">
            <thead>
                <tr>
					<th>日付</th>
                    <th>メールアドレス</th>
                    <th>種類</th>
					<th>状態</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
					<td>{{ $contact->created_at }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $type_ttl[$contact->type] }}</td>
					<td>{{ $status_ttl[$contact->status] }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.contacts.edit', $contact->id) }}">
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