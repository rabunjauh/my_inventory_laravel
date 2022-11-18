{{-- @dd($assigns) --}}
@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button graphicCard="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/graphicCard/create" class="btn btn-primary">
            Add Graphic Card</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="graphicCards">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Type</th>
                  <th>Capacity</th>
                  <th>Model</th>
                  <th>Manufacturer</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($graphicCards->count())
                  @foreach ($graphicCards as $graphicCard)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $graphicCard->type }}</td>
                      <td>{{ $graphicCard->capacity }}</td>
                      <td>{{ $graphicCard->model }}</td>
                      <td>{{ $graphicCard->manufacturer->name }}</td>
                      <td>{{ $graphicCard->description }}</td>
                      <td>
                        <a href="/graphicCard/{{ $graphicCard->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/graphicCard/{{ $graphicCard->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/graphicCard/script.js') }}"></script>
@endpush