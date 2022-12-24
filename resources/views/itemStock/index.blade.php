{{-- call layouts.main --}}
@extends('layouts.main')

{{-- send to layouts.main yield --}}
@section('container')
    <div class="container mt-3">
      <div class="row">
        {{-- alert notification --}}
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
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="itemStocks">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Code</th>
                  <th>Item Name</th>
                  <th>Service Tag</th>
                  <th>Machine Type</th>
                  <th>Model</th>
                  <th>Processor</th>
                  <th>Memory</th>
                  <th>Storage</th>
                  <th>Quantity</th>
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
  <script src="{{ URL::asset('js/itemStock/script.js') }}"></script>
@endpush