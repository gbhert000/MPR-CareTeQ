@extends('layouts.app')
{{-- <script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery-1.11.1.js') }}"></script>
<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/careteq.js') }}"></script> --}}

<!-- Select2 CSS -->
{{-- <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

<script src="{{ asset('js/jquery-3.6.0/js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min/js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('js/select2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.min.css') }}">
<script type="text/javascript" src="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.min.js') }}"></script> --}}



    <style>
         .error {
            color: #ff0000;
            background-color: #acf;
          }
     </style>

@section('content')

    <div class="container">
        <div class="container mt-5">
            <div class="row">

                {{-- GRID --}}
                <div class="col-lg-7 col-sm-7 col-md-6 m-auto ">
                    <div class="text-center display-2 ">REGISTER</div>

                    {{-- CARD --}}
                    <div class="card border-1 shadow rounded-lg">
                        <div class="card-body " style="100px">
                            {{-- insert logo image here --}}

                            {{-- REGISTER FORM --}}
                            <form method="POST" class="py-2" action="{{ route('register') }}" id="register_form" name="register_form" enctype="multipart/form-data">
                                @csrf
                                <div id='result'></div>
                                {{-- FIRST NAME, LAST NAME, MIDDLE NAME --}}
                                <div class="mb-2 fs-4 text-center">Personal Information</div>

                                <div class="row">

                                    {{-- FIRST NAME --}}
                                    <div class="col">
                                        <div class="mb-3">
                                            <input type="hidden" name="user_role" id="user_role" value="0">
                                            <label for="firstname" class="form-label"><b style="color: red">*</b>
                                                {{ __('First Name') }} <span class="firstname-validation validation-error"></span> </label>
                                            <input id="firstname" name="firstname" type="text"
                                                class="form-control  @error('fname') is-invalid @enderror autofocus "
                                                value="{{ old('firstname') }}" onblur="validate()">

                                        </div>
                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- MIDDLE NAME --}}
                                    <div class="col">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label for="middlename" class="form-label">{{ __('Middle Name') }}</label>
                                                <input id="middlename" name="middlename" type="text"
                                                    class="form-control autofocus" value="{{ old('middlename') }}">
                                            </div>

                                        </div>
                                    </div>

                                    {{-- LAST NAME --}}
                                    <div class="col">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"><b style="color: red">*</b>
                                                    {{ __('Last Name') }}</label>
                                                <input id="lastname" name="lastname" type="text"
                                                    class="form-control  @error('lastname') is-invalid @enderror autofocus"
                                                    value="{{ old('lastname') }}" onblur="validate()">
                                            </div>
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label for="suffix" class="form-label">{{ __('Ext.') }}</label>
                                            <input id="suffix" name="suffix" type="text" 
                                                class="form-control  @error('suffix') is-invalid @enderror autofocus"
                                                value="{{ old('suffix') }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-2 fs-4 text-center">Account Details</div>

                                <div class="row">

                                    <div class="mb-3">
                                        <label for="userName" class="form-label"><b style="color: red">*</b>
                                            {{ __('User Name') }}</label>
                                        <input id="userName" type="text"
                                            class="form-control error mb-3" name="userName"
                                           required autocomplete="userName">
                                            <span style="color: #ff0000" id="emailError"></span>

                                        <label for="hospitalName"> Hospital Name</label>
                                        <select name="hospitalName" id="hospitalName" class="form-control">
                                            @foreach ($hospitals as $hospital)
                                                <option value="{{$hospital->hospitalCode}}">{{$hospital->hospitalName}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="mb-3">
                                        
                                        <label for="email" class="form-label"><b style="color: red">*</b>
                                            {{ __('E-Mail') }}</label>
                                        <input id="email" type="email"
                                            class="form-control error" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                            <span style="color: #ff0000" id="emailError"></span>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    {{-- PASSWORD --}}
                                    <div class="col">
                                        <label for="password" class="form-label"><b style="color: red">*</b>
                                            {{ __('Password') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                id="password" name="password" onkeyup="return validatepass()">
                                            <button class="btn btn-outline-dark" type="button" id="showPassword" name="showPassword"><i
                                                    class="fa fa-solid fa-eye"></i></button>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="errors">
                                            <ul>
                                                <li id="upper"> At least one uppercase</li>
                                                <li id="lower"> At least one lowercase</li>
                                                <li id="special_char"> At least one special character or symbol</li>
                                                <li id="number"> At least one number</li>
                                                <li id="length"> At least 8 characters</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{-- PASSWORD CONFIRM --}}
                                <div class="row">

                                    <div class="col">
                                        <label for="password_confirmation" class="form-label"><b style="color: red">*</b>
                                            {{ __('Password Confirm') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation">
                                            <button class="btn btn-outline-dark" type="button" id="showConfirmPassword" name="showConfirmPassword"><i
                                                    class="fa fa-solid fa-eye"></i></button>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                                {{-- EMAIL --}}

                                
                        {{-- SUBMIT --}}
                        <div class="text-center d-flex items-center p-3">
                            <button type="submit" id="btnSignUp" name="btnSignUp" class="btn btn-secondary col-lg-12" disabled="disabled">Register</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $('#register_form').validate({
            errorClass: "error",
            rules: {

                email: {
                required: true,
                email: true,
                remote:'/validate-email'
                },
             },

             // Specify validation Error messages
            messages: {

                email: {
                required: "Please enter your email" ,
                remote:"Email already exist"
                },
             },
               submitHandler: function(form) {
              form.submit();
            }
          });
    </script>

    <script>

    </script>
@endsection
