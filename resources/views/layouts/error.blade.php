<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Xacton - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('public/main/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

    @yield('content')
    <!-- end page -->

    <!-- jQuery  -->
    <script src="{{ asset('public/main/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/metismenu.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/waves.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/simplebar.min.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('public/main/assets/js/theme.js')}}"></script>

</body>

</html>