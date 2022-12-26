@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/employee" method="post">
        @csrf
      <div class="mb-3">
        <label for="type" class="form-label">Employee Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Employee Name" required autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="department_id" class="form-label">Department</label>
        <select class="js-example-basic-single form-control @error('department_id')is-invalid @enderror" name="department_id">
          @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
          @endforeach
        </select>
      </div>
      
      <div class="mb-3">
        <label for="capacity" class="form-label">Capacity</label>
        <input type="text" class="form-control @error('capacity')is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" placeholder="Capacity" required autofocus>
        @error('capacity')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="model" class="form-label">Model</label>
        <input type="text" class="form-control @error('model')is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" placeholder="Model" required autofocus>
        @error('model')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
      </div>
      @error('description')
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
      <a href="/employee" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/employee/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush