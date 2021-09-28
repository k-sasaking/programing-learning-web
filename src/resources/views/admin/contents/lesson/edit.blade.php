@extends('admin.layouts.base')

@section('title', '管理者作成 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.lesson.index') }}">レッスン管理</a></li>
    <li class="breadcrumb-item active" aria-current="page">レッスン編集</li>
  </ol>
</nav>
@endsection

@section('content')
        <form action="{{ route('admin.lesson.update', ['id' => $lesson->id ]) }}" method="POST">
        @csrf
            <div class="form-group row">
                <?php $field = 'name' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">講座名</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="講座名" name="{{ $field }}" 
                    value="{{ $lesson[$field] }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'description' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">説明</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="説明" name="{{ $field }}" 
                    value="{{ $lesson[$field] }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'thumbnail_path' ?>
                <input type="hidden" name="{{ $field }}" value="{{ $lesson[$field] }}">
                <label for="{{$field}}" class="col-sm-2 col-form-label">サムネイ</label>
                <div class="col-sm-10 d-flex align-items-end">
                    <img src="{{ $lesson[$field] }}" height="300px" class="mr-3">
                    <a href="{{ route('admin.lesson.img.edit', [ 'id' => $lesson->id ]) }}">
                        <button type="button" class="btn btn-secondary">アップロード</button>
                    </a>
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'category_id' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">カテゴリー</label>
                <div class="col-sm-10">
                <select  name={{$field}}>
                    @foreach($categorys as $category)
                        @if($lesson->category_id == $category->id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                             <option value="{{$category->id}}" >{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="search_button">
                <a href="javascript:history.back();">
                    <button type="button" class="btn btn-secondary">戻る</button>
                </a>
                <button type="submit" class="btn btn-primary">編集</button>
            </div>
        </form>
@endsection
