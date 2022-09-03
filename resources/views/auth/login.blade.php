@extends('layouts.app')

@section('content')
    <!-- CSS -->

    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
{{-- <script src="{{ asset('js/careteq.js') }}"></script> --}}
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
                                            <label>{{ __('Username') }}<span class="text-danger">*</span></label>
                                            <div class="input-group">

                                                <input id="userName" type="text"
                                                    class="form-control @error('userName') is-invalid @enderror" name="userName"
                                                    value="{{ old('userName') }}" required autocomplete="userName" autofocus>

                                                @error('userName')
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
                                                <input type="password" class="form-control" id="password" name="password"
                                                    required>
                                                <button class="btn btn-outline-dark" type="button"
                                                    id="showPassword" name="showPassword"><i class="fa fa-solid fa-eye"></i></button>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                               
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
                                <img src="img/seal.png" alt="" id="seal">
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