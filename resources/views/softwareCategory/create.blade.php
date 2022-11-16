@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/softwareCategory" method="post">
        @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Category Name" required autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
      {{-- @if(!old('is_over_usage') || old('is_over_usage') == "1")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="is_over_usage" name="is_over_usage" value="1" checked>
            <label class="form-check-label" for="is_over_usage">Over Usage Allowed</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="is_over_usage" name="is_over_usage" value="0">
            <label class="form-check-label" for="is_over_usage">Over Usage Not Allowed</label>
          </div>
        @elseif(old('is_over_usage') == "0")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="is_over_usage" name="is_over_usage" value="1">
            <label class="form-check-label" for="is_over_usage">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="is_over_usage" name="is_over_usage" value="0" checked>
            <label class="form-check-label" for="is_over_usage">Not Active</label>
          </div>
        @endif --}}

        <div class="form-check">
          <input type="hidden" name="is_over_usage" value="0">
          <input class="form-check-input" type="checkbox" value="1" name="is_over_usage" id="is_over_usage">
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