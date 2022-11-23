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
          <a href="/inventory/create" class="btn btn-primary">
            Inventory In</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered" id="inventories">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Hardware Code</th>
                  <th>Serial No</th>
                  <th>Type</th>
                  <th>Model</th>
                  <th>Operating System</th>
                  <th>Processor</th>
                  <th>Memory</th>
                  <th>Hard Disk</th>
                  <th>Qty</th>
                  <th>Alert Qty</th>
                  <th>Inventory Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($inventories->count())
                  @foreach ($inventories as $inventory)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $inventory->hardware->code }}</td>
                      <td>{{ ($inventory->hardware) ? 'Active' : 'Not Active' }}</td>
                      <td>{{ ($inventory->hardware) ? 'Internal' : 'External' }}</td>
                      <td>
                        <a href="/inventory/{{ $inventory->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/inventory/{{ $inventory->id }}" method="post" class="d-inline">
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
  <script src="{{ URL::asset('js/inventory/script.js') }}"></script>
@endpush