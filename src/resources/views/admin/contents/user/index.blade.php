@extends('admin.layouts.base')

@section('title', 'メンバー管理 | 管理画面')

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
