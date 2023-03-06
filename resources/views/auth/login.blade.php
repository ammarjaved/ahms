<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.shared/title-meta', ['title' => "Log In"])
    @include('layouts.shared/head-css', ["mode" => $mode ?? '', "demo" => $demo ?? ''])

</head>



   
    <style>
        input#name,input#password{
            border: none;
            border-bottom:1px solid #d5d7e4;
            background-color: #ffff;
        }

        input#name:focus,input#password:focus{
            box-shadow: none;
            border-bottom:1px solid green;
        }
        .contai{
            background-image: url('/assets/images/img_bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
            padding: 0px;
            margin: 0px;
            overflow: hidden;
        }

        
    </style>
<body class="loading authentication-bg authentication-bg-pattern">

    <div class="contai">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-4 m-3 ">
            <div class="card border-0 col-md-10 mx-auto shadow-lg mt-5">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body mx-3 my-4">
                    <div class="row mb-3">
                        <img src="{{URL::asset('assets/images/main-logo.png')}}" height="60" width="80"/>
                    </div>
                    <h6 class="text-center mt-4"><strong> USER LOGIN</strong></h6>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        

                        
                        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>
                        <br>@endif

                        @if (sizeof($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="row mb-3 mt-4">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                            <div class="col-md-12 mx-auto">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror " name="name" value="{{ old('name') }}" required  autofocus placeholder="Enter your username">
                                {{-- <span class="mdi mdi-robot-angry"></span> --}}

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 ">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                            <div class="col-md-12 mx-auto">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-success rounded-0 form-control">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            <div class="row mt-3">
                        <div class="col-12 text-center">
                          <p class="text-white-50">Don't have an account? <a href="/register" class="text-white ms-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col --> 
            </div>
        </div>
    </div>
</div>

    @include('layouts.shared/footer-script')

</body>

</html>