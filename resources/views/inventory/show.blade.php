{{-- @dd($inventoryDetails) --}}
@extends('layouts.main')

@section('container')
  <div class="container mt-3">
    <div class="row">
      <h1 class="mb-5">{{ $title }}</h1>
    </div>

    <div class="row mb-5">
        <p>Supplier: {{ $inventory->supplier->name }}</p>
        <p>Inventory Date: {{ $inventory->inventory_date }}</p>
        <p>Do No: {{ $inventory->do_no }}</p>
        <p>Do Date: {{ $inventory->do_date }}</p>
        <p>Do Date: {{ $inventory->do_date }}</p>
        <p>Remark: {{ $inventory->remark }}</p>
        <input type="hidden" id="inventoryId" value={{ $inventory->id }}>
    </div>

    <div class="row mt-3 mb-5">
      <div class="col-lg-12">
        <table class="table table-bordered table-striped" id="InventoryDetails">
          <thead>
            <tr>
              <th>No</th>
              <th>Hardware Name</th>
              <th>Serial No</th>
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
  <script src="{{ URL::asset('js/inventory/show.js') }}"></script>
@endpush