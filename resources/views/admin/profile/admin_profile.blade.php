@extends('layouts.app')

@section('title')
    Admin Profile
@endsection

@section('css')
    <link href="{{ asset('public/main/plugins/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .lebelcolor {
            color: #101418 !important;
            font-weight: 800;
            font-size: 14px;
        }
    </style>
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">User Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Xacton</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        @if ($profile_info)
        <div class="row">

            <div class="col-lg-4">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Basic Info</h4>
                        <h4 class="card-title text-right mr-3">
                            @if (Auth::user()->edit_basic==1 || Auth::user()->id==1)
                            <i data-toggle="tooltip" data-placement="bottom" title="Edit basic info." class="fas fa-pen-square" id="trigger_user_basic_edit" style="font-size:21px;cursor:pointer"></i>
                            @else
                                <span class="badge badge-danger">No permission to edit</span>
                            @endif
                        </h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for=""><span class="lebelcolor">Name</span></label>
                            </div>
                            <div class="col-lg-8">
                                <span for="">{{ $profile_info->name }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="" class="lebelcolor">Email</label>
                            </div>
                            <div class="col-lg-8">
                                <label for="">{{ $profile_info->email }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="" class="lebelcolor">Phone</label>
                            </div>
                            <div class="col-lg-8">
                                <label for="">{{ $profile_info->phone }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="" class="lebelcolor">My role</label>
                            </div>
                            <div class="col-lg-8">
                                <label for="">{{ $profile_info->role==1? 'Admin' : ($profile_info->role==2 ? 'Supervisor' : ($profile_info->role==2 ? 'Editor' : ($profile_info->role==4 ? 'Customer' :''))) }}</label>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->edit_basic==1 || Auth::user()->id==1)
                        <div class="card-body" id="user_basic_edit" style="display:none">
                            <form action="" id="update_basic_info_form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="" class="lebelcolor">Name</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $profile_info->name }}" name="user_name">
                                        <label for=""></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="" class="lebelcolor">Email</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $profile_info->email }}" name="user_email">
                                        <label for=""></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="" class="lebelcolor">Phone</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{ $profile_info->phone }}" name="user_phone">
                                        <label for=""></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" id="update_basic_info_button" class="btn btn-info form-control">Update Basic Info</button>
                                    </div>
                                </div>
                                
                            
                            </form>
                        </div>
                    @else
                        
                    @endif
                    
                </div>
            </div> <!-- end col -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Additional Info</h4>
                        <h4 class="card-title text-right mr-3">
                            @if (Auth::user()->edit_additional==1 || Auth::user()->id==1)
                            <i data-toggle="tooltip" data-placement="bottom" title="Update Profile Picture" class="fas fa-camera mr-3" id="trigger_user_image_edit" style="font-size:21px;cursor:pointer"></i>
                            <i data-toggle="tooltip" data-placement="bottom" title="Edit additional info." class="fas fa-pen-square" id="trigger_user_additional_edit" style="font-size:21px;cursor:pointer"></i>
                            @else
                                <span class="badge badge-danger">No permission to edit</span>
                            @endif
                        </h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="" class="lebelcolor">Father Name</label>
                            </div>
                            <div class="col-lg-8">
                                <label for="">{{ $profile_info->profile_user_father_name }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="" class="lebelcolor">Mother Name</label>
                            </div>
                            <div class="col-lg-8">
                                <label for="">{{ $profile_info->profile_user_mother_name }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="" class="lebelcolor">Gender</label>
                            </div>
                            <div class="col-lg-8">
                                <label for="">{{ $profile_info->profile_user_gender }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="" class="lebelcolor">Address</label>
                            </div>
                            <div class="col-lg-8">
                                <label for="">{{ $profile_info->profile_user_address }}</label>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->edit_additional==1 || Auth::user()->id==1)
                    <div class="card-body" id="user_additional_edit" style="display:none">
                        <form action="" id="update_additional_info_form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Father Name</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $profile_info->profile_user_father_name }}" name="father_name">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Mother Name</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $profile_info->profile_user_mother_name }}" name="mother_name">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Gender</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="radio" value="Male" name="gender" @if($profile_info->profile_user_gender=='Male') checked @endif>&nbsp;Male &nbsp;&nbsp;
                                    <input type="radio" value="Female" name="gender" @if($profile_info->profile_user_gender=='Female') checked @endif>&nbsp;Female
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Date of Birth</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="date" class="form-control" value="{{ $profile_info->profile_user_dob }}" name="dob">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Address</label>
                                </div>
                                <div class="col-lg-8">
                                    <textarea class="form-control" name="address" id="" cols="30" rows="5">{{ $profile_info->profile_user_address }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <button type="submit" id="update_additional_info_button" class="btn btn-info form-control">Update Additional Info</button>
                                </div>
                            </div>
                            
                           
                        </form>
                    </div>
                    
                    <div class="card-body" id="user_image_edit" style="display:none">
                        <form action="" id="update_image_info_form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="lebelcolor">Profile Image</label><br>
                                <input type="file" class="dropify" data-height="150" name="profile_image_update" id="profile_image_update" accept="image/png, image/jpeg,image/jpeg"/>
                                <span class="text-danger" id="profile_image_error"></span>
                            </div>
                            <button type="submit" id="update_image_info_button" class="btn btn-success form-control">Update Profile Picture</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div> <!-- end col -->
            <div class="col-lg-4">
                <div class="card">
                    {{-- <div class="div-header mt-3">
                        <h4 class="card-title text-center">Change Password</h4>
                        <h4 class="card-title text-right mr-3"></h4>
                        
                    </div> --}}
                    <div class="card-body mt-3" >
                        <form action="" id="change_password_form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="" class="lebelcolor">Old Password</label>
                                </div>
                                <div class="input-group col-md-8 mb-3">
                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="old password" aria-label="Recipient's username" aria-describedby="basic-addon4">
                                    <span class="input-group-text " id="basic-addon4" onclick="password_status('old_password','basic-addon4')"><i class="fas fa-eye"></i></span>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="" class="lebelcolor">New Password</label>
                                </div>
                                <div class="input-group col-md-8 mb-3">
                                    <input type="password" class="form-control" placeholder="new password" name="new_password" id="new_password" aria-label="Recipient's username" aria-describedby="basic-addon3">
                                    <span class="input-group-text" id="basic-addon3" onclick="password_status('new_password','basic-addon3')"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="" class="lebelcolor">Re-type Password</label>
                                </div>
                                {{-- <div class="form-group col-md-8">
                                    <input type="password" class="form-control" name="retype_password">
                                    <span class="retype_password_error"></span>
                                </div> --}}
                                <div class="input-group col-md-8 mb-3">
                                    <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="retype password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2" onclick="password_status('retype_password','basic-addon2')"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                            
                            <button type="submit" id="update_password_button" class="btn btn-success form-control">Change Password</button>
                        </form>
                        <script>
                            function password_status(x,y){
                                var status = document.getElementById(x).type;
                                if(status=='password'){
                                    document.getElementById(x).type='text';
                                    document.getElementById(y).classList.add('text-danger');
                                }else{
                                    document.getElementById(x).type='password';
                                    document.getElementById(y).classList.remove('text-danger');
                                }
                            } 
                        </script>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        @else
        <div class="row">

            <div class="col-lg-5 mx-auto">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Update User Info</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="update_user_form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for=""><strong>Father Name</strong></label>
                                <input type="text" class="form-control" name="father_name" id="father_name" value="{{ old('father_name') }}">
                                <span class="text-danger" id="father_name_error"></span>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Mother Name</strong></label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name" value="{{ old('mother_name') }}">
                                <span class="text-danger" id="mother_name_error"></span>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Gender</strong></label><br>
                                <input type="radio" name="gender" value="Male" checked>&nbsp; Male &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="Female"> &nbsp;Female
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Address</strong></label>
                                <textarea name="address" id="address" class="form-control" id="" cols="30" rows="5">{{ old('mother_name') }}</textarea>
                                <span class="text-danger" id="address_error"></span>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Profile Image</strong></label><br>
                                <input type="file" class="dropify" data-height="150" name="profile_image" id="profile_image" accept="image/png, image/jpeg,image/jpeg"/>
                                <span class="text-danger" id="profile_image_error"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="update_user_button" class="form-control btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
            
        </div>
        <!-- end row-->
        @endif
    </div> <!-- container-fluid -->
</div>
@endsection

@section('js')
    <script src="{{ asset('public/main/plugins/dropify/dropify.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/pages/fileuploads-demo.js')}}"></script>


    <script src="{{ asset('resources/js/admin/profile/profile_update.js')}}"></script>

    <script>
        $('#update_user_form').on("submit",function(e){
            e.preventDefault();
            if(formValidation()){
                $('#update_user_button').addClass('disabled');
                $('#update_user_button').html('Updating Profile Data ......');
                $.ajax({
                    type : 'POST',
                    url : '{{ route("admin_profile") }}',
                    data: new FormData(this),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success : function(data){
                        $('#update_user_button').removeClass('disabled');
                        $('#update_user_button').html('Update');
                        Swal.fire({
                            type: 'success',
                            title: '',
                            text: 'Profile Updated Suvccessfully',
                            confirmButtonClass: 'btn btn-confirm mt-2',
                        }).then(function(){
                            window.location.reload();
                        })
                    },
                    error : function(err){
                        console.log(err);
                        $('#update_user_button').removeClass('disabled');
                        $('#update_user_button').html('Update');
                        Swal.fire({
                            type: 'error',
                            title: 'Opps !',
                            text: 'Something went wrong',
                            timer:1500,

                        });
                    }
                })
            }
        });
        $('#update_basic_info_form').on("submit",function(e){
            e.preventDefault();
            $('#update_basic_info_button').addClass('disabled');
            $('#update_basic_info_button').html('Updating basic info. data ......');
            $.ajax({
                type : 'POST',
                url : '{{ route("update_basic_info") }}',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                success : function(data){
                    if(data.message==1){
                        Swal.fire({
                            type: 'success',
                            title: '',
                            text: 'Profile Updated Suvccessfully',
                            showConfirmButton: false,
                            timer:2000,
                        }).then(function(){
                            window.location.reload();
                        })
                    }
                },
                error : function(err){
                    $('#update_basic_info_button').removeClass('disabled');
                    $('#update_basic_info_button').html('Update Basic Info');
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: err.responseJSON.message,
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    }).then(()=>{
                        if(err.responseJSON.message=='Unauthenticated.'){
                            window.location.reload();
                        }
                    });
                }
            })
        });

        $('#update_additional_info_form').on("submit",function(e){
            e.preventDefault();
            $('#update_additional_info_button').addClass('disabled');
            $('#update_additional_info_button').html('Updating additional info. data ......');
            $.ajax({
                type : 'POST',
                url : '{{ route("update_additional_info") }}',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                success : function(data){
                    if(data.message==1){
                        Swal.fire({
                            type: 'success',
                            title: '',
                            text: 'Profile Updated Suvccessfully',
                            showConfirmButton: false,
                            timer:2000,
                        }).then(function(){
                            window.location.reload();
                        })
                    }
                },
                error : function(err){
                    $('#update_additional_info_button').removeClass('disabled');
                    $('#update_additional_info_button').html('Update additional Info');
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: err.responseJSON.message,
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }
            })
        });


        $('#update_image_info_form').on("submit",function(e){
            e.preventDefault();
            $('#update_image_info_button').addClass('disabled');
            $('#update_image_info_button').html('Updating Profile Image ......');
            $.ajax({
                type : 'POST',
                url : '{{ route("update_image_info") }}',
                data: new FormData(this),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success : function(data){
                    $('#update_image_info_button').removeClass('disabled');
                    $('#update_image_info_button').html('Update Profile Picture');
                    Swal.fire({
                        type: 'success',
                        title: '',
                        text: 'Profile Picture Updated Suvccessfully',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    }).then(function(){
                        window.location.reload();
                    })
                },
                error : function(err){
                    
                    $('#update_image_info_button').removeClass('disabled');
                    $('#update_image_info_button').html('Update Profile Picture');
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: err.responseJSON.message,
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    }).then(()=>{
                        $("#update_image_info_form").trigger("reset");
                    });
                }
            })
        });

        $('#change_password_form').on("submit",function(e){
            e.preventDefault();
            $('#update_password_button').addClass('disabled');
            $('#update_password_button').html('Updating password ......');
            $.ajax({
                type : 'POST',
                url : '{{ route("update_password") }}',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                success : function(data){
                    $('#update_password_button').removeClass('disabled');
                    $('#update_password_button').html('Change Password');
                    if(data.message==1){
                        Swal.fire({
                            type: 'success',
                            title: '',
                            text: 'Profile Updated Suvccessfully',
                            showConfirmButton: false,
                            timer:2000,
                        }).then(()=>{
                            $("#change_password_form").trigger("reset");
                        })
                    }
                },
                error : function(err){
                    $('#update_password_button').removeClass('disabled');
                    $('#update_password_button').html('Change Password');
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: err.responseJSON.message,
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }
            })
        });
    </script>

@endsection