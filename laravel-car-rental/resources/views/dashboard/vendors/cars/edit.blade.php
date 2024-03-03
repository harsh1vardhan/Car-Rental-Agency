@extends('layouts.vendor-dashboard-layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Update a car</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Add a new car</li>
        </ol>


        <div class="card my-4">
            <div class="card-header">Add form</div>
            <div class="card-body">


                @if (Session::get('error'))
                    <div class="text-danger">{{ Session::get('error') }}</div>
                @endif




                <form action="{{ route('cars.handleEdit', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @method('post')
                    @csrf


                    <div class="form-group mb-4">
                        <label for="">Model </label>
                        <input type="text" class="form-control" name="model" value="{{ $car->model }}">

                        @error('model')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group mb-4">
                        <label for="">Car Number</label>
                        <input type="number" class="form-control" name="number" value="{{ $car->number }}">

                        @error('number')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Car setting capacity</label>
                        <input type="number" class="form-control" name="seating_capacity"
                            value="{{ $car->seating_capacity }}">

                        @error('seating_capacity')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="">Rent per day</label>
                        <input type="number" class="form-control" name="rent_per_day" value="{{ $car->rent_per_day }}">

                        @error('rent_per_day')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div style="display: flex; justify-content:center;align-items:center">
                        <button type="submit" class="btn btn-primary">Update this car</button>

                    </div>


                </form>

            </div>
        </div>


    </div>
@endsection
