@extends('admin.layouts.base')

@section('title', '管理者作成 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.admin.lesson.index') }}">レッスン管理</a></li>
    <li class="breadcrumb-item active" aria-current="page">レッスン詳細</li>
  </ol>
</nav>
@endsection

@section('content')
@csrf
<div class="search card">
    <div class="card-header">レッスン詳細</div>
    <div class="card-body">
        <div class="form-group row">
            <?php $field = 'name' ?>
            <label for="{{$field}}" class="col-sm-2">講座名</label>
            <div class="col-sm-10">
                {{ $lesson[$field] }}
            </div>
        </div>  
        <div class="form-group row">
            <?php $field = 'description' ?>
            <label for="{{$field}}" class="col-sm-2">説明</label>
            <div class="col-sm-10">
                {{ $lesson[$field] }}
            </div>
        </div>  
        <div class="form-group row">
            <?php $field = 'thumbnail_path' ?>
            <label for="{{$field}}" class="col-sm-2">サムネイ</label>
            <div class="col-sm-10 d-flex align-items-end">
                <img src="{{ $lesson[$field] }}" height="300px" class="mr-3">
            </div>
        </div>  
        <div class="form-group row">
            <?php $field = 'category_id' ?>
            <label for="{{$field}}" class="col-sm-2">カテゴリー</label>
            <div class="col-sm-10">
                @foreach($categorys as $category)
                    @if($lesson->category_id == $category->id)
                        {{$category->name}}
                    @endif
                @endforeach
            </div>
        </div>  
        <div class="search_button">
            <a href="javascript:history.back();">
                <button type="button" class="btn btn-secondary">戻る</button>
            </a>
            <a href="{{ route('admin.admin.lesson.edit', [ 'id' => $lesson->id ]) }}">
                <button type="button" class="btn btn-primary">編集</button>
            </a>
        </div>
    </div>
</div>
<table class="table table-stripe">
    <thead>
        <tr>
            <th>No</th>
            <th>セクション名</th>
            <th>作成日</th>
            <th>更新日</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody id="sort_table">
        @foreach($sections as $section)
        <tr>
            <td class="no" data-section-id="{{ $section->id }}">{{ $section->sort  }}</td>
            <td>{{ $section->name }}</td>
            <td>{{ $section->created_at }}</td>
            <td>{{ $section->updated_at }}</td>
            <td>
               <a href="{{ route('admin.admin.lesson.edit', [ 'id' => $lesson->id ]) }}">
                    <button type="button" class="btn btn-primary">編集</button>
                </a>
               <a href="{{ route('admin.admin.lesson.edit', [ 'id' => $lesson->id ]) }}">
                    <button type="button" class="btn btn-danger">削除</button>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tbody>
        <tr>
            <td>{{ count($sections) + 1 }}</td>
            <td>
                <?php $field = 'new_section' ?>
                <input type="text" id="{{$field}}" class="form-control" placeholder="セクション名" name="{{ $field }}" 
                value="" >
                @if($errors->has($field))
                    <span class="help-block">{{ $errors->first($field) }}</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.admin.lesson.edit', [ 'id' => $lesson->id ]) }}">
                    <button type="button" class="btn btn-success">セクションを追加</button>
                </a>
            </td>
        </tr>
    </tbody>
</table>
@endsection

@push('scripts')
<!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
<script>
    let config = {
        "csrf_token" : "{{ csrf_token() }}",
        "url" : {    
            "sort" : "{{ route('admin.admin.lesson.section.sort', [ 'id' => $lesson->id, ]) }}",
        },
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="{{ asset('admin/js/section.js') }}"></script>
<script>
let sort_table = document.getElementById('sort_table');
let sortable = Sortable.create(sort_table, {
    group: "sort_table",
    animation: 100,
    onUpdate: function (evt) {
        $('#sort_table tr').each(function(index, element){
            $(element).find('.no').text(index+1)
        })
        Section.sort().send();
    },
});
</script>
@endpush
