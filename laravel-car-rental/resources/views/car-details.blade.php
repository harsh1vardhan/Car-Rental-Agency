@extends('layouts.website-layout')


@section('content')
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Rent a cart here</h1>
                <p class="lead fw-normal text-white-50 mb-0">Most beautiful cars for your journey</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
                style="border: 1px solid #f2f2f2; padding:1rem">

                @if (Session::get('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif


                <div style="display: flex; flex-direction:column; gap:2rem">

                    <div>
                        <div
                            style="background-image:url('{{ asset('storage/' . $car->image->path) }}');
                        widht:300px; height:200px; background-position:center; background-size:cover;">

                        </div>
                    </div>


                    <div class="model">Model: {{ $car->model }}
                    </div>
                    <div class="model">Number: {{ $car->number }}
                    </div>
                    <div class="model">Seating capacity: {{ $car->seating_capacity }}
                    </div>
                    <div class="model">Rent per day amount: {{ $car->rent_per_day }}$
                    </div>
                </div>




                <form style="border: 1px solid #f2f2f2; padding:1rem; display:flex; flex-direction:column; gap:1rem"
                    action="{{ route('placeOrder') }}" method="POST">
                    @csrf
                    @method('post')

                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <div class="form-group">
                        <label for="">Number of day you want</label>
                        <input type="text" class="form-control" name="number_of_days">
                    </div>

                    <div class="form-group">
                        <label for="">Rent start date</label>
                        <input type="date" class="form-control" name="start_date">
                    </div>


                    <button type="submit" class="btn btn-primary">Rent the cart</button>
                </form>
            </div>
        </div>
    </section>
@endsection
