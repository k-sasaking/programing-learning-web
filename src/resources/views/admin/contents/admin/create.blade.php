@extends('admin.layouts.base')

@section('title', '管理者作成 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">アドミン管理</a></li>
    <li class="breadcrumb-item active" aria-current="page">新規管理者作成</li>
  </ol>
</nav>
@endsection

@section('content')
        <form action="{{ route('admin.admin.store') }}" method="POST">
        @csrf     
            <div class="form-group row">
                <?php $field = 'admin_name' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">ユーザー名</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="名前" name="{{ $field }}" 
                    value="{{ old($field) }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'email' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">メールアドレス</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="xxx@xxx.com" name="{{ $field }}" 
                    value="{{ old($field) }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'login_id' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">ログインID</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="ログインID" name="{{ $field }}" 
                    value="{{ old($field) }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'password' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">パスワード</label>
                <div class="col-sm-10">
                    <input type="password" id="{{$field}}" class="form-control" placeholder="*****" name="{{ $field }}" 
                    value="" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <?php $field = 'password_confirmation' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">パスワード確認</label>
                <div class="col-sm-10">
                    <input type="password" id="{{$field}}" class="form-control" placeholder="*****" name="{{ $field }}" 
                    value="" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>

            <div class="search_button">
                <button type="submit" class="btn btn-primary">作成</button>
            </div>
        </form>

@endsection
