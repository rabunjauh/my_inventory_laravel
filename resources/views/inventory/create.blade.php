@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-lg-5">
      <form action="/inventory" method="post">
        @csrf
      <div class="mb-3">
        <label for="type" class="form-label">Inventory Date</label>
        <input type="text" class="form-control @error('inventory_date')is-invalid @enderror" id="inventory_date" name="inventory_date" value="{{ old('inventory_date') }}" placeholder="Inventory Date" required autofocus>
        @error('inventory_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="supplier_id" class="form-label">Supplier</label>
        <select class="js-example-basic-single form-control @error('supplier_id')is-invalid @enderror" name="supplier_id">
          @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
          @endforeach
        </select>
      </div>
      
      <div class="mb-3">
        <label for="remark" class="form-label">Remark</label>
        <textarea class="form-control" id="remark" name="remark" rows="3">{{ old('remark') }}</textarea>
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
        <input type="text" class="form-control @error('do_date')is-invalid @enderror" id="do_date" name="do_date" value="{{ old('do_date') }}" placeholder="DO Date" required>
        @error('do_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="do_no" class="form-label">DO Number</label>
        <input type="text" class="form-control @error('do_no')is-invalid @enderror" id="do_no" name="do_no" value="{{ old('do_no') }}" placeholder="DO No" required>
        @error('do_no')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <h2>Hardware</h2>
    <div class="col-lg-12">
      <table class="table table-bordered table-striped" id="inventoryDetails">
        <thead>
          <tr>
            <th>No</th>
            <th>Hardware</th>
            <th>Serial No</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="browseHardware" data-bs-target="#staticBackdrop">
        Browse Hardware
      </button>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="reset" class="btn btn-warning">Reset</button>
      <a href="/inventory" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>

<!-- Modal for Hardware -->
<div class="modal fade modal-xl modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Items</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped" id="hardwareItems">
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
              <th>Storage Capacity</th>
              <th>Warranty Start</th>
              <th>Warranty End</th>
              <th>Express Service Code</th>
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
  <script src="{{ URL::asset('js/inventory/create.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush