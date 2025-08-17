@extends('layouts.admin')
@section('title','Edit User')

@section('content')
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Edit User</h5>
    <form method="POST" action="{{ route('admin.users.update',$user) }}">
      @csrf @method('PUT')
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Name</label>
          <input name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" value="{{ old('email',$user->email) }}" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password (leave blank to keep)</label>
          <input name="password" type="password" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label">Latitude</label>
          <input name="latitude" type="number" step="0.0000001" class="form-control" value="{{ old('latitude',$user->latitude) }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">Longitude</label>
          <input name="longitude" type="number" step="0.0000001" class="form-control" value="{{ old('longitude',$user->longitude) }}">
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
            <label class="form-check-label" for="is_admin">Is Admin</label>
          </div>
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
