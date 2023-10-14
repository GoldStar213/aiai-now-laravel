@section('css')
<style>
.img-preview img {
    display: block;
    max-width: 100%;
}
</style>
@stop

@if ($target == 'store')
<form id="form-main" action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
@elseif ($target == 'update')
<form id="form-main" action="{{ route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
@endif
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ジャンル情報</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">タイトル<sup>*</sup></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="@if(empty($category->title)){{ old('title') }}@else{{ $category->title }}@endif" required />
                        @error('title')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">スラッグ<sup>*</sup></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="@if(empty($category->slug)){{ old('slug') }}@else{{ $category->slug }}@endif" required />
                        @error('slug')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-9">
                    <div class="form-group">
                        <label>添付ファイル</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="custom-file-input" name="image">
                                <label class="custom-file-label" for="custom-file-input">
                                    @if (empty($file_name)) ファイルの選択 @else {{ $file_name }} @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                @if (!empty($category->getFirstMediaUrl('images')))
                <div class="col col-3">
                    <div class="form-group">
                        <div class="img-preview">
                            <img src="{{ $category->getFirstMediaUrl('images') }}" />
                        </div>
                        <button id="btn-delete-image" type="button" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endif
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

<form id="form-image-delete" action="{{ route('admin.categories.image.delete') }}" method="POST">
    @csrf
    <input type="hidden" name="target" value="{{ $category->id }}">
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