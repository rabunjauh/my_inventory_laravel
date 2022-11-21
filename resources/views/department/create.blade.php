@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/department" method="post">
        @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Department Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Department Name" required autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="isActive" class="form-label">Status</label>
        @if(old('isActive') == "1")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isActive" name="isActive" value="1" checked>
            <label class="form-check-label" for="isActive">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isActive" name="isActive" value="0">
            <label class="form-check-label" for="isActive">Not Active</label>
          </div>
          @error('isActive')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @elseif(old('isActive') == "0")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isActive" name="isActive" value="1">
            <label class="form-check-label" for="isActive">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isActive" name="isActive" value="0" checked>
            <label class="form-check-label" for="isActive">Not Active</label>
          </div>
          @error('isActive')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @else
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isActive" name="isActive" value="1" checked>
            <label class="form-check-label" for="isActive">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isActive" name="isActive" value="0">
            <label class="form-check-label" for="isActive">Not Active</label>
          </div>
          @error('isActive')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        @endif
      </div>  
      
      <div class="mb-3">
        <label for="group" class="form-label">Group</label>
        @if(old('group') == "0")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="group" name="group" value="0" checked>
            <label class="form-check-label" for="group">Internal</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="group" name="group" value="1">
            <label class="form-check-label" for="group">External</label>
          </div>
          @error('group')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @elseif(old('group') == "0")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="group" name="group" value="0">
            <label class="form-check-label" for="group">Internal</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="group" name="group" value="1" checked>
            <label class="form-check-label" for="group">External</label>
          </div>
          @error('group')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @else
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="group" name="group" value="0" checked>
            <label class="form-check-label" for="group">Internal</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="group" name="group" value="1">
            <label class="form-check-label" for="group">External</label>
          </div>
          @error('group')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        @endif
      </div>  
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="reset" class="btn btn-warning">Reset</button>
      <a href="/department" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection