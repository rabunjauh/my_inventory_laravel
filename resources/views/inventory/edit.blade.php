@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    @if (session()->has('failed'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('failed') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  </div>
  <form action="/inventory/{{ $inventory->id }}" method="post">
    @method('put')
    @csrf
    <input type="hidden" class="form-control" id="inventory_id" name="inventory_id" value="{{ $inventory->id }}">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-lg-5">
      <div class="mb-3">
        <label for="type" class="form-label">Inventory Date</label>
        <input type="text" class="form-control @error('inventory_date')is-invalid @enderror" id="inventory_date" name="inventory_date" value="{{ old('inventory_date', $inventory->inventory_date) }}" placeholder="YYYY-MM-DD" autofocus required>
        @error('inventory_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="supplier_id" class="form-label">Supplier</label>
        <select class="form-control @error('supplier_id')is-invalid @enderror" id="supplier_id" name="supplier_id" required>
          @foreach($suppliers as $supplier)
            {{-- <option></option> --}}
            <option value="{{ $supplier->id }}" {{ old('supplier_id', $supplier->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
          @endforeach
        </select>
      </div>
      
      <div class="mb-3">
        <label for="remark" class="form-label">Remark</label>
        <textarea class="form-control" id="remark" name="remark" rows="3">{{ old('remark', $inventory->remark) }}</textarea>
      </div>
      @error('remark')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-lg-5">
      <div class="mb-3">
        <label for="do_date" class="form-label">DO Date</label>
        <input type="text" class="form-control @error('do_date')is-invalid @enderror" id="do_date" name="do_date" value="{{ old('do_date', $inventory->do_date) }}" placeholder="YYYY-MM-DD" required>
        @error('do_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="do_no" class="form-label">DO Number</label>
        <input type="text" class="form-control @error('do_no')is-invalid @enderror" id="do_no" name="do_no" value="{{ old('do_no', $inventory->do_no) }}" placeholder="DO No" required>
        @error('do_no')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>
  </div>

  {{-- <div class="row mt-3">
    <div class="col-lg-6">
      <select class="form-control js-example-basic-single" id="selectHardware" name="selectHardware">
      <option></option>
      </select>
    </div>
  </div> --}}

  <div class="row mt-3">
    <div class="col-lg-6">
      <!-- Button trigger modal -->
      <button type="button" id="browseItems" name="browseItems" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Browse
      </button>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-lg-12">
      <table class="table table-bordered table-striped" id="inventoryDetails">
        <thead>
          <tr>
            <th>No</th>
            <th>Hardware Name</th>
            <th>Serial Number</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-6">
      <button type="submit" id="submit" class="btn btn-primary" disabled>Save</button>
      <button type="reset" class="btn btn-warning">Reset</button>
      <a href="/inventory" class="btn btn-info ms-auto">Back</a>
    </div>
  </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade modal-xl" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-sm" id="hardwares" style="width:100%">
          <thead>
            <tr>
                <th>No</th>
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
                <th>Service Code</th>
                <th>Computer Name</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
{{-- <script src="{{ URL::asset('js/inventory/script.js') }}"></script> --}}
<script src="{{ URL::asset('js/inventory/edit.js') }}"></script>
@endpush