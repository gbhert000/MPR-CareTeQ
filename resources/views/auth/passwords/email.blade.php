@extends('layouts.app')

@section('content')
    <div class="containter mt-5">
        <div class="row">
            <div class="col-lg-3 m-auto card border-1 shadow-lg p-4 rounded-md">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class=" mb-3 border-2 p-2">
                        <div class="mb-3">
                            <label for="userName" class="form-label fs-5">{{ __('Forgot your password?') }}</label>
                            <div class="">
                                <p class="fst-italic fs-6 mt-2">
                                    Kindly provide your Username or Email Address. We will send you an email with a link to reset your password.
                                </p>
                            </div>
                            <input id="userName" type="text" class="form-control @error('userName') is-invalid @enderror"
                                name="userName" value="{{ old('userName') }}" required autocomplete="userName" autofocus>

                            @error('userName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
