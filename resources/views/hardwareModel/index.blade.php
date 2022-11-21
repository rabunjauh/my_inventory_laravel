@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button hardwareModel="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/hardwareModel/create" class="btn btn-primary">
            Add Hardware Model</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="hardwareModels">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Model Name</th>
                  <th>Manufacturer</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($hardwareModels->count())
                  @foreach ($hardwareModels as $hardwareModel)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $hardwareModel->name }}</td>
                      <td>{{ $hardwareModel->manufacturer->name }}</td>
                      <td>
                        <a href="/hardwareModel/{{ $hardwareModel->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/hardwareModel/{{ $hardwareModel->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/hardwareModel/script.js') }}"></script>
@endpush