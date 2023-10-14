@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">サービスの一括インポート</h1>
@stop

@section('content')
    @include('admin.services.import.detail')
@stop
