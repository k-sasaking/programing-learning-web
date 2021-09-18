@extends('admin.layouts.base')

@section('title', 'ユーザー管理 | 管理画面')

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">ユーザー管理</li>
  </ol>
</nav>
@endsection

@section('content')
<table class="table table-stripe">
    <thead>
        <tr>
            <th>No</th>
            <th>ユーザー名</th>
            <th>メールアドレス</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}">
                <button type="button" class="btn btn-info">詳細</button>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
