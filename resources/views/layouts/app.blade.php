<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/main/assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{ asset('public/main/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/toastr.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    @livewireStyles

</head>

<body>
    @php
        use App\Models\Admin\AdminProfile;
        $profile =  AdminProfile::join('users','admin_profiles.profile_user_id','users.id')->where('profile_user_id',Auth::user()->id)->first();
        if($profile){
            $profile_info = $profile;
        }else{
            $profile_info = '';
        }
    @endphp

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">

                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-plus"></i> Create New
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                Application
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                Software
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                EMS System
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                CRM App
                            </a>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-none d-sm-inline-block ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="" src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                            <span class="d-none d-sm-inline-block ml-1">English</span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="assets/images/flags/spain.jpg" alt="user-image" class="mr-1" height="12">
                                <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="assets/images/flags/germany.jpg" alt="user-image" class="mr-1" height="12">
                                <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="assets/images/flags/italy.jpg" alt="user-image" class="mr-1" height="12">
                                <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="assets/images/flags/russia.jpg" alt="user-image" class="mr-1" height="12">
                                <span class="align-middle">Russian</span>
                            </a>
                        </div>
                    </div> --}}

                    <div class="dropdown d-inline-block" >
                        <button type="button"  class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="width: 100px">
                            <i class="mdi mdi-bell"></i>
                            <livewire:all-notification />
                            
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                @if (Auth::user()->role==1)
                                <a href="{{ route('reset_request') }}" class="text-reset notification-item">
                                    <div class="media">
                                        <div class="avatar-xs mr-3">
                                            <span class="avatar-title bg-success rounded-circle">
                                                <i class="fas fa-key"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">Password Reset Request</h6>
                                            {{-- <p class="font-size-12 mb-1">You have new follower on Instagram</p> --}}
                                            <livewire:notification />
                                            
                                        </div>
                                        <script>
                                            // setInterval(function(){ 
                                            //     var n1 = $('#pn');
                                            //     alert(n1)
                                            // }, 5000);
                                        </script>
                                    </div>
                                </a>
                                @endif
                                
                                
                            </div>
                            {{-- <div class="p-2 border-top">
                                <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-down-circle mr-1"></i> Load More..
                                </a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ isset($profile->profile_user_image) ? asset($profile->profile_user_image) : '' }}"
                                alt="Header Avatar">
                            <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="">
                                <span>EMP. ID</span>
                                <span>
                                    <span class="badge badge-pill badge-dark">{{ Auth::user()->id+100000 }}</span>
                                </span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{ route('admin_profile') }}">
                                <span>My Profile</span>
                            </a>
                            {{-- <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Settings
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                <span>Lock Account</span>
                            </a> --}}
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{ route('admin_logout') }}">
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a href="{{ route('home') }}" class="logo text-center">
                        {{-- <i class="mdi mdi-alpha-x-circle"></i>
                        <span>
                            Xacton
                        </span> --}}
                        <img src="{{ asset('public/logo.jpg') }}" height="60px" width="200px" alt="">
                    </a><br>
                    <span class="text-white">
                        {{ Auth::user()->role==1?'Admin':(Auth::user()->role==2?'Supervisor':(Auth::user()->role==3?'Editor':'Customer')) }}
                    </span>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="{{ route('home') }}" class="waves-effect">
                                <i class="feather-airplay"></i><span>Dashboard</span>
                            </a>
                        </li>

                        @if (Auth::user()->role==1)
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-cog"></i><span>Control Panel</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('view_users') }}">View Users</a></li>
                                <li><a href="{{ route('reset_request') }}" class="waves-effect"><span>Reset Requests</span></a></li> 
                                <li><a href="{{ route('logo') }}" class="waves-effect"><span>Web Images</span></a></li> 
                            </ul>
                        </li>
                        @endif
                        

                        <li class="menu-title">More</li>
                        
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="feather-map"></i><span>Maps</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="maps-google.html">Google Maps</a></li>
                                <li><a href="maps-vector.html">Vector Maps</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-share-variant"></i><span>Multi Level</span></a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 1.1</a></li>
                                <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="javascript: void(0);">Level 2.1</a></li>
                                        <li><a href="javascript: void(0);">Level 2.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            {{ date('Y') }} © Xacton.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by MD. MUTASIM NAIB
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="{{ asset('public/main/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/metismenu.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/waves.js')}}"></script>
    <script src="{{ asset('public/main/assets/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('public/main/toastr.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    @yield('js')
    <!-- Morris Js-->
    <script src="{{ asset('public/main/plugins/morris-js/morris.min.js')}}"></script>
    <!-- Raphael Js-->
    <script src="{{ asset('public/main/plugins/raphael/raphael.min.js')}}"></script>

    <!-- Morris Custom Js-->
    <script src="{{ asset('public/main/assets/pages/dashboard-demo.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('public/main/assets/js/theme.js')}}"></script>

    <script src="{{ asset('public/main/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    
    @if (Session::get('admin_login_success'))
    <script>
        $(document).ready(function(){

            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
            toastr["success"]("Logged in sucessful . Welcome to dreams !")
        });
    </script>
    @endif

    
    @livewireScripts
</body>

</html>