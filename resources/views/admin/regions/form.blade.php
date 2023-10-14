@section('css')
<style>
.img-preview img {
    display: block;
    max-width: 100%;
}
</style>
@stop

@if ($target == 'store')
<form id="form-main" action="{{ route('admin.regions.store') }}" method="post" enctype="multipart/form-data">
@elseif ($target == 'update')
<form id="form-main" action="{{ route('admin.regions.update', $region->id) }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
@endif
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">地域情報</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">地域名<sup>*</sup></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if(empty($region->name)){{ old('name') }}@else{{ $region->name }}@endif" required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">コード<sup>*</sup></label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="@if(empty($region->code)){{ old('code') }}@else{{ $region->code }}@endif" required />
                        @error('code')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            @if ($target == 'store')
            <button type="submit" class="btn btn-block btn-success">追加</button>
            @elseif ($target == 'update')
            <button type="submit" class="btn btn-block btn-primary">更新</button>
            @endif
        </div>
    </div>
</form>

@section('adminlte_js')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
$( document ).ready(function() {
    bsCustomFileInput.init();

    $('#btn-delete-image').on('click', function() {
        $('#form-image-delete').submit();
        return false;
    });
});
</script>
@stop