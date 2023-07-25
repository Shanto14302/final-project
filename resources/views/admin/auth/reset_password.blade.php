<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/main/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('public/main/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
 
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-x-circle"></i> <b>XACTON</b>
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Reset Password</h1>
                                        <p class="text-muted mb-4">Enter your token , email address and new password to reset password. </p>
                                        <form action="" id="new_password_form" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail">Token</label>
                                                <input type="test" name="token" class="form-control form-control-user @error('token') is-invalid @enderror" value="{{ old('token') }}" placeholder="Token">
                                                <span class="text-danger" id="token"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail">Email Address</label>
                                                <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email Address">
                                                <span class="text-danger" id="email"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail">New Password</label>
                                                <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password">
                                                <span class="text-danger" id="password"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail">Re-type Password</label>
                                                <input type="password" name="rpassword" class="form-control form-control-user @error('rpassword') is-invalid @enderror" value="{{ old('rpassword') }}" placeholder="Password again">
                                                <span class="text-danger" id="rpassword"></span>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Change Password </button>
                                            
                                        </form>

                                        <div class="row mt-5">
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Already have account?  <a href="{{ route('login') }}" class="text-muted font-weight-medium ml-1"><b>Sign In</b></a></p>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="{{ asset('public/main/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/metismenu.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/waves.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/simplebar.min.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('public/main/assets/js/theme.js')}}"></script>
    <script src="{{ asset('public/main/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('resources/js/admin/reset_request.js') }}"></script>
    <script>
        $('#new_password_form').on("submit",function(e){
        e.preventDefault();
        $.ajax({
            type : 'POST',
            url : '{{ route("reset_password_confirm") }}',
            dataType : "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data : $('#new_password_form').serialize(),
            success : function(data){
                if(data.message==1){
                    Swal.fire({
                        type: 'success',
                        title: '',
                        text: 'Password changed successfully',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    }).then(()=>{
                        window.location.replace("http://localhost/dream/admin/");
                    })
                }else{
                    Swal.fire({
                    type: 'error',
                    title: 'Opps !',
                    text: 'Something went wrong',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
                }
            },
            error : function(err){

                if(err.responseJSON.token){
                    document.getElementById('token').innerHTML=err.responseJSON.token;
                    document.getElementById('password').innerHTML='';
                    document.getElementById('rpassword').innerHTML='';
                    document.getElementById('email').innerHTML='';
                }else{
                    document.getElementById('token').innerHTML='';
                }
                if(err.responseJSON.errors.email){
                    document.getElementById('email').innerHTML=err.responseJSON.errors.email;
                }else{
                    document.getElementById('email').innerHTML='';
                }
                if(err.responseJSON.errors.rpassword){
                    document.getElementById('rpassword').innerHTML=err.responseJSON.errors.rpassword;
                }else{
                    document.getElementById('rpassword').innerHTML='';
                }
                if(err.responseJSON.errors.password){
                    document.getElementById('password').innerHTML=err.responseJSON.errors.password;
                }else{
                    document.getElementById('password').innerHTML='';
                }


            }
        })
    });
    </script>
    <script>
        @if (Session::get('pending_forgot_password_request'))
            $('#sa-error').ready(function () {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You have a pending request . You need permission from Admin to reset your password . For further information please contact with your Admin',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
            });
        @elseif (Session::get('send_forgot_password_request'))
            $('#sa-error').ready(function () {
                Swal.fire({
                    type: 'success',
                    title: 'Welcome !',
                    text: 'Reset request successfully sent to Admin . You need permission from Admin to reset your password . For further information please contact with your Admin',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
            }); 
        @elseif (Session::get('send_forgot_password_mail'))
            $('#sa-error').ready(function () {
                Swal.fire({
                    type: 'success',
                    title: 'Welcome !',
                    text: 'Reset password link successfully sent to your email . Please check your email ',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
            }); 
        @elseif (Session::get('send_forgot_password_request'))
            $('#sa-error').ready(function () {
                Swal.fire({
                    type: 'error',
                    title: 'Opps !',
                    text: 'Something went wrong ! please try again after sometimes',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
            }); 
        @endif
        
    </script>

@if (Session::get('admin_logout_success'))
<script>
    $('#sa-custom-position').ready(function () {
        Swal.fire({
            position: 'top-mid',
            type: 'success',
            title: 'You have successfully logged out',
            showConfirmButton: false,
            timer: 1500
        })
    });
</script>
@endif
    {{-- <script src="{{ asset('public/main/assets/pages/sweet-alert-demo.js')}}"></script> --}}
    
</body>

</html>