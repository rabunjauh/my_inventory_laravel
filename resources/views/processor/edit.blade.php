@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/processor/{{ $processor->id }}" method="post">
        @method('put')
        @csrf
      <div class="mb-3">
        <label for="model_no" class="form-label">Model No</label>
        <input type="text" class="form-control @error('model_no')is-invalid @enderror" id="model_no" name="model_no" value="{{ old('model_no', $processor->model_no) }}" placeholder="Model No" required autofocus>
        @error('model_no')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="manufacturer_id" class="form-label">Manufacturer</label>
        <select class="js-example-basic-single form-control @error('manufacturer_id')is-invalid @enderror" name="manufacturer_id">
          @foreach($manufacturers as $manufacturer)
            <option value="{{ $manufacturer->id }}" {{ old('manufacturer_id', $processor->manufacturer_id) == $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
          @endforeach
        </select>
        @error('manufacturer_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="core" class="form-label">Core</label>
        <input type="text" class="form-control @error('core')is-invalid @enderror" id="core" name="core" value="{{ old('core', $processor->core) }}" placeholder="Core" required autofocus>
        @error('core')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="frequency" class="form-label">Frequency</label>
        <input type="text" class="form-control @error('frequency')is-invalid @enderror" id="frequency" name="frequency" value="{{ old('frequency', $processor->frequency) }}" placeholder="Frequency" required autofocus>
        @error('frequency')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="memory_support" class="form-label">Memory Support</label>
        <input type="text" class="form-control @error('memory_support')is-invalid @enderror" id="memory_support" name="memory_support" value="{{ old('memory_support', $processor->memory_support) }}" placeholder="Memory Support" required autofocus>
        @error('memory_support')
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
      <a href="/processor" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/graphicCard/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush