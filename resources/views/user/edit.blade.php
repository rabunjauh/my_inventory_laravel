@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/user/{{ $user->id }}" method="post">
        @method('put')
        @csrf
      <div class="mb-3">
        <label for="employee_id" class="form-label">Employee</label>
        <select id="employee_id" class="form-control @error('employee_id')is-invalid @enderror" name="employee_id">
          <option value=""></option>
          @foreach($employees as $employee)
            <option value="{{ $employee->id }}" {{ old('employee_id', $user->employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
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
        <input type="text" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="isAdmin" class="form-label">User Type</label>
        @if(old('isAdmin') == 1)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isAdmin" name="isAdmin" value="1" checked>
            <label class="form-check-label" for="isAdmin">Admin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isAdmin" name="isAdmin" value="0">
            <label class="form-check-label" for="isAdmin">Reguler User</label>
          </div>
          @error('isAdmin')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @elseif(old('isAdmin') == 0)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isAdmin" name="isAdmin" value="1">
            <label class="form-check-label" for="isAdmin">Admin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isAdmin" name="isAdmin" value="0" checked>
            <label class="form-check-label" for="isAdmin">Reguler User</label>
          </div>
          @error('isAdmin')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @else
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isAdmin" name="isAdmin" value="1" checked>
            <label class="form-check-label" for="isAdmin">Admin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="isAdmin" name="isAdmin" value="0">
            <label class="form-check-label" for="isAdmin">Reguler User</label>
          </div>
          @error('isAdmin')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        @endif
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