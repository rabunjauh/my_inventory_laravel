{{-- @dd($itemRequests[2]->department); --}}
@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button itemRequest="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/itemRequest/create" class="btn btn-primary">
            Add itemRequest</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="itemRequests">
              <thead>
                <tr>
                  <th>No</th>
                  <th>itemRequest Name</th>
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
                @if ($itemRequests->count())
                  @foreach ($itemRequests as $itemRequest)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $itemRequest->name }}</td>
                      <td>{{ $itemRequest->department->name }}</td>
                      <td>{{ $itemRequest->position->name }}</td>
                      <td>{{ ($itemRequest->status === 1) ? 'Active' : 'Not Active' }}</td>
                      <td>{{ ($itemRequest->isHod === 1) ? 'Yes' : 'No' }}</td>
                      @if($itemRequest->hod)
                      <td>{{ $itemRequest->hod->name }}</td>
                      @else
                      <td>{{ '' }}</td>
                      @endif
                      <td>{{ $itemRequest->join_date }}</td>
                      <td>
                        <a href="/itemRequest/{{ $itemRequest->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <a href="/itemRequest/{{ $itemRequest->id }}/show" class="badge bg-warning text-decoration-none">Detail</i></a>  
                        <form action="/itemRequest/{{ $itemRequest->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/itemRequest/script.js') }}"></script>
@endpush