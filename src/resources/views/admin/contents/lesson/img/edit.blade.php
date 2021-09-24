@extends('admin.layouts.base')

@section('title', '管理者作成 | 管理画面')

@section('content')
            <div class="form-group row">
                <?php $field = 'file' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">画像ファイル</label>
                <div class="col-sm-10">
                    <form action="{{ route('admin.admin.lesson.img.update', [ 'id' => $id ])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="{{$field}}"  name="{{ $field }}" 
                    value="" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                    <div class="search_button">
                        <button type="submit" class="btn btn-primary">アップロード</button>
                    </div>
                    </form>
                </div>
            </div>  
@endsection
