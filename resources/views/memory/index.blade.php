{{-- @dd($assigns) --}}
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
          <a href="/memory/create" class="btn btn-primary">
            Add Hardware memory</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="memories">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Type</th>
                  <th>Module</th>
                  <th>Capacity</th>
                  <th>Manufacturer</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($memories->count())
                  @foreach ($memories as $memory)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $memory->type }}</td>
                      <td>{{ $memory->module }}</td>
                      <td>{{ $memory->capacity }}</td>
                      <td>{{ $memory->manufacturer->name }}</td>
                      <td>{{ $memory->description }}</td>
                      <td>
                        <a href="/memory/{{ $memory->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/memory/{{ $memory->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/memory/script.js') }}"></script>
@endpush