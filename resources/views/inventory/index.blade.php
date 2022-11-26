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
            Add Inventory</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="inventories">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Inventory Date</th>
                  <th>DO Date</th>
                  <th>DO No</th>
                  <th>Supplier Name</th>
                  <th>Remark</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($inventories as $inventory)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $inventory->inventory_date }}</td>
                      <td>{{ $inventory->do_date }}</td>
                      <td>{{ $inventory->do_no }}</td>
                      <td>{{ $inventory->supplier->name }}</td>
                      <td>{{ $inventory->remark }}</td>
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
              </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/inventory/script.js') }}"></script>
@endpush