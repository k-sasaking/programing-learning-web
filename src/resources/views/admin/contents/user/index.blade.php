@extends('admin.layouts.base')

@section('title', 'ユーザー管理 | 管理画面')

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
        <form action="{{ route('admin.user.index') }}" method="GET">
        <div class="form-group row">
                <?php $field = 'search_account_type' ?>
                {{ request()->get('search_account_type[]') }}
                <label for="{{$field}}" class="col-sm-2 col-form-label">ステータス</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="{{$field}}_1" name="{{$field}}[]" value="1"
                        @if(request()->has($field) && in_array('1',request()->input($field))) checked @endif>
                        <label class="form-check-label checkbox_label" for="{{$field}}_1">無料</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="{{$field}}_2" name="{{$field}}[]" value="2"
                        @if(request()->has($field) && in_array('2',request()->input($field))) checked @endif>
                        <label class="form-check-label checkbox_label" for="{{$field}}_2">有料</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="{{$field}}_3" name="{{$field}}[]" value="3"
                        @if(request()->has($field) && in_array('3',request()->input($field))) checked @endif>
                        <label class="form-check-label checkbox_label" for="{{$field}}_3">退会済</label>
                    </div>
                    <div class="col-sm-10">
                        @if($errors->has($field))
                            <span class="help-block">{{ $errors->first($field) }}</span>
                        @endif
                    </div>
                </div>
            </div>
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
                <?php $field = 'search_mail' ?>
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
<div class="head_menu">
    <form action="{{ route('admin.admin.user.csvdownload') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success" role="button">csvダウンロード</a>
    </form>
</div>
<table class="table table-stripe">
    <thead>
        <tr>
            <th>No</th>
            <th>ユーザー名</th>
            <th>メールアドレス</th>
            <th>アカウントタイプ</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr @if($user->account_type == 3)  class="table-active"  @endif>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ config('const.account_type.'.$user->account_type)}}</td>
            <td>
                <a href="{{ route('admin.user.edit', ['id' => $user->id])  }}" class="btn btn-info" role="button">詳細</a>
                <a href="javascript:void(0);" class="btn btn-danger btn-stop" role="button">停止</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->onEachSide(5)->links('admin.components.pagination') }}
@endsection

@push('scripts')
<script>
    $('.btn-stop').on('click',function(){
        if(confirm('このアカウントを停止しますか？')){

        }
    })
</script>
@endpush
