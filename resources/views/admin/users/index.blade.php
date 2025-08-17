@extends('layouts.admin')
@section('title','Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Users</h4>
  <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
</div>

<form method="GET" class="row g-2 mb-3">
  <div class="col-md-4">
    <input type="text" name="q" class="form-control" placeholder="Search name or email" value="{{ $q ?? request('q') }}">
  </div>
  <div class="col-md-3">
    <select name="role" class="form-select">
      <option value="">All Roles</option>
      <option value="admin" @selected((request('role')==='admin'))>Admin</option>
      <option value="user" @selected((request('role')==='user'))>User</option>
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-secondary w-100">Filter</button>
  </div>
  <div class="col-md-2">
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark w-100">Reset</a>
  </div>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead>
        <tr>
          <th>#</th><th>Name</th><th>Email</th><th>Lat</th><th>Lng</th><th>Admin?</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
        <tr>
          <td>{{ $u->id }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td>{{ $u->latitude }}</td>
          <td>{{ $u->longitude }}</td>
          <td><span class="badge {{ $u->is_admin?'bg-success':'bg-secondary' }}">{{ $u->is_admin ? 'Yes' : 'No' }}</span></td>
          <td>
            <a href="{{ route('admin.users.edit',$u) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.users.destroy',$u) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete user?')">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center">No users found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="card-footer">{{ $users->links() }}</div>
</div>
@endsection
