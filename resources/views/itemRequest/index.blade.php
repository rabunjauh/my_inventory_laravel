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
            New Request</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="itemRequests">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Action</th>
                  <th>Request No</th>
                  <th>Request Date</th>
                  <th>Employee Name</th>
                  <th>Department</th>
                  <th>Position</th>
                  <th>Join Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @if ($itemRequests->count())
                  @foreach ($itemRequests as $itemRequest)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <a href="/itemRequest/{{ $itemRequest->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <a href="/itemRequest/{{ $itemRequest->id }}/show" class="badge bg-warning text-decoration-none">Detail</i></a>  
                        <form action="/itemRequest/{{ $itemRequest->id }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                      </td>
                      <td>{{ $itemRequest->item_request_code }}</td>
                      <td>{{ $itemRequest->request_date }}</td>
                      <td>{{ $itemRequest->employee->name }}</td>
                      <td>{{ $itemRequest->employee->department->name }}</td>
                      <td>{{ $itemRequest->employee->position->name }}</td>
                      <td>{{ $itemRequest->employee->join_date }}</td>
                      @if($itemRequest->status == 0)
                        <td>Progress in HR Recruiter</td>
                      @elseif($itemRequest->status == 1)
                        <td>Pending approval by HOD</td>
                      @elseif($itemRequest->status == 2)
                        <td>Request in progress by HR Recruiter</td>
                      @endif  
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