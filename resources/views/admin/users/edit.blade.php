@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">ユーザー情報の変更</h1>
@stop

@section('content')
    @include('admin.users.form', [ 'target' => 'update' ])
@stop
