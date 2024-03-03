@extends('layouts.website-layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Agencies Account</h2>
                <div class="text-center mb-5 text-dark">Login as agency</div>
                <div class="card my-5">

                    @if (Session::get('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::get('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    <form class="card-body cardbody-color p-lg-5" method="POST"
                        action="{{ route('vendors.handleLogin') }}">

                        @method('post')
                        @csrf
                        <div class="text-center">
                            <img src="data:image/jpeg;base64,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"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="email-agencies@exemple.com" value="{{ old('email') }}">

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Mot de passe">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Me connecter à
                                ma boutique</button>
                        </div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Pas de compte ? <a
                                href="{{ route('vendors.login') }}" class="text-dark fw-bold"> Creer mon compte</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
