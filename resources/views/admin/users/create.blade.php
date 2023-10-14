@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">ユーザー情報の追加</h1>
@stop

@section('content')
    @include('admin.users.form', [ 'target' => 'store' ])
@stop
