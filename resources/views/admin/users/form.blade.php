@if ($target == 'store')
<form action="{{ route('admin.users.store') }}" method="post">
@elseif ($target == 'update')
<form action="{{ route('admin.users.update', $user->id) }}" method="post">
    <input type="hidden" name="_method" value="put">
@endif
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ユーザー情報</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">名前<sup>*</sup></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if(empty($user->name)){{ old('name') }}@else{{ $user->name }}@endif" required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="name">メールアドレス<sup>*</sup></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(empty($user->email)){{ old('email') }}@else{{ $user->email }}@endif" required />
                        @error('email')
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
            <button type="submit" class="btn btn-block btn-primary">編集</button>
            @endif
        </div>
    </div>
</form>