@extends('layouts.main')

@section('container')
    <div class="container mt-3">
      <div class="row">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button hardware="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>

      <div class="row">
        <h1 class="mb-5">{{ $title }}</h1>
      </div>

        <div class="row mb-2">
        <div class="col-lg-5">
          <a href="/create" class="btn btn-primary">
            Add Hardware</a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-striped table-sm" id="hardwares" style="width:100%">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Hardware Code</th>
                    <th>Category</th>
                    <th>Hardware Name</th>
                    <th>Manufacturer</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Model</th>
                    <th>Processor</th>
                    <th>Memory</th>
                    <th>Graphic Card</th>
                    <th>Storage</th>
                    {{-- <th>Warranty Start</th>
                    <th>Warranty End</th>
                    <th>Description</th>
                    <th>Remark</th> --}}
                    <th>Service Code</th>
                    <th>Computer Name</th>
                    {{-- <th>Image</th> --}}
                </tr>
              </thead>`
              <tbody>
                  {{-- @foreach ($hardwares as $hardware)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $hardware->code }}</td>
                      <td>{{ $hardware->hardwareCategory->name }}</td>
                      <td>{{ $hardware->name }}</td>
                      <td>{{ $hardware->manufacturer->name }}</td>
                      <td>{{ $hardware->serial_number }}</td>
                      <td>{{ ( $hardware->status == "1" ? 'Active' : 'Not Active') }}</td>
                      <td>{{ $hardware->hardwareType->name }}</td>
                      <td>{{ $hardware->hardwareModel->name }}</td>
                      <td>{{ $hardware->processor->model_no }}</td>
                      <td>{{ $hardware->memory->capacity }}</td>
                      <td>{{ $hardware->graphicCard->model }}</td>
                      <td>{{ $hardware->storage->capacity }}</td>
                      <td>{{ $hardware->warranty_start }}</td>
                      <td>{{ $hardware->warranty_end }}</td>
                      <td>{{ $hardware->description }}</td>
                      <td>{{ $hardware->remark }}</td>
                      <td>{{ $hardware->service_code }}</td>
                      <td>{{ $hardware->computer_name }}</td>
                      <td><img src="{{ $hardware->image_name}}.{{ $hardware->image_format }}" alt=""></td>
                      <td>
                        <a href="/hardware/{{ $hardware->id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
                        <form action="/hardware/{{ $hardware->id }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                      </td>
                    </tr>    
                  @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/hardware/script.js') }}"></script>
@endpush