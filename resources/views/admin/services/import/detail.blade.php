@section('css')
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@stop

<form action="{{ route('admin.services.import.excel') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">エクセルのインポート</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label>ファイル選択</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="custom-excel-input" name="excel">
                                <label class="custom-file-label" for="custom-excel-input">
                                    @if (empty($file_name)) エクセルファイルを選択してください @else {{ $file_name }} @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-block btn-primary">インポート</button>
        </div>
    </div>
</form>

<form action="{{ route('admin.services.image.batch') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">画像のインポート</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-12">
                    <p>画像が設定されないサービス数：({{ $none_img_service_count }})</p>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="form-check-image-import-upgrade" name="is_upgrade">
                            <label class="form-check-label" for="form-check-image-import-upgrade">既存画像を更新する</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="form-check-skip-download" name="skip_download">
                            <label class="form-check-label" for="form-check-skip-download">ダウンロードをスキップ</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-block btn-primary">インポート</button>
        </div>
    </div>
</form>

@section('adminlte_js')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script>
$( document ).ready(function() {
    bsCustomFileInput.init();
});

@error('import_excel_none')
toastr.error('{{ $message }}')
@enderror
</script>
@stop