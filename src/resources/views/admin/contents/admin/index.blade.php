@extends('admin.layouts.base')

@section('title', '管理者管理 | 管理画面')

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
        @foreach($admins as $admin)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $admin->admin_name }}</td>
            <td>{{ $admin->email }}</td>
            <td>
                <a href="{{ route('admin.admin.edit', ['id' => $admin->id])  }}" class="btn btn-info" role="button">詳細</a>
                <a href="javascript:void(0);" class="btn btn-danger btn-stop" role="button">停止</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
