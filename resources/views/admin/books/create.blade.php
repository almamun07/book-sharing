@extends('layouts.admin')
@section('title','Add Book')

@section('content')
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Add Book</h5>
    <form method="POST" action="{{ route('admin.books.store') }}">
      @csrf
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Title</label>
          <input name="title" class="form-control" value="{{ old('title') }}" required>
          @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Author</label>
          <input name="author" class="form-control" value="{{ old('author') }}" required>
          @error('author') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-12">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">User (Owner)</label>
          <select name="user_id" class="form-select" required>
            <option value="">-- Select User --</option>
            @foreach($users as $u)
              <option value="{{ $u->id }}" @selected(old('user_id')==$u->id)>{{ $u->name }} ({{ $u->email }})</option>
            @endforeach
          </select>
          @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
