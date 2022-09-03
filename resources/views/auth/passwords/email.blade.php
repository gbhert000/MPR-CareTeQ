@extends('layouts.app')

@section('content')
    <div class="containter mt-5">
        <div class="row">
            <div class="col-lg-3 m-auto card border-1 shadow-lg p-5 rounded-md">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class=" mb-3 border-2">
                        <div class="mb-3">
                            <label for="email" class="form-label fs-5">{{ __('Forgot your password?') }}</label>
                            <div class="">
                                <p class="fst-italic fs-6 mt-2">Provide your email address and we will send you a link to reset you password</p>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="">
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
