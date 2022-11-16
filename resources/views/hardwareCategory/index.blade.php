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
          <a href="/hardwareCategory/create" class="btn btn-primary">
            Add Category</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered" id="hardwareCategories">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($categories->count())
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $category->name }}</td>
                      <td>
                        <a href="/hardwareCategory/{{ $category->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/hardwareCategory/{{ $category->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/hardwareCategory/script.js') }}"></script>
@endpush