<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome CSS -->
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="{{ asset('/admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/css/theme.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    @yield('extra_css')
         
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('admin.user.index') }}"><img src="" alt="logo"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="username">{{ Auth::user()->admin_name }}</span><i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <form name="logout_form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <a class="dropdown-item" href="javascript:logout_form.submit()">ログアウト</a>
            </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 sidebar">
            <div class="list-group">
                <button type="button" class="list-group-item list-group-item-action header" disabled>メニュー</button>
                <button type="button" class="list-group-item list-group-item-action @if(request()->is('admin/user*')) active @endif"
                     @if(request()->is('admin/user*')) disabled @else onclick="location.href='{{ route('admin.user.index') }}'" @endif>ユーザー管理</button>
                <button type="button" class="list-group-item list-group-item-action @if(request()->is('admin/lesson*')) active @endif"
                     @if(request()->is('admin/lesson*')) disabled @else onclick="location.href='{{ route('admin.user.index') }}'" @endif>レッスン管理</button>
                <button type="button" class="list-group-item list-group-item-action @if(request()->is('admin/admin*')) active @endif"
                     @if(request()->is('admin/admin*')) disabled @else onclick="location.href='{{ route('admin.admin.index') }}'" @endif>アドミン管理</button>
            </div>
        </div>
        <div class="col-10">
            @yield('breadcrumb')
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</div>
<footer>

</footer>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="{{ asset('/admin/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
