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
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/hardware/script.js') }}"></script>
@endpush