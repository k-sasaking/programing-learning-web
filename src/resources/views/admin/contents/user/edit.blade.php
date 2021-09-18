@extends('admin.layouts.base')

@section('title', 'ユーザー詳細 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">ユーザー管理</a></li>
    <li class="breadcrumb-item active" aria-current="page">ユーザー詳細</li>
  </ol>
</nav>
@endsection

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
    <tr>
        <th>登録日</th>
        <td>{{ $user->created_at->format('Y/m/d h:i:s') }}</td>
    </tr>
    <tr>
        <th>最終ログイン</th>
        <td>{{ $user->last_login_at?->format('Y/m/d h:i:s') }}</td>
    </tr>
</table>
<a href="javascript:history.back();">
    <button type="button" class="btn btn-secondary">戻る</button>
</a>
@endsection
