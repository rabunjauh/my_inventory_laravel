{{-- @dd($storages) --}}
@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button storage="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/storage/create" class="btn btn-primary">
            Add Storage</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="storages">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Size</th>
                  <th>Capacity</th>
                  <th>Manufacturer</th>
                  <th>Technology</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($storages->count())
                  @foreach ($storages as $storage)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $storage->size }}</td>
                      <td>{{ $storage->capacity }}</td>
                      <td>{{ $storage->manufacturer->name }}</td>
                      <td>{{ $storage->technology }}</td>
                      <td>{{ $storage->type }}</td>
                      <td>
                        <a href="/storage/{{ $storage->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/storage/{{ $storage->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/storage/script.js') }}"></script>
@endpush