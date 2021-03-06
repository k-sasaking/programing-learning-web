@extends('admin.layouts.base')

@section('title', '管理者管理 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">アドミン管理</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="search card">
    <div class="card-header">検索条件</div>
    <div class="card-body">
        <form action="{{ route('admin.admin.index') }}" method="GET">
            <div class="form-group row">
                <?php $field = 'search_name' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">ユーザー名</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="名前" name="{{ $field }}" 
                    value="{{ old($field, request()->get($field)) }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'search_email' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">メールアドレス</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="test@gmail.com" name="{{ $field }}" 
                    value="{{ old($field, request()->get($field)) }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>
            <div class="search_button">
                <button type="reset" class="btn btn-secondary">クリア</button>
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </form>
    </div>
</div>
<table class="table table-stripe">
    <thead>
        <tr>
            <th>No</th>
            <th>ユーザー名</th>
            <th>メールアドレス</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $admin)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $admin->admin_name }}</td>
            <td>{{ $admin->email }}</td>
            <td>
                <a href="{{ route('admin.admin.edit', ['id' => $admin->id])  }}" class="btn btn-info" role="button">詳細</a>
                @if($admin->id != Auth::user()->id)
                <form action="{{ route('admin.admin.destroy', ['id' => $admin->id ]) }}" name="destroy" method="POST" class="btn-destroy">
                    @csrf 
                    <a href="javascript:void(0);" class="btn btn-danger btn-stop" role="button">削除</a>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $admins->onEachSide(5)->links('admin.components.pagination') }}
@endsection

@push('scripts')
<script>
    $('.btn-stop').on('click',function(){
        if(confirm('このアカウントを削除しますか？')){
            $(this).parent().submit();
        }
    })
</script>
@endpush
