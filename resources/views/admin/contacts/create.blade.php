@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">お問い合わせ情報の追加</h1>
@stop

@section('content')
    @include('admin.contacts.form', [ 'target' => 'store' ])
@stop
