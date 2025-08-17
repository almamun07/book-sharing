@extends('layouts.admin')
@section('title','Dashboard')

@section('content')
<div class="row g-3">
  <div class="col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="text-muted">Total Users</h6>
        <h2>{{ $userCount }}</h2>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="text-muted">Total Books</h6>
        <h2>{{ $bookCount }}</h2>
      </div>
    </div>
  </div>
</div>
@endsection
