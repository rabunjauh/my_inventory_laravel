@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/user" method="post">
        @csrf
        
      <div class="mb-3">
        <label for="employee_id" class="form-label">Employee</label>
        <select id="employee_id" class="form-control @error('employee_id')is-invalid @enderror" name="employee_id">
          <option value=""></option>
          @foreach($employees as $employee)
            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
          @endforeach
        </select>
        @error('employee_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Minimum 6 character required" required>
      </div>
      
      <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" name="password_confirmation" value="{{ old('password') }}" placeholder="Confirm Password" required>
        @error('password')
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
      <a href="/user" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/user/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush