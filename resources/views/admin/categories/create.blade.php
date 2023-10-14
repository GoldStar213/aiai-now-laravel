@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">ジャンル情報の追加</h1>
@stop

@section('content')
    @include('admin.categories.form', [ 'target' => 'store' ])
@stop
