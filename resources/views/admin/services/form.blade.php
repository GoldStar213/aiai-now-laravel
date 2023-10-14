@section('css')
<style>
.img-preview {
    border: 1px solid #b8b8b8;
}

.img-preview img {
    display: block;
    max-width: 100%;
}
</style>
@stop

@if ($target == 'store')
<form action="{{ route('admin.services.store') }}" method="post" enctype="multipart/form-data">
@elseif ($target == 'update')
<form action="{{ route('admin.services.update', $service->id) }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
@endif
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">サービス情報</h3>
            <div class="card-tools">
                <a class="btn btn-primary btn-toggle">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">タイトル<sup>*</sup></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="@if(empty($service->title)){{ old('title') }}@else{{ $service->title }}@endif" required />
                        @error('title')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-6">
                    <div class="form-group">
                        <label for="name">URL<sup>*</sup></label>
                        <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="@if(empty($service->url)){{ old('url') }}@else{{ $service->url }}@endif" required />
                        @error('url')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col col-6">
                    <div class="form-group">
                        <label for="name">Youtube</label>
                        <input type="text" class="form-control @error('youtube_url') is-invalid @enderror" name="youtube_url" value="@if(empty($service->youtube_url)){{ old('youtube_url') }}@else{{ $service->youtube_url }}@endif" required />
                        @error('youtube_url')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-5">
                    <div class="form-group">
                        <label for="name">ジャンル</label>
                        <select class="form-control" name="category">
                            <option value="0">ジャンルを選択してください</option>
                            @forelse ($categories as $cat)
                            @if ($cat->id == $service->category_id)
                            <option value="{{ $cat->id }}" selected>{{ $cat->title }}</option>
                            @else
                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endif
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="col col-5">
                    <div class="form-group">
                        <label for="name">国</label>
                        <select class="form-control" name="region">
                            <option value="0">国を選択してください</option>
                            @forelse ($regions as $reg)
                            @if ($reg->id == $service->region_id)
                            <option value="{{ $reg->id }}" selected>{{ $reg->name }}</option>
                            @else
                            <option value="{{ $reg->id }}">{{ $reg->name }}</option>
                            @endif
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="col col-2">
                    <div class="form-group">
                        <label for="name">状態</label>
                        <select class="form-control" name="published">
                            @if ($service->published)
                            <option value="0">非公開</option>
                            <option value="1" selected>公開</option>
                            @else
                            <option value="0" selected>非公開</option>
                            <option value="1">公開</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">内容</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5" style="resize: none;">@if (empty($service->content)){{ old('content') }}@else{{ $service->content }}@endif</textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-6">
                    <div class="form-group">
                        <label for="name">料金</label>
                        <textarea class="form-control @error('price') is-invalid @enderror" name="price" rows="3" style="resize: none;">@if (empty($service->price)){{ old('price') }}@else{{ $service->price }}@endif</textarea>
                        @error('price')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col col-6">
                    <div class="form-group">
                        <label for="name">種類</label>
                        <textarea class="form-control @error('type') is-invalid @enderror" name="type" rows="3" style="resize: none;">@if (empty($service->type)){{ old('type') }}@else{{ $service->type }}@endif</textarea>
                        @error('type')
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

                <div class="col col-3">
                    <div class="form-group">
                        <div class="img-preview">
                            <img src="{{ $service->getFirstMediaUrl('images') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer d-flex justify-content-center">
            @if ($target == 'store')
            <button type="submit" class="btn btn-success" style="padding: .375rem 5.0rem;">追加</button>
            @elseif ($target == 'update')
            <button type="submit" class="btn btn-primary" style="padding: .375rem 5.0rem;">更新</button>
            @endif
        </div>
    </div>
    <!-- /.card -->
</form>

@if ($target == 'update')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">コメント({{ $service->comments->count() }}件/平均：{{ number_format($service->rating / 200, 2, '.', ',') }}点)</h3>
        <div class="card-tools">
            <a class="btn btn-primary btn-toggle">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        @foreach ($comments as $comment)
        <form id="form-comment-process-{{ $comment->id }}" action="{{ route('admin.comments.process') }}" method="post">
            @csrf
            <input type="hidden" name="service" value="{{ $service->id }}" >
            <input type="hidden" name="target" value="{{ $comment->id }}" >
            <input type="hidden" name="type" value="" >
            <div class="row">
                <div class="col col-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" value="{{ $comment->title }}" placeholder="コメントのタイトルを入力してください（必須）" required />                    
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" style="resize: none;" rows="3" name="content" placeholder="コメントの内容を入力してください（必須）" required>{{ $comment->content }}</textarea>
                    </div>
                </div>
                <div class="col col-2">
                    <div class="form-group">
                        <input type="number" class="form-control" name="rating" value="{{ $comment->rating }}" placeholder="点数（必須）" min="0" max="5" oninput="javascript:if(this.value > 5) this.value = 5; if(this.value < 0) this.value = 0; this.value = parseInt(this.value);" required />
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-comment-process-update" data-target="{{ $comment->id }}">更新</button>
                    <button type="submit" class="btn btn-block btn-danger btn-comment-process-delete" data-target="{{ $comment->id }}">削除</button>
                </div>
            </div>
        </form>
        @endforeach

        <form action="{{ route('admin.comments.create') }}" method="post">
            @csrf
            <input type="hidden" name="service" value="{{ $service->id }}" >
            <div class="row">
                <div class="col col-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" value="" placeholder="コメントのタイトルを入力してください（必須）" required />                    
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" style="resize: none;" rows="3" name="content" placeholder="コメントの内容を入力してください（必須）" required></textarea>
                    </div>
                </div>
                <div class="col col-2">
                    <div class="form-group">
                        <input type="number" class="form-control" name="rating" value="" placeholder="点数（必須）" min="0" max="5" oninput="javascript:if(this.value > 5) this.value = 5; if(this.value < 0) this.value = 0; this.value = parseInt(this.value);" required />                    
                    </div>
                    <button type="submit" class="btn btn-block btn-success">追加</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
<div>
@endif
<!-- /.card -->

@section('adminlte_js')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
$(document).ready(function() {
    bsCustomFileInput.init();

    $('.btn-toggle').on('click', function() {
        $(this).toggleClass('closed');

        if ($(this).hasClass('closed')) {
            $(this).parent().parent().parent().find('.card-body').slideUp(300);
        } else {
            $(this).parent().parent().parent().find('.card-body').slideDown(300);
        }

        return false;
    });

    $('.btn-comment-process-update').on('click', function() {
        var _target = $(this).data('target');
        $('#form-comment-process-' + _target + ' input[name="type"]').val('update');

        $('#form-comment-process-' + _target).submit();

        return false;
    });

    $('.btn-comment-process-delete').on('click', function() {
        var _target = $(this).data('target');
        $('#form-comment-process-' + _target + ' input[name="type"]').val('delete');

        $('#form-comment-process-' + _target).submit();

        return false;
    });
});
</script>
@stop