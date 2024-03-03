@extends('layouts.website-layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">RENT USER</h2>
                <div class="text-center mb-5 text-dark">Register as user</div>
                <div class="card my-5">

                    @if (Session::get('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    <form class="card-body cardbody-color p-lg-5" method="POST" action="{{ route('handleUserRegister') }}">

                        @method('post')
                        @csrf
                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Username"
                                value="{{ old('name') }}">

                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email@exemple.com" value="{{ old('email') }}">

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">create my
                                account</button>
                        </div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Have account? <a href="/login"
                                class="text-dark fw-bold"> Log in here</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
