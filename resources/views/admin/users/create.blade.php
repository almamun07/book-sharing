@extends('layouts.admin')
@section('title','Add User')

@section('content')
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Add User</h5>
    <form method="POST" action="{{ route('admin.users.store') }}">
      @csrf
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Name</label>
          <input name="name" class="form-control" value="{{ old('name') }}" required>
          @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control" required>
          @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-3">
          <label class="form-label">Latitude</label>
          <input name="latitude" type="number" step="0.0000001" class="form-control" value="{{ old('latitude') }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">Longitude</label>
          <input name="longitude" type="number" step="0.0000001" class="form-control" value="{{ old('longitude') }}">
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin">
            <label class="form-check-label" for="is_admin">Is Admin</label>
          </div>
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
