<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.shared/title-meta', ['title' => "Register & Signup"])
    @include('layouts.shared/head-css', ["mode" => $mode ?? '', "demo" => $demo ?? ''])

</head>
<style>
    body{
        background-image: url('/assets/images/background.jpg') !important;
        background-size: cover;
    }
    .card{
        background-color: rgb(255, 255, 255,0.4) !important ;
    }
    label{color: black}
   
    input.form-control, .form-select {
    background: #E6E7E9;
    padding: 20px 15px;
    border: 1px solid #C3C4C8;
    border-radius: 5px;
}
.form-control {
    position: relative;
    font-size: 16px;
    height: auto;}
    .btn {
    /* background: url(../images/login-btn.png) no-repeat; */
    width: 208px;
    margin: 30px auto 0;
    border: 0;
}
@media only screen and (max-width: 500px) {
    .logo-lg img{
        height: 50px;
    }
 }
</style>
<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-3 mb-5">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card ">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="#" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{asset('images/main-logo.png')}}" alt="" height="85">
                                        </span>
                                    </a>

                                    <a href="#" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{asset('images/main-logo.png')}}" alt="" height="22">
                                        </span>
                                    </a>
                                </div>
                                {{-- <p class="text-muted mb-4 mt-3">Don't have an account? Create your account</p> --}}
                            </div>

                            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>
                            <br>@endif
                            @if(session('success'))<div class=" alert alert-success">{{ session('success') }}
                            </div>
                            <br>@endif

                            @if (sizeof($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif

                            <form method="POST" action="{{ route('register') }}" >
                                @csrf

                                <div class="mb-3">
                                    {{-- <label for="usename" class="form-label">Username</label> --}}
                                    <input class="form-control" type="text" name="username" id="usrname" placeholder="Enter Your Username" required>
                                </div>
                                <div class="mb-3">
                                    {{-- <label for="fullname" class="form-label">Name</label> --}}
                                    <input class="form-control" type="text" name="name" id="fullname" placeholder="Enter your Name" required>
                                </div>
                                <div class="mb-3">
                                    {{-- <label for="emailaddress" class="form-label">Email address</label> --}}
                                    <input class="form-control" type="email" name="email" id="emailaddress" required placeholder="Enter your email" autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    {{-- <label for="division" class="form-label">Division</label> --}}
                                    <input class="form-control" type="text" name="division" id="division" required placeholder="Enter Your Division" autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    {{-- <label for="phone" class="form-label">Phone</label> --}}
                                    <input class="form-control" type="tel" name="phone" id="phone" required placeholder="Enter Your Phone" autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    {{-- <label for="address" class="form-label">Address</label> --}}
                                    <input class="form-control" type="text" name="address" id="address" required placeholder="Enter Your Address" autocomplete="off">
                                </div>

                               


                                <div class="mb-3">
                                    {{-- <label for="user_type" class="form-label" >select user type</label> --}}
                                    <select name="user_type" id="user_type" class="form-select" onchange="selectUser()" required>
                                        <option value="" hidden>Select user type</option>
                                        <option value="dbkl">DBKL</option>
                                        <option value="vendor">Vendor</option>
                                    </select>
                                </div>

                                <div class="mb-3" id="dbkl_user">
                                    {{-- <label for="dbkl_user_type" class="form-label" id="">DBKL type</label> --}}
                                    <select name="dbkl_user_type" id="dbkl_user_type" class="form-select">
                                        <option value="" hidden>Select DBKL type </option>
                                        <option value=" exective"> Exective</option>
                                        <option value="technical">Technical</option>
                                    </select>
                                </div>

                                <div class="mb-3" id="vendor_user">
                                    {{-- <label for="vendor_user_type" class="form-label" id="">Vendor type</label> --}}
                                    <select name="vendor_user_type" id="vendor_user_type" class="form-select" >
                                        <option value="" hidden>Select Vendor type</option>
                                        <option value="Tenaga National Berhad"> Tenaga National Berhad</option>
                                        <option value="Telekom Malaysia Berhad">Telekom Malaysia Berhad</option>
                                        <option value="Air Selangor Sdn Bhd">Air Selangor Sdn Bhd</option>
                                    </select>
                                </div>

                                

                                <div class="mb-3">
                                    {{-- <label for="password" class="form-label">Password</label> --}}
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    {{-- <label for="password_confirmation" class="form-label">Password confirmation</label> --}}
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Enter your password confirmation">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                        <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                    </div>
                                </div> --}}
                                <div class="text-center d-grid">
                                    <button class="btn btn-success" type="submit"> Sign Up </button>
                                </div>

                            </form>


                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Already have account? <a href="{{route('second', ['auth', 'login'])}}" class="text-white ms-1"><b>Sign In</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

   

    @include('layouts.shared/footer-script')
</body>

</html>


<script>

$(document).ready(function(){
        $("#vendor_user").hide();
        $("#dbkl_user").hide();
    })

    function selectUser(){
       let val =   document.querySelector('#user_type').value;
        if(val === 'dbkl'){
            $("#dbkl_user").show();
            $("#vendor_user").hide();
            $("#dbkl_user_type").attr('required',true);
            $("#vendor_user_type").attr('required',false);
      
        }else if(val === 'vendor'){
            $("#vendor_user").show();
            $("#dbkl_user").hide();
            $("#vendor_user_type").attr('required',true);
            $("#dbkl_user_type").attr('required',false);
            
        }
    }

  

</script>