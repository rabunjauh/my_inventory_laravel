{{-- @dd($assigns) --}}
@extends('layouts.main')

@section('container')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mb-5">{{ $title }}</h1>
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="4">Engineering</th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>Extension No</th>
                        </tr>
                        {{-- @if ($assigns->count())
                        @foreach ($assigns as $assign)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $assign->employee->name }}</td>
                          <td>{{ $assign->employee->position->name }}</td>
                          <td>{{ $assign->extension->no }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">There is no data available at the moment.</td>
                        </tr> 
                        @endif --}}
                    </table>
            </div>
        </div>
    </div>
@endsection