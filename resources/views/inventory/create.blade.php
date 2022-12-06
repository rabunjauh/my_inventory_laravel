@extends('layouts.main')

@section('container')
<div class="container">
  <form action="/inventory" method="post">
    @csrf
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-lg-5">
      <div class="mb-3">
        <label for="type" class="form-label">Inventory Date</label>
        <input type="text" class="form-control @error('inventory_date')is-invalid @enderror" id="inventory_date" name="inventory_date" value="{{ old('inventory_date') }}" placeholder="YYYY-MM-DD" autofocus required>
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
            <option></option>
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
        <input type="text" class="form-control @error('do_date')is-invalid @enderror" id="do_date" name="do_date" value="{{ old('do_date') }}" placeholder="YYYY-MM-DD" required>
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
    <div class="col-lg-6">
      <select class="form-control js-example-basic-single" id="selectHardware" name="selectHardware">
      <option></option>
      </select>
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
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="reset" class="btn btn-warning">Reset</button>
      <a href="/inventory" class="btn btn-info ms-auto">Back</a>
    </div>
  </div>
    </form>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/inventory/create.js') }}"></script>
@endpush