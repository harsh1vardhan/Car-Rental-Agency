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
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">


                @foreach ($articles as $article)
                    <x-product-item :article="$article" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
