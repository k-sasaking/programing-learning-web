@extends('admin.layouts.base')

@section('title', 'ユーザー管理 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">レッスン管理</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="search card">
    <div class="card-header">検索条件</div>
    <div class="card-body">
        <form action="{{ route('admin.admin.lesson.index') }}" method="GET">
            <div class="form-group row">
                <?php $field = 'search_name' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">講座名</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="講座名" name="{{ $field }}" 
                    value="{{ old($field, request()->get($field)) }}" >
                    @if($errors->has($field))
                        <span class="help-block">{{ $errors->first($field) }}</span>
                    @endif
                </div>
            </div>  
            <div class="form-group row">
                <?php $field = 'search_mail' ?>
                <label for="{{$field}}" class="col-sm-2 col-form-label">カテゴリー名</label>
                <div class="col-sm-10">
                    <input type="text" id="{{$field}}" class="form-control" placeholder="javascript" name="{{ $field }}" 
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
            <th>講座名</th>
            <th>説明</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lessons as $lesson)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $lesson->name }}</td>
            <td>{{ $lesson->description }}</td>
            <td>
                <a href="{{ route('admin.admin.lesson.edit', ['id' => $lesson->id ]) }}" class="btn btn-primary" role="button">編集</a>
                <a href="{{ route('admin.admin.lesson.detail', ['id' => $lesson->id ]) }}" class="btn btn-info" role="button">詳細</a>
                <form action="{{ route('admin.admin.lesson.destroy', ['id' => $lesson->id ]) }}" name="destroy" method="POST" class="btn-destroy">
                    @csrf 
                    <a href="javascript:void(0);" class="btn btn-danger btn-stop" role="button">削除</a>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $lessons->onEachSide(5)->links('admin.components.pagination') }}
@endsection

@push('scripts')
<script>
    $('.btn-stop').on('click',function(){
        if(confirm('この講座を削除しますか？')){
            $(this).parent().submit();
        }
    })
</script>
@endpush
