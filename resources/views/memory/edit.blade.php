@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-5">
      <form action="/memory/{{ $memory->id }}" method="post">
        @method('put')
        @csrf
      <div class="mb-3">
        <label for="type" class="form-label">Memory Type</label>
        <input type="text" class="form-control @error('type')is-invalid @enderror" id="type" name="type" value="{{ old('type', $memory->type) }}" placeholder="Memory Type" required autofocus>
        @error('type')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="module" class="form-label">Module</label>
        <input type="text" class="form-control @error('module')is-invalid @enderror" id="module" name="module" value="{{ old('module', $memory->module) }}" placeholder="Module" required autofocus>
        @error('module')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="capacity" class="form-label">Capacity</label>
        <input type="text" class="form-control @error('capacity')is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $memory->capacity) }}" placeholder="Capacity" required autofocus>
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
            <option value="{{ $manufacturer->id }}" {{ old('manufacturer_id', $memory->manufacturer_id) == $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $memory->description) }}</textarea>
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
      <a href="/memory" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/memory/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush