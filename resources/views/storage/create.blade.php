@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/storage" method="post">
        @csrf
      <div class="mb-3">
        <label for="size" class="form-label">Drive Size</label>
        <input type="text" class="form-control @error('size')is-invalid @enderror" id="size" name="size" value="{{ old('size') }}" placeholder="Drive Size" required autofocus>
        @error('size')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="capacity" class="form-label">Drive Capacity</label>
        <input type="text" class="form-control @error('capacity')is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" placeholder="Drive Capacity" required autofocus>
        @error('capacity')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="manufacturer_id" class="form-label">Manufacturer</label>
        <select class="js-example-basic-single form-control @error('manufacturer_id')is-invalid @enderror" name="manufacturer_id">
          @foreach($manufacturers as $manufacturer)
            <option value="{{ $manufacturer->id }}" {{ old('manufacturer_id') == $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
          @endforeach
        </select>
        @error('manufacturer_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="technology" class="form-label">Drive Technology</label>
        <input type="text" class="form-control @error('technology')is-invalid @enderror" id="technology" name="technology" value="{{ old('technology') }}" placeholder="Drive Technology" required autofocus>
        @error('technology')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="type" class="form-label">Drive Type</label>
        <input type="text" class="form-control @error('type')is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" placeholder="Drive Type" required autofocus>
        @error('type')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="reset" class="btn btn-warning">Reset</button>
      <a href="/storage" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/graphicCard/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush