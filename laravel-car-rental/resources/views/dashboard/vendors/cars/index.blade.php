@extends('layouts.vendor-dashboard-layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">My cars</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">List of my cars</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header" style="display: flex; justify-content:flex-end">

                <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm">Add a car</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Model</th>
                            <th>Number</th>
                            <th>Seating Capacity</th>
                            <th>Rent Per Day</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($articles as $article)
                            <tr>
                                <td>


                                    @if ($article->image)
                                        <div
                                            style="background-image:url('{{ asset('storage/' . $article->image->path) }}');
                                            widht:50px; height:50px; background-position:center; background-size:cover;">

                                        </div>
                                    @endif
                                </td>
                                <td>{{ $article->model }}</td>

                                <td>{{ $article->number }}</td>
                                <td>{{ $article->seating_capacity }}</td>
                                <td>{{ $article->rent_per_day }} $</td>
                                <td></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
