<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Home Page</title>
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
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left" >
                                    <img src="{{ asset('public/main/assets/images/welcome.gif') }}" style="height: 100%;width:100%" alt="">
                                </div>

                                <div class="col-lg-7 text-center">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            @php
                                                $logo = DB::table('logos')
                                                    ->where('logo_delete', 0)
                                                    ->where('logo_for', 'Admin')
                                                    ->where('logo_position', 'admin_top')
                                                    ->where('logo_status', 'Active')
                                                    ->first();
                                            @endphp
                                            @if ($logo)
                                                @if ($logo->logo_type == 'text')
                                                    <span>
                                                        {{ $logo->logo_image }}
                                                    </span>
                                                @else
                                                    <img src="{{ asset($logo->logo_image) }}" alt="">
                                                @endif
                                            @else
                                            @endif
                                        </div>
                                        <h1 class="h5 mb-1" style="font-size: 30px;font-weight:700">Hello User ! Welcome To PMIS</h1>
                                        <p class="text-muted mb-4">To login PMIS Click Here</p>
                                        
                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <p class="text-muted mb-2"><a
                                                        href="{{ route('login') }}"
                                                        class="text-white font-weight-medium ml-1 btn btn-primary">LogIn</a></p>
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
    <script src="{{ asset('public/main/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/main/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/main/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('public/main/assets/js/waves.js') }}"></script>
    <script src="{{ asset('public/main/assets/js/simplebar.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('public/main/assets/js/theme.js') }}"></script>
    <script src="{{ asset('public/main/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        @if (Session::get('invalid_admin_login'))
            $('#sa-error').ready(function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Invalid user email or password',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
            });
        @elseif (Session::get('status'))

            $('#sa-error').ready(function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'User has been bannded.Please contact your administration',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
            });
        @elseif (Session::get('delete'))

            $('#sa-error').ready(function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'User has been deleted.Please contact your administration',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                })
            });
        @endif
    </script>

    @if (Session::get('admin_logout_success'))
        <script>
            $('#sa-custom-position').ready(function() {
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
