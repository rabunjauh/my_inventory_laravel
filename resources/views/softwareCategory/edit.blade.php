@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/softwareCategory/{{ $category->id }}" method="post">
        @method('put')
        @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Category Name" required autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-check">
        <input type="hidden" name="is_over_usage" value="0">
        @if($category->is_over_usage == "1")
        <input class="form-check-input" type="checkbox" value="1" name="is_over_usage" id="is_over_usage" checked>
        @else 
        <input class="form-check-input" type="checkbox" value="0" name="is_over_usage" id="is_over_usage">
        @endif
        <label class="form-check-label" for="is_over_usage">
          Allow Over Usage
        </label>
      </div>
      
      @error('is_over_usage')
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
      <a href="/softwareCategory" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection