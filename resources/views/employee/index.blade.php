@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button employee="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/employee/create" class="btn btn-primary">
            Add Employee</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="employees">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Employee Name</th>
                  <th>Department</th>
                  <th>Position</th>
                  <th>Status</th>
                  <th>is HOD</th>
                  <th>HOD</th>
                  <th>Join Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($employees->count())
                  @foreach ($employees as $employee)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $employee->name }}</td>
                      <td>{{ $employee->department->name }}</td>
                      <td>{{ $employee->position->name }}</td>
                      <td>{{ ($employee->status === 1) ? 'Active' : 'Not Active' }}</td>
                      <td>{{ ($employee->isHod === 1) ? 'Yes' : 'No' }}</td>
                      <td>{{ $employee->hod }}</td>
                      <td>{{ $employee->join_date }}</td>
                      <td>
                        <a href="/employee/{{ $employee->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/employee/{{ $employee->id }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                      </td>
                    </tr>    
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/employee/script.js') }}"></script>
@endpush