@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/project" method="post">
        @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Project Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Project Name" required autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="reset" class="btn btn-warning">Reset</button>
      <a href="/project" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection