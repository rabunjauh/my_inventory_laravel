@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/employee/{{ $employee->id }}" method="post">
        @method('put')
        @csrf
      <div class="mb-3">
        <label for="type" class="form-label">Employee ID</label>
        <input type="text" class="form-control @error('employee_id')is-invalid @enderror" id="employee_id" name="employee_id" value="{{ old('employee_id', $employee->employee_id) }}" placeholder="Employee ID" required autofocus>
        @error('employee_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="type" class="form-label">Employee Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name', $employee->name) }}" placeholder="Employee Name" required autofocus>
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
            <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
          @endforeach
        </select>
        @error('department_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="position_id" class="form-label">Position</label>
        <select class="js-example-basic-single form-control @error('position_id')is-invalid @enderror" name="position_id">
          @foreach($positions as $position)
            <option value="{{ $position->id }}" {{ old('position_id', $position->id) == $employee->position_id ? 'selected' : '' }}>{{ $position->name }}</option>
          @endforeach
        </select>
        @error('position_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        @if(old('status', $employee->status) == "1")
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
        @elseif(old('status', $employee->status) == "0")
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
        {{-- <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="isHod"  name="isHod">
          <label class="form-check-label" for="isHod">
            is HOD
          </label>
        </div> --}}
        <label for="isHod" class="form-label">Is HOD</label>
        <select class="js-example-basic-single form-control @error('isHod')is-invalid @enderror" name="isHod">
          @if(old('isHod', $employee->isHod) == 0)
          <option value="0" selected>No</option>
          <option value="1">Yes</option>
          @else
          <option value="0">No</option>
          <option value="1" selected>Yes</option>
        @endif
        </select>
        @error('isHod')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="hod_id" class="form-label">HOD Name</label>
        <select class="js-example-basic-single form-control @error('hod_id')is-invalid @enderror" name="hod_id">
          @foreach($hods as $hod)
            <option value="{{ $hod->id }}" {{ old('hod_id') == $employee->hod_id ? 'selected' : '' }}>{{ $hod->name }}</option>
          @endforeach
        </select>
        @error('hod_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="join_date" class="form-label">Join Date</label>
        <input type="text" class="form-control @error('join_date')is-invalid @enderror" id="join_date" name="join_date" value="{{ old('join_date', $employee->join_date) }}" placeholder="YYYY-MM-DD" required>
        @error('join_date')
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