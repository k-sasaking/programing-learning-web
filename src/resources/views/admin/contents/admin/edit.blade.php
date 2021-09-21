@extends('admin.layouts.base')

@section('title', '管理者詳細 | 管理画面')

@section('content')
<table class="table table-stripe">
    <tr>
        <th>名前</th>
        <td>{{ $admin->username }}</td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>{{ $admin->email }}</td>
    </tr>
    <tr>
        <th>登録日</th>
        <td>{{ $admin->created_at->format('Y/m/d h:i:s') }}</td>
    </tr>
    <tr>
        <th>最終ログイン</th>
        <td>{{ $admin->last_login_at?->format('Y/m/d h:i:s') }}</td>
    </tr>
</table>
<a href="javascript:history.back();">
    <button type="button" class="btn btn-secondary">戻る</button>
</a>
@endsection
