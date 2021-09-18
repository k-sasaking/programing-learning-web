@extends('admin.layouts.base')

@section('title', 'メンバー詳細 | 管理画面')

@section('content')
<table class="table table-stripe">
    <tr>
        <th>名前</th>
        <td>{{ $user->username }}</td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>{{ $user->email }}</td>
    </tr>
</table>
<a href="javascript:history.back();">
    <button type="button" class="btn btn-secondary">戻る</button>
</a>
@endsection
