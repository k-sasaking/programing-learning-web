@extends('admin.layouts.base')

@section('title', '管理者作成 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.lesson.index') }}">レッスン管理</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.lesson.detail', [ $section->lesson_id ]) }}">レッスン詳細</a></li>
    <li class="breadcrumb-item active" aria-current="page">セクション詳細</li>
  </ol>
</nav>
@endsection

@section('content')
@csrf
<div class="search card">
    <div class="card-header">セクション詳細</div>
    <div class="card-body">
        <div class="form-group row">
            <?php $field = 'name' ?>
            <label for="{{$field}}" class="col-sm-2">セクション名</label>
            <div class="col-sm-10">
                {{ $section[$field] }}
            </div>
        </div>  
        <div class="search_button">
            <a href="javascript:history.back();">
                <button type="button" class="btn btn-secondary">戻る</button>
            </a>
        </div>
    </div>
</div>
<table class="table table-stripe">
    <thead>
        <tr>
            <th>No</th>
            <th>レクチャー名</th>
            <th>作成日</th>
            <th>更新日</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody id="sort_table">
        @foreach($section->lectures->sortBy('sort') as $lecture)
        <tr>
            <td class="no" data-section-id="{{ $lecture->id }}">{{ $lecture->sort  }}</td>
            <td class="lec{{ $lecture->sort }} block">
                <span id="span">{{ $lecture->title }}</span>
            </td>
            <td>{{ $lecture->created_at }}</td>
            <td>{{ $lecture->updated_at }}</td>
            <td>
            <a href="{{ route('admin.lecture.edit', ['id' => $lecture->id ]) }}" class="btn btn-primary" role="button">編集</a>
            <form class="btn-destroy" action="{{ route('admin.lecture.destroy', [ 'id' => $lecture->id ] )}}" method="POST">
                    @csrf
                    <?php $field = 'id' ?>
                    <a href="javascript:void(0);" class="btn btn-danger btn-stop" role="button">削除</a>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tbody>
        <form action="{{ route('admin.lecture.store', [ 'id' => $section->id ]) }}" method="POST">
        <tr>
            <td>{{ count($section->lectures) + 1 }}</td>
            <td>
                @csrf
                <?php $field = 'title' ?>
                <input type="text" id="{{$field}}" class="form-control" placeholder="レクチャー名" name="{{ $field }}" 
                value="" >
                <?php $field = 'sort' ?>
                <input type="hidden" name="{{$field}}" value="{{ count($section->lectures) + 1 }}">
                    <?php $field = 'section_id' ?>
                <input type="hidden" name="{{$field}}" value="{{ $section->id }}">
                @if($errors->has($field))
                    <span class="help-block">{{ $errors->first($field) }}</span>
                @endif
            </td>
            <td>
                <button type="submit" class="btn btn-success" role="button">レクチャーを追加</button>
            </td>
        </tr>
        </form>
    </tbody>
</table>
@endsection

@push('scripts')
<!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
<script>
    $('.btn-switch').on('click',function(){
        let className = $(this).attr('id').slice(4);
        let elm = document.getElementsByClassName(className);

        if (elm[0].classList.contains('block')) {
            elm[0].classList.replace('block', 'hidden');
            elm[1].classList.replace('hidden', 'block');
        } else {
            elm[0].classList.replace('hidden', 'block');
            elm[1].classList.replace('block', 'hidden');
        }
    })

    $('.btn-stop').on('click',function(){
        if(confirm('このレクチャーを削除しますか？')){
            $(this).parent().submit();
        }
    })

    let config = {
        "csrf_token" : "{{ csrf_token() }}",
        "url" : {    
            "sort" : "{{ route('admin.lecture.sort', [ 'id' => $section->id, ]) }}",
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
        Section.sort().send((data) => { if(!data) alert('順番を変更することができませんでした') });
    },
});
</script>
@endpush
