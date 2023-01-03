@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/position/create" class="btn btn-primary">
            Add Position</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered" id="positions">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($positions->count())
                  @foreach ($positions as $position)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $position->name }}</td>
                      <td>{{ $position->department->name }}</td>
                      <td>{{ ()$position->status == 1) ? 'Active' : 'Not Active' }}</td>
                      <td>
                        <a href="/position/{{ $position->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/position/{{ $position->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/position/script.js') }}"></script>
@endpush