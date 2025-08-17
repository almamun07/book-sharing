@extends('layouts.admin')
@section('title','Edit Book')

@section('content')
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Edit Book</h5>
    <form method="POST" action="{{ route('admin.books.update',$book) }}">
      @csrf @method('PUT')
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Title</label>
          <input name="title" class="form-control" value="{{ old('title',$book->title) }}" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Author</label>
          <input name="author" class="form-control" value="{{ old('author',$book->author) }}" required>
        </div>
        <div class="col-12">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="4">{{ old('description',$book->description) }}</textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">User (Owner)</label>
          <select name="user_id" class="form-select" required>
            @foreach($users as $u)
              <option value="{{ $u->id }}" @selected(old('user_id',$book->user_id)==$u->id)>{{ $u->name }} ({{ $u->email }})</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
