@extends('layouts.vendor-dashboard-layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>car</th>
                            <th>Image</th>
                            <th>Rent date</th>
                            <th>Number of day</th>
                            <th>User</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->car->model }}</td>
                                <td>
                                    @if ($item->car->image)
                                        <div
                                            style="background-image:url('{{ asset('storage/' . $item->car->image->path) }}');
                                        widht:50px; height:50px; background-position:center; background-size:cover;">

                                        </div>
                                    @endif
                                </td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->number_of_days }}</td>
                                <td>{{ $item->user->name }} ( {{ $item->user->email }})</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
