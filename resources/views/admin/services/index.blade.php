@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">サービス管理</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">サービス一覧 ({{ $services->count() }}件)</h3>
        <div class="card-tools">
            <a class="btn btn-block btn-success" href="{{ route('admin.services.create') }}">新規追加</a>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        <table id="table-service-list" class="table table-bordered">
            <thead style="color: #ffffff; background-color: #343a40;">
                <tr>
                    <th width="80px">非公開</th>
                    <th width="80px">No.</th>
                    <th>タイトル</th>
                    <th width="160px">ジャンル</th>
                    <th width="160px">国</th>
                    <th width="60px">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                @if ($service->published)
                <tr>
                @else
                <tr style="background-color: #f5f5f5;">
                @endif
                    <td>
                        <input type="checkbox" data-target="{{ $service->id }}" @if (!$service->published) checked @endif>
                    </td>
                    <td>{{ $service->id }}</td>
                    <td>
                        <div class="service-title">
                            <div class="service-title-fig">
                                <?php
                                $bg_style = !empty($service->getFirstMediaUrl('images')) ? "background: url('" . $service->getFirstMediaUrl('images') . "') no-repeat;" : '';
                                ?>
                                <div class="service-title-fig-content" data-figure-index="{{ $service->id }}"
                                    style="{{ $bg_style }}">
                                </div>
                            </div>
                            <p class="service-title-txt">
                                @if (!empty($service->url))
                                <a href="{{ $service->url }}" target="_blank">{{ $service->title }}</a>
                                @else
                                {{ $service->title }}
                                @endif
                            </p>
                        </div>
                    </td>
                    <td>
                        @if (!empty($service->category) && $service->category_id != 0)
                        {{ $service->category->title }}
                        @endif
                    </td>
                    <td>
                        @if (!empty($service->region) && $service->region_id != 0)
                        {{ $service->region->name }}
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.services.edit', $service->id) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success btn-publish-batch" data-published="0" style="padding: .375rem 5.0rem;">
            更新する
        </button>
        <form id="form-publish-batch" action="{{ route('admin.services.publish') }}" method="post">
            @csrf
        </form>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script>
$(function() {
    $('.btn-import-image').on('click', function() {
        var _target = $(this).data('target');
        $('#form-image-' + _target).submit();
        return false;
    });

    $('.chk-select-all').on('change', function() {
        var _checked = $(this).is(":checked");
        $('#table-service-list tbody input[type=checkbox]').each(function(index) {
            $(this).prop('checked', _checked);
        });

        $('#chk-select-all-thead').prop('checked', _checked);
        $('#chk-select-all-tfoot').prop('checked', _checked);
    });

    $('.btn-publish-batch').on('click', function() {

        $('#table-service-list tbody input[type=checkbox]').each(function(index) {
            $('#form-publish-batch').append('<input type="hidden" name="publish_id[' + index + ']" value="' + $(this).data('target') + '" >');

            if ($(this).is(":checked")) {
                $('#form-publish-batch').append('<input type="hidden" name="status[' + index + ']" value="0" >');
            } else {
                $('#form-publish-batch').append('<input type="hidden" name="status[' + index + ']" value="1" >');
            }
        });

        $('#form-publish-batch').submit();

        return false;
    });
});

@error ('image_service_none')
toastr.error('{{ $message }}')
@enderror
@error ('image_service_url_none')
toastr.error('{{ $message }}')
@enderror
@error ('image_service_url_format')
toastr.error('{{ $message }}')
@enderror
@error ('image_service_img_none')
toastr.error('{{ $message }}')
@enderror
@error ('image_service_success')
toastr.success('{{ $message }}')
@enderror
</script>
@endsection