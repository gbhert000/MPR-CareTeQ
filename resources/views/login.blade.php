@extends('layouts.guest')

@section('content')
    <!-- CSS -->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3">Login Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="{{ route('login') }}" method="POST" class="row g-4">
                                        @csrf
                                        {{-- Email --}}
                                        <div class="col-12">
                                            <label>{{ __('Email Address') }}<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="col-12">
                                            <label>{{ __('Password') }}<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-unlock-alt"></i></div>
                                                <input type="password" class="form-control" id="password" name="password" required>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="remember" id="exampleCheck1" name="remember">
                                                <label class="form-check-label" for="exampleCheck1">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">


                                            @if (Route::has('password.request'))
                                                <a class=" float-end text-primary" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif

                                        </div>

                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-secondary px-4 float-start mt-4 col-lg-12">{{ __('Login') }}</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 div-img text-white text-center pt-5">
                                    <i class="bi bi-bootstrap"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-end text-secondary mt-3">© One Document Corporation</p>
                </div>
            </div>
        </div>
    </div>


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@endsection
