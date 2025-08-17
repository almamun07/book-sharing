@extends('layouts.admin')
@section('title','Books')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Books</h4>
  <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add Book</a>
</div>

<form method="GET" class="row g-2 mb-3">
  <div class="col-md-4">
    <input type="text" name="q" class="form-control" placeholder="Search title or author" value="{{ $q ?? request('q') }}">
  </div>
  <div class="col-md-4">
    <select name="user_id" class="form-select">
      <option value="">All Owners</option>
      @foreach($users as $u)
        <option value="{{ $u->id }}" @selected((int)request('user_id')===$u->id)>{{ $u->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-secondary w-100">Filter</button>
  </div>
  <div class="col-md-2">
    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-dark w-100">Reset</a>
  </div>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead>
        <tr>
          <th>#</th><th>Title</th><th>Author</th><th>User</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($books as $b)
        <tr>
          <td>{{ $b->id }}</td>
          <td>{{ $b->title }}</td>
          <td>{{ $b->author }}</td>
          <td>{{ $b->user?->name }}</td>
          <td>
            <a href="{{ route('admin.books.edit',$b) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.books.destroy',$b) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete book?')">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">No books found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="card-footer">{{ $books->links() }}</div>
</div>
@endsection
