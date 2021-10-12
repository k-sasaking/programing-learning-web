@extends('admin.layouts.base')

@section('title', '管理者作成 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.lesson.index') }}">レッスン管理</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.lesson.detail', [ $lecture->section->lesson_id]) }}">レッスン詳細</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.section.detail', [ $lecture->section_id ]) }}">セクション詳細</a></li>
    <li class="breadcrumb-item active" aria-current="page">セクション編集</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <div class="search card">
            <div class="card-header">マークダウン</div>
            <div class="card-body">
                <div class="form-group">
                    <form class="btn-destroy" action="{{ route('admin.lecture.update', [ 'id' => $lecture->id ] )}}" method="POST">
                        @csrf
                        <?php $field = 'title' ?>
                        <label for="{{$field}}">レクチャー名</label><br>
                        <input type='text' class="form-control" name="{{$field}}" value="{{ $lecture[$field] }}">
                        <button type="submit" class="form-control btn btn-success btn-sm mb-1" role="button">更新</button>
                        <?php $field = 'text' ?>
                        <textarea name="{{$field}}" id="mark_textarea" class="form-control mb-1" rows="50">{{ $lecture->text }}</textarea>
                        <a><button type="submit" class="form-control btn mb-1 btn-success" role="button">更新</button></a>
                        <a href="javascript:history.back();">
                            <button type="button" class="form-control btn btn-secondary">戻る</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm">
        <div class="search card">
            <div class="card-header">プレビュー</div>
                <div class="card-body" id='marked_content'>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    let textarea = document.getElementById('mark_textarea');
    document.getElementById('marked_content').innerHTML = marked(textarea.value);

    textarea.addEventListener('input', (e) => {
        document.getElementById('marked_content').innerHTML = marked(textarea.value);
    }); 

    textarea.addEventListener('keyup', (e) => {
        document.getElementById('marked_content').innerHTML = marked(textarea.value);
    }); 
</script>
@endpush
