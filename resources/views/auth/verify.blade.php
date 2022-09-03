

@extends('layouts.app')
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
@section('content')
    <div class="container" id="resend">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card rounded-md shadow-md">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email or spam for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                            </div>
                        </div>

                        <div class="row mb-3">
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" id="resendEmailVerification" disabled="disabled" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                                <span id="timer">
                                    <span id="time">60 </span> Seconds
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        var counter = 60;

        var interval = setInterval(function() {
            counter--;
            // Display 'counter' wherever you want to display it.
            if (counter <= 0) {
                    clearInterval(interval);
                    $('#time').text(counter);
                    $('#resendEmailVerification').prop('disabled', false);
                    $('#timer').hide();
                    return;
            }else{
                    $('#time').text(counter);
                    $('#resendEmailVerification').prop('disabled', true);
                    console.log("Timer --> " + counter);
            }
        }, 1000)});
    </script>
@endsection
