@extends('admin.layouts.base')

@section('title', 'カテゴリー詳細 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">カテゴリー管理</a></li>
    <li class="breadcrumb-item active" aria-current="page">カテゴリー詳細</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="head_menu">
    <a href="#" class="btn btn-success" role="button" aria-pressed="true">レッスン追加</a>
</div>
<table class="table table-stripe">
    <thead>
        <tr>
            <th>No</th>
            <th>ユーザー名</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody id="sort_table">
        @foreach($category->lessons as $lesson)
        <tr data-id={{ $loop->index + 1 }}>
            <td class="no">{{ $loop->index + 1 }}</td>
            <td>{{ $lesson->name }}（{{ count($lesson->sections) }}）</td>
            <td>
                <a href="#{{-- route('admin.lesson.detail', ['id' => $lesson->id]) --}}" class="btn btn-info" role="button">詳細</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="foot_menu">
    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary" role="button">戻る</a>
    <a href="#" class="btn btn-primary" role="button">順番を更新</a>
</div>
@endsection

@push('scripts')
<!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
let sort_table = document.getElementById('sort_table')
let sortable = Sortable.create(sort_table, {
    group: "sort_table",
    animation: 100,
    onUpdate: function (evt) {
        $('#sort_table tr').each(function(index, element){
            $(element).find('.no').text(index+1)
        })
    },
});
</script>
@endpush