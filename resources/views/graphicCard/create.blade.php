@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/graphicCard" method="post">
        @csrf
      <div class="mb-3">
        <label for="type" class="form-label">Graphic Card Type</label>
        <input type="text" class="form-control @error('type')is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" placeholder="Graphic Card Type" required autofocus>
        @error('type')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="capacity" class="form-label">Capacity</label>
        <input type="text" class="form-control @error('capacity')is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" placeholder="Capacity" required autofocus>
        @error('capacity')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="model" class="form-label">Model</label>
        <input type="text" class="form-control @error('model')is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" placeholder="Model" required autofocus>
        @error('model')
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
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
      </div>
      @error('description')
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
      <a href="/graphicCard" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/graphicCard/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush