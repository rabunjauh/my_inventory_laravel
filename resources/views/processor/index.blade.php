{{-- @dd($assigns) --}}
@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button processor="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/processor/create" class="btn btn-primary">
            Add Processor</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="processors">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Model No</th>
                  <th>Manufacturer</th>
                  <th>Core</th>
                  <th>Frequency</th>
                  <th>Memory Support</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($processors->count())
                  @foreach ($processors as $processor)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $processor->model_no }}</td>
                      <td>{{ $processor->manufacturer->name }}</td>
                      <td>{{ $processor->core }}</td>
                      <td>{{ $processor->frequency }}</td>
                      <td>{{ $processor->memory_support }}</td>
                      <td>
                        <a href="/processor/{{ $processor->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/processor/{{ $processor->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/processor/script.js') }}"></script>
@endpush