@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row">
    <h1>{{ $title }}</h1> 
  </div>
  <div class="row">
    <div class="col-md-6">
      <form action="/hardware" method="post">
        @csrf
      <div class="mb-3">
        <label for="code" class="form-label">Hardware Code</label>
        <input type="text" class="form-control @error('code')is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" placeholder="Hardware Code" required autofocus>
        @error('code')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="hardware_category_id" class="form-label">Category</label>
        <select class="js-example-basic-single form-control @error('hardware_category_id')is-invalid @enderror" name="hardware_category_id">
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('hardware_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
          @endforeach
        </select>
        @error('hardware_category_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
        @error('name')
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
        <label for="serial_number" class="form-label">Serial Number</label>
        <input type="text" class="form-control @error('serial_number')is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" placeholder="Serial Number" required autofocus>
        @error('serial_number')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        @if(old('status') == "1")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
            <label class="form-check-label" for="status">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="0">
            <label class="form-check-label" for="status">Not Active</label>
          </div>
          @error('status')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @elseif(old('status') == "0")
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="1">
            <label class="form-check-label" for="status">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="0" checked>
            <label class="form-check-label" for="status">Not Active</label>
          </div>
          @error('status')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        @else
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
            <label class="form-check-label" for="status">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status" name="status" value="0">
            <label class="form-check-label" for="status">Not Active</label>
          </div>
          @error('status')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        @endif
      </div>  

      <div class="mb-3">
        <label for="warranty_start" class="form-label">Warranty Start</label>
        <input type="text" class="form-control @error('warranty_start')is-invalid @enderror" id="warranty_start" name="warranty_start" value="{{ old('warranty_start') }}" placeholder="YYYY-DD-MM" autofocus>
        @error('warranty_start')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    
      <div class="mb-3">
        <label for="warranty_end" class="form-label">Warranty End</label>
        <input type="text" class="form-control @error('warranty_end')is-invalid @enderror" id="warranty_end" name="warranty_end" value="{{ old('warranty_end') }}" placeholder="YYYY-DD-MM" autofocus>
        @error('warranty_end')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>
    <div class="col-lg-5">
      <div class="mb-3">
        <label for="remark" class="form-label">Remark</label>
        <textarea class="form-control" id="remark" name="remark" rows="3">{{ old('remark') }}</textarea>
        @error('remark')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="service_code" class="form-label">Service Code</label>
        <input type="text" class="form-control @error('service_code')is-invalid @enderror" id="service_code" name="service_code" value="{{ old('service_code') }}" placeholder="Service Code" required autofocus>
        @error('service_code')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="hardware_type_id" class="form-label">Type</label>
        <select class="js-example-basic-single form-control @error('hardware_type_id')is-invalid @enderror" name="hardware_type_id">
          @foreach($types as $type)
            <option value="{{ $type->id }}" {{ old('hardware_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
          @endforeach
        </select>
        @error('hardware_type_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    
      <div class="mb-3">
        <label for="hardware_model_id" class="form-label">Model</label>
        <select class="js-example-basic-single form-control @error('hardware_model_id')is-invalid @enderror" name="hardware_model_id">
          @foreach($models as $model)
            <option value="{{ $model->id }}" {{ old('hardware_model_id') == $model->id ? 'selected' : '' }}>{{ $model->name }}</option>
          @endforeach
        </select>
        @error('hardware_model_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    
      <div class="mb-3">
        <label for="processor_id" class="form-label">Processor</label>
        <select class="js-example-basic-single form-control @error('processor_id')is-invalid @enderror" name="processor_id">
          @foreach($processors as $processor)
            <option value="{{ $processor->id }}" {{ old('processor_id') == $processor->id ? 'selected' : '' }}>{{ $processor->model_no }}</option>
          @endforeach
        </select>
        @error('processor_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="memory_id" class="form-label">Memory</label>
        <select class="js-example-basic-single form-control @error('memory_id')is-invalid @enderror" name="memory_id">
          @foreach($memories as $memory)
            <option value="{{ $memory->id }}" {{ old('memory_id') == $memory->id ? 'selected' : '' }}>{{ $memory->capacity }}</option>
          @endforeach
        </select>
        @error('memory_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    
      <div class="mb-3">
        <label for="graphic_card_id" class="form-label">Graphic Card</label>
        <select class="js-example-basic-single form-control @error('graphic_card_id')is-invalid @enderror" name="graphic_card_id">
          @foreach($graphicCards as $graphicCard)
            <option value="{{ $graphicCard->id }}" {{ old('graphic_card_id') == $graphicCard->id ? 'selected' : '' }}>{{ $graphicCard->model }}</option>
          @endforeach
        </select>
        @error('graphic_card_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    
      <div class="mb-3">
        <label for="storage_id" class="form-label">Storage</label>
        <select class="js-example-basic-single form-control @error('storage_id')is-invalid @enderror" name="storage_id">
          @foreach($storages as $storage)
            <option value="{{ $storage->id }}" {{ old('storage_id') == $storage->id ? 'selected' : '' }}>{{ $storage->capacity }}</option>
          @endforeach
        </select>
        @error('storage_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="computer_name" class="form-label">Computer Name</label>
        <input type="text" class="form-control @error('computer_name')is-invalid @enderror" id="computer_name" name="computer_name" value="{{ old('computer_name') }}" placeholder="Computer Name" required autofocus>
        @error('computer_name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="reset" class="btn btn-warning">Reset</button>
      <a href="/hardware" class="btn btn-info ms-auto">Back</a>
    </div>
      </form>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ URL::asset('js/hardware/script.js') }}"></script>
  <script src="{{ URL::asset('js/global/script.js') }}"></script>
@endpush