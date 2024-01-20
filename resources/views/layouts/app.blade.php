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
                                @if(Auth::user()->role==4)
                                    @php
                                        $teacher = DB::table('teachers')->where('teacher_user_id',Auth::user()->id)->select('teacher_id')->first();
                                    @endphp
                                    <span>T. ID</span>
                                    <span>
                                        <span class="badge badge-pill badge-dark">{{ $teacher->teacher_id }}</span>
                                    </span>
                                @else
                                <span>EMP. ID</span>
                                <span>
                                    <span class="badge badge-pill badge-dark">{{ Auth::user()->id+100000 }}</span>
                                </span>
                                @endif

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

            <div data-simplebar class="h-100" style="background: rgb(34, 33, 33)">

                <div class="navbar-brand-box">
                    <a href="{{ route('home') }}" class="logo text-center">
                        {{-- <i class="mdi mdi-alpha-x-circle"></i> --}}
                        @php
                            $logo = DB::table('logos')->where('logo_delete',0)->where('logo_for','Admin')->where('logo_position','admin_top')->where('logo_status','Active')->first();
                        @endphp
                        @if ($logo)
                        @if($logo->logo_type=='text')
                            <span>
                                {{ $logo->logo_image }}
                            </span>
                            @else
                                <img src="{{ asset($logo->logo_image) }}" alt="">
                            @endif
                        @else

                        @endif



                    </a><br>
                    <span class="text-white">
                        {{ Auth::user()->role==1?'Admin':(Auth::user()->role==2?'Supervisor':(Auth::user()->role==3?'Editor':(Auth::user()->role==4?'Teacher':'Student'))) }}
                    </span>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title text-danger">Admin</li>

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

                        {{-- Spak It Solution --}}
                        <li class="menu-title  text-danger">PMIS</li>
                        {{-- <li>
                            <a href="{{ route('spark_contact') }}" class="waves-effect">
                                <i class="fa fa-address-book"></i><span>Contact Information</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('spark_main_slider') }}" class="waves-effect">
                                <i class="fa fa-file-image"></i><span>Main Slider</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="feather-map"></i><span>Maps</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="maps-google.html">Google Maps</a></li>
                                <li><a href="maps-vector.html">Vector Maps</a></li>
                            </ul>
                        </li> --}}
                        @if (Auth::user()->role==1)
                        <li>
                            {{-- <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="mdi mdi-home"></i><span>Tea</span></a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('spark_contact') }}" class="waves-effect"><i class="fa fa-address-book"></i><span>Contact Information</span></a>
                                <li><a href="{{ route('spark_main_slider') }}" class="waves-effect"><i class="fa fa-file-image"></i><span>Main Slider</span></a>
                                </li>
                            </ul> --}}

                            <a href="{{ route('teachers') }}" class="waves-effect">
                                <i class="mdi mdi-cowboy"></i><span>Teachers</span>
                            </a>
                        </li>
                        <li>

                            <a href="{{ route('students') }}" class="waves-effect">
                                <i class="mdi mdi-account-multiple-outline"></i><span>Students</span>
                            </a>
                        </li>
                        <li><a href="{{ route('supervisor_choice_request') }}" class="waves-effect"><i class="mdi mdi-file-account"></i><span>Sup. Choice Requests</span></a></li>
                        <li><a href="{{ route('view_result_admin') }}" class="waves-effect"><i class="mdi mdi-gas-station-outline"></i><span>View Results</span></a></li>
                        @endif
                        @if (Auth::user()->role==4)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-cog"></i><span>Defense</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('initial_phase') }}">Initial Phase</a></li>
                                    <li><a href="{{ route('title_defense') }}">Title Defense</a></li>
                                    <li><a href="{{ route('pre_defense') }}">Pre Defense</a></li>
                                    <li><a href="{{ route('final_defense') }}">Final Defense</a></li>
                                    <li><a href="{{ route('view_result') }}">View Results</a></li>

                                    {{-- <li><a href="{{ route('logo') }}" class="waves-effect"><span>Web Images</span></a></li>  --}}
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->role==5)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-cog"></i><span>Defense</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('supervisor_choice') }}">Supervisor Choice</a></li>
                                    @php
                                        $defense = DB::table('phases')
                                            ->where('phase_student_id', Auth::user()->id)
                                            ->first();
                                    @endphp
                                    @if ($defense)
                                    <li><a href="{{ route('attemp_title_defense') }}">Attemp Title Defense</a></li>
                                    <li><a href="{{ route('attemp_pre_defense') }}">Attemp Pre Defense</a></li>
                                    <li><a href="{{ route('attemp_final_defense') }}">Attemp Final Defense</a></li>
                                    @endif


                                    {{-- <li><a href="{{ route('logo') }}" class="waves-effect"><span>Web Images</span></a></li>  --}}
                                </ul>
                            </li>

                        @endif

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
                        {{-- <div class="col-sm-6">
                            @php
                            $logo = DB::table('logos')->where('logo_delete',0)->where('logo_for','Admin')->where('logo_position','admin_bottom')->where('logo_status','Active')->first();
                            @endphp
                            {{ date('Y') }} ©
                            @if ($logo && $logo->logo_type=='text')
                               all site reserved by {{ $logo->logo_image }}
                            @elseif($logo && $logo->logo_type=='image')
                            <img src="{{ asset($logo->logo_image) }}" height="60px" width="200px" alt="">
                            @endif
                        </div> --}}
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                {{-- Design & Develop by MD. MUTASIM NAIB --}}
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
