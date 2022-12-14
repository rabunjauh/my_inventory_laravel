@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/position/{{ $position->id }}" method="post">
        @method('put')
        @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Position Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name', $position->name) }}" placeholder="Position Name" required autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        @if(old('status', $position->status) == 1)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
            <label class="form-check-label" for="status">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="0">
            <label class="form-check-label" for="status">Not Active</label>
          </div>
          @error('status')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @elseif(old('status', $position->status) == 0)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="1">
            <label class="form-check-label" for="status">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="0" checked>
            <label class="form-check-label" for="status">Not Active</label>
          </div>
          @error('status')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @else
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
            <label class="form-check-label" for="status">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="0">
            <label class="form-check-label" for="status">Not Active</label>
          </div>
          @error('status')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        @endif
      </div>  

      <div class="mb-3">
        <label for="department_id" class="form-label">Department</label>
        <select class="js-example-basic-single form-control @error('department_id')is-invalid @enderror" name="department_id">
          @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id', $position->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
          @endforeach
        </select>
        @error('department_id')
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
      <a href="/position" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/graphicCard/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush