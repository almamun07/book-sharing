<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Admin')</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .sidebar-link.active{ background:#0d6efd; color:#fff; }
    .toast-container{ position: fixed; bottom: 1rem; right: 1rem; z-index: 1080; }
  </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Book Sharing Admin</a>
    <div class="d-flex">
      @auth
      <form action="{{ route('admin.logout') }}" method="POST" class="ms-2">
        @csrf
        <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
      </form>
      @endauth
    </div>
  </div>
</nav>

@auth
<div class="container-fluid">
  <div class="row">
    <aside class="col-md-3 col-lg-2 bg-white border-end min-vh-100 p-0">
      <div class="list-group list-group-flush">
        <a href="{{ route('admin.dashboard') }}"
           class="list-group-item list-group-item-action sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="list-group-item list-group-item-action sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
          Users
        </a>
        <a href="{{ route('admin.books.index') }}"
           class="list-group-item list-group-item-action sidebar-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
          Books
        </a>
      </div>
    </aside>
    <main class="col-md-9 col-lg-10 p-4">
      @yield('content')
    </main>
  </div>
</div>
@else
<div class="container py-4">
  @yield('content')
</div>
@endauth

{{-- Toast Alerts --}}
<div class="toast-container">
  @if(session('success'))
    <div class="toast align-items-center text-bg-success border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body">{{ session('success') }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="toast align-items-center text-bg-danger border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body">{{ session('error') }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif

  @if ($errors->any())
    <div class="toast align-items-center text-bg-warning border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Validation Errors:</strong>
          <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.querySelectorAll('.toast').forEach(t => new bootstrap.Toast(t, { delay: 3000 }).show());
</script>
</body>
</html>
