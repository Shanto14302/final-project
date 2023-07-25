@extends('layouts.app')

@section('title')
    View Users
@endsection

@section('css')

<link href="{{ asset('public/main/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/main/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/main/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .lebelcolor {
        color: #101418 !important;
        font-weight: 800;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
{{-- Modal --}}

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit User Basic Information</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="update_basic_info_form">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="user_id"  name="user_id">
                        <input type="hidden" id="trid"  name="trid">
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Email</label>
                            <input type="text" class="form-control" name="user_email" id="user_email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Phone</label>
                            <input type="text" class="form-control" name="user_phone" id="user_phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Role</label>
                            <select name="user_role" id="user_role" class="form-control">
                                
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="update_basic_info_button" class="btn btn-primary waves-effect waves-light">Update Basic Info</button>
                    </div>
                </form>
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User Additional Information</h5>
                    <hr>
                <form id="update_additional_info_form" action="" method="POST">
                    @csrf
                    <input type="hidden" id="basic_user_id"  name="user_id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Father Name</label>
                            <input type="text" class="form-control" name="father_name" id="father_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Mother Email</label>
                            <input type="text" class="form-control" name="mother_name" id="mother_name">
                        </div>
                        <div class="form-group col-md-3" id="gender">
                           
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="" class="labelcolor">Date of birth</label>
                            <input type="date" class="form-control" name="dob" id="dob">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Address</label>
                            <textarea name="address" rows="5" id="address" class="form-control">
                                
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit"  id="update_additional_info_button" class="btn btn-primary waves-effect waves-light">Update Additional Info</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit User Basic Information</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="add_user_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Email</label>
                            <input type="text" class="form-control" name="user_email" id="user_email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Phone</label>
                            <input type="text" class="form-control" name="user_phone" id="user_phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Role</label><br>
                            <select name="user_role" id="user_role" class="form-control">
                                <option value="" selected disabled>Please Select</option>
                                <option value="1">Admin</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Editor</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Re-type Password</label>
                            <input type="password" class="form-control" name="rpassword" id="passwordr">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="add_user_button" class="btn btn-primary waves-effect waves-light">Create User</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>


{{-- End Modal --}}

<div class="modal fade bd-example-modal-lg" id="display_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">User Basic Information</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Name</label>
                            <input type="text" class="form-control" readonly id="user_named">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Email</label>
                            <input type="text" class="form-control" readonly id="user_emaild">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Phone</label>
                            <input type="text" class="form-control" readonly id="user_phoned">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">User Role</label>
                            <select name="user_role" id="user_roled" readonly class="form-control">
                                
                            </select>
                        </div>
                    </div>
                    <hr>
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User Additional Information</h5>
                    <hr>
                    <input type="hidden" id="btn_idd" >
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Father Name</label>
                            <input type="text" class="form-control" readonly id="father_named">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Mother Email</label>
                            <input type="text" class="form-control" readonly id="mother_named">
                        </div>
                        <div class="form-group col-md-3" id="genderd">
                           
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="" class="labelcolor">Date of birth</label>
                            <input type="date" class="form-control" readonly id="dobd">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Address</label>
                            <textarea name="address" rows="5" id="addressd" class="form-control" readonly>
                                
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    </div>
            </div>
            
        </div>
    </div>
</div>

 {{-- End Display Modal --}}

 {{-- Mail Modal --}}

<div class="modal fade bd-example-modal-lg" id="mail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Mail</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="mail_form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="" class="labelcolor">Mail Subject</label>
                            <input type="text" class="form-control" id="mail_subject" name="mail_subject">
                            <input type="hidden" class="form-control" id="user_idm" name="user_idm">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="" class="labelcolor">Mail Body</label>
                            <textarea rows="6" class="form-control" name="mail_body" id="mail_body"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <button type="submit" id="mail_button" class="btn btn-secondary waves-effect waves-light mt-2">Send &nbsp;&nbsp;<i class="far fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

 {{-- End mail Modal --}}






<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Users</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                            <li class="breadcrumb-item active">View User</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="div-header mt-3">
                        {{-- <h4 class="card-title text-center">Basic Info</h4>
                        <h4 class="card-title text-right mr-3"></h4> --}}
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-warning float-right" data-toggle="modal" data-target="#adduser" type="button">Add User</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" id="user_search_form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">User Type</label>
                                    <select name="user_type" id="user_type" class="form-control" data-toggle="select2" >
                                        <option value="" >Please Select</option>
                                        <option value="all">All</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Supervisor</option>
                                        <option value="3">Editor</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">User Name</label>
                                    <select name="user_name" id="" class="form-control" data-toggle="select2">
                                        <option value="" >Please Select</option>
                                        <option value="all">All</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">User Email</label>
                                    <select name="user_email" id="" class="form-control" data-toggle="select2">
                                        <option value="" >Please Select</option>
                                        <option value="all">All</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->email }}">{{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">User ID</label>
                                    <select name="user_id" id="" class="form-control" data-toggle="select2">
                                        <option value="" >Please Select</option>
                                        <option value="all">All</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->id+100000 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <button class="btn btn-info float-right ml-4" style="font-size:15px;" id="search" type="submit" >Search &nbsp;<i class="fas fa-search"></i></button> <button class="btn float-right mr-4 btn-outline-danger" style="font-size:15px;" type="button" id="refresh">Refresh &nbsp;<i class="mdi mdi-atom-variant "></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body" id="search_result" style="display: none;">
                        <h4 class="card-title text-center">Search Results</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" >
                                <thead>
                                    <tr class="bg-primary text-center text-white">
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Phone</th>
                                        <th>User Role</th>
                                        <th>User Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('public/main/plugins/select2/select2.min.js')}}"></script>
<script src="{{ asset('public/main/plugins/switchery/switchery.min.js')}}"></script>
<script>
   $('[data-toggle="select2"]').select2();
   
</script>

<script>
    $(document).on("click",'#refresh',function(){
        $("#user_type").val(''); 
        $('[data-toggle="select2"]').val(null).trigger('change');;
    });


    $('#user_search_form').on('submit',function(e){
        e.preventDefault();
        $('#search').addClass('disabled');
        $('#search').html('Searching &nbsp; <i class="mdi mdi-rotate-right mdi-spin"></i>');
        $.ajax({
            type : 'POST',
            url : '{{ route("search_admin") }}',
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){
                
                $('#search').removeClass('disabled');
                $('#search').html('Search &nbsp;<i class="fas fa-search"></i>');
                
                    if(data.count>=1){
                        document.getElementById('search_result').style.display='block';
                        $('#table_data').empty();
                        $.each(data.users,function(key,value){
                            let sts = '';
                            let disable = '';
                            let disable2 = '';
                            if(value.status=='Active'){
                                 
                                sts = 'checked'
                            }else{
                                sts = '';
                            }

                            if(value.id=={{ Auth::user()->id }}){
                                disable = 'disabled';
                            }
                            if(value.id==1){
                                disable2 = 'disabled';
                            }
                            var role = value.role==1?"Admin":value.role==2?"Supervisor":value.role==3?"Editor":"";
                            $('#table_data').append('<tr id="trid-'+value.id+'"><td>'+value.name+'</td> <td>'+value.email+'</td><td>'+value.phone+'</td><td>'+role+'</td><td id="td-'+value.id+'" class="text-center">'+value.status+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input '+disable+' '+disable2+' id="change_status" type="checkbox" data-id="'+value.id+'" data-toggle="switchery" '+sts+' data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" /></td><td class="text-center"><button class="btn btn-primary btn-sm" id="edit_button" data-edit="'+value.id+'"><i class="fas fa-pen-nib"></i></button> &nbsp; <button class="btn btn-danger btn-sm" id="delete_button" data-delete="'+value.id+'"><i class="fas fa-prescription-bottle"></i></button> &nbsp; <button class="btn btn-secondary btn-sm" id="display_button" data-display="'+value.id+'"><i class="fas fa-desktop"></i></button> &nbsp; <button class="btn btn-outline-dark btn-sm" '+disable+' id="mail_button" data-mail="'+value.id+'"><i class="far fa-paper-plane"></i></button></td></tr>');
                        });
                        $('[data-toggle="switchery"]').each(function (idx, obj) {
                            new Switchery($(this)[0], $(this).data());
                        });
                    }else{
                        $('#search_result').empty();
                        Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: 'No result found',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }
                
                
            },
            error : function(err){
                $('#search').removeClass('disabled');
                $('#search').html('Search &nbsp;<i class="fas fa-search"></i>');
                Swal.fire({
                    type: 'error',
                    title: 'Opps !',
                    text: err.responseJSON.message,
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });
            }
        })
    });
    //status change
    $(document).on("change","#change_status",function(){
        var id = $(this).data('id');

        $(this).attr('id','in-'+id);
        // var tdid = 'td-'+id;
        var tdid = $(this).closest('td').attr('id');
        var trid = $(this).closest('tr').attr('id');
        var prev = document.getElementById(tdid).innerHTML;
         $('#'+tdid).empty();
        document.getElementById(tdid).innerHTML = '<i style="font-size:18px;" class="fas fa-spinner fa-spin"></i>'
        $.ajax({
            type : 'GET',
            url : 'update-user-status/'+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(value){
                if(value.status=='Active'){
                    if(value.id=={{ Auth::user()->id }}){
                        $('#'+tdid).empty();
                        document.getElementById(tdid).innerHTML=value.status+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input disabled id="change_status" type="checkbox" data-id="'+value.user.id+'" data-toggle="switchery" checked data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" />' 
                    }else{
                        $('#'+tdid).empty();
                        document.getElementById(tdid).innerHTML=value.status+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="change_status" type="checkbox" data-id="'+value.user.id+'" data-toggle="switchery" checked data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" />' 
                    }
                    
                }else{
                    document.getElementById(tdid).innerHTML=value.status+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="change_status" type="checkbox" data-id="'+value.user.id+'" data-toggle="switchery" data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" />' 
                }

                $('[data-id="'+id+'"]').each(function (idx, obj) {
                    new Switchery($(this)[0], $(this).data());
                });
                
                // $(this).Switchery();
                
            },
            error : function(){
                document.getElementById(tdid).innerHTML=prev;
                $('[data-id="'+id+'"]').attr('checked');
                // $('[data-id="'+id+'"]').each(function (idx, obj) {
                //     new Switchery($(this)[0], $(this).data());
                // });
                Swal.fire({
                    type: 'error',
                    title: 'Opps !',
                    text: 'Server error',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });
            }
        })


    })


    //edit 

    $(document).on("click","#edit_button",function(){
        
        var edit = $(this).data('edit');
        var trid = $(this).closest('tr').attr('id');
        $.ajax({
            type : 'GET',
            url : 'get-user-information/'+edit,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success: function(data){
                $('#edit_modal').modal('show');
                $('#user_name').val(data.name);
                $('#user_id').val(data.id);
                $('#basic_user_id').val(data.id);
                $('#trid').val('trid-'+data.id);
                $('#user_email').val(data.email);
                $('#user_phone').val(data.phone);
                let admins = '';
                let supervisors = '';
                let editors = '';
                let customers = '';
                if(data.role==1){
                    admins = 'selected';
                }else if(data.role==2){
                    supervisors = 'selected';
                }else if(data.role==3){
                    editors = 'selected';
                }else if(data.role==4){
                    customers = 'selected';
                }
                $('#user_role').html('<option value="1" '+admins+'>Admin</option><option '+supervisors+' value="2">Supervisor</option><option '+editors+' value="3">Editor</option><option '+customers+' value="4">Customer</option>');

                //additional  info

                $('#father_name').val(data.profile_user_father_name);
                $('#mother_name').val(data.profile_user_mother_name);
                let male = '';
                let female = '';
                if(data.profile_user_gender=='Male'){
                    male = 'checked'
                }else if(data.profile_user_gender=='Female'){
                    female = 'checked'
                }   
                $('#gender').html(' <label for="" class="labelcolor">Gender</label><br><input name="gender" type="radio" value="Male" '+male+'>&nbsp;&nbsp; Male &nbsp;&nbsp; <input name="gender" type="radio" value="Female" '+female+'>&nbsp;&nbsp;Female')
                $('#address').val(data.profile_user_address);
                $('#dob').val(data.profile_user_dob);
            }
        })
    });

    $('#update_basic_info_form').on("submit",function(e){
        e.preventDefault();
        var trid = $('#trid').val();
        let id = '#'+trid
        // alert(id)
        // console.log($(id).tr.children[0]);
        // alert();
        $('#update_basic_info_button').addClass('disabled');
        $('#update_basic_info_button').html('Updating basic info. data ......');
        $.ajax({
            type : 'POST',
            url : '{{ route("update_basic_info_user") }}',
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){
                if(data.message==1){
                    $('#update_basic_info_button').removeClass('disabled');
                    $('#update_basic_info_button').html('Update Basic Info');
                    Swal.fire({
                        position: 'top-mid',
                        type: 'success',
                        title: 'User data updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(()=>{
                        $(id).children('td:nth-child(2)').html(data.user.email);
                        $(id).children('td:nth-child(3)').html(data.user.phone);

                        var role_name = '';
                        if(data.user.role==1){
                            role_name = 'Admin';
                        }else if(data.user.role==2){
                            role_name = 'Supervisor';
                        }else if(data.user.role==3){
                            role_name = 'Editor';
                        }
                        $(id).children('td:nth-child(1)').html(data.user.name);
                        $(id).children('td:nth-child(4)').html(role_name);
                        $('#edit_modal').modal('hide');
                        //$( "#search" ).trigger( "click" );
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
                });
            }
        })
    });

    $('#update_additional_info_form').on("submit",function(e){
        e.preventDefault();
        // var trid = $('#trid').val();
        // let id = '#'+trid
        //alert(id)
        // console.log($(id).tr.children[0]);
        $('#update_additional_info_button').addClass('disabled');
        $('#update_additional_info_button').html('Updating additional info. data ......');
        $.ajax({
            type : 'POST',
            url : '{{ route("update_additional_info_user") }}',
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){
                if(data.message==1){
                    $('#update_additional_info_button').removeClass('disabled');
                    $('#update_additional_info_button').html('Update additional Info');
                    Swal.fire({
                        position: 'top-mid',
                        type: 'success',
                        title: 'User data updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(()=>{
                        
                        $('#edit_modal').modal('hide');
                        //$( "#search" ).trigger( "click" );
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

    //view full details 

    $(document).on("click","#display_button",function(){
        // alert('Hello');
        var edit = $(this).data('display');
        var trid = $(this).closest('tr').attr('id');
        $.ajax({
            type : 'GET',
            url : 'get-user-information/'+edit,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success: function(data){
                $('#display_modal').modal('show');
                $('#user_named').val(data.name);
                $('#user_emaild').val(data.email);
                $('#user_phoned').val(data.phone);
                $('#btn_idd').val(edit);
                let admins = '';
                let supervisors = '';
                let editors = '';
                let customers = '';
                if(data.role==1){
                    admins = 'selected';
                }else if(data.role==2){
                    supervisors = 'selected';
                }else if(data.role==3){
                    editors = 'selected';
                }else if(data.role==4){
                    customers = 'selected';
                }
                $('#user_roled').html('<option value="1" '+admins+'>Admin</option><option '+supervisors+' value="2">Supervisor</option><option '+editors+' value="3">Editor</option><option '+customers+' value="4">Customer</option>');

                //additional  info

                $('#father_named').val(data.profile_user_father_name);
                $('#mother_named').val(data.profile_user_mother_name);
                let male = '';
                let female = '';
                if(data.profile_user_gender=='Male'){
                    male = 'checked'
                }else if(data.profile_user_gender=='Female'){
                    female = 'checked'
                }   
                $('#genderd').html(' <label for="" class="labelcolor">Gender</label><br><input disabled name="gender" type="radio" value="Male" '+male+'>&nbsp;&nbsp; Male &nbsp;&nbsp; <input name="gender" type="radio" value="Female" disabled '+female+'>&nbsp;&nbsp;Female')
                $('#addressd').val(data.profile_user_address);
                $('#dobd').val(data.profile_user_dob);
            }
        })
    });

    $(document).on("click","#delete_button",function(){
        let id = $(this).data('delete');
        var dtrid = $(this).closest('tr').attr('id');
        
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ml-2 mt-2',
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type : 'GET',
                        url : 'delete-user/'+id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'JSON',
                        success : function(data){
                            if(data.message==1){
                                Swal.fire({
                                title: 'Deleted!',
                                text: 'User has been deleted.',
                                type: 'success'
                                }).then(()=>{
                                    $('#'+dtrid).css("display", "none");
                                });
                            }else{
                                Swal.fire({
                                title: 'Opps!',
                                text: 'Something went sdfdsfwrong.',
                                type: 'error'
                                })
                            }
                        },
                        error : function(){
                            Swal.fire({
                            title: 'Opps!',
                            text: 'Something went wrong.',
                            type: 'error'
                            })
                        }
                    })
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Swal.fire({
                    title: 'Cancelled',
                    text: 'Delete request cancelled',
                    type: 'error'
                    })
                }
            });
    });
    $(document).on("click","#mail_button",function(){
        var edit = $(this).data('mail');
        $('#user_idm').attr('value',edit);
        $('#mail_modal').modal('show');
    });

    $('#mail_form').on("submit",function(e){
        e.preventDefault();
        $('#mail_button').addClass('disabled');
        $('#mail_button').html('Sending email &nbsp;<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type : 'POST',
            url : 'send-mail-user',
            data: new FormData(this),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success : function(data){
                $('#mail_button').removeClass('disabled');
                $('#mail_button').html('Send &nbsp;&nbsp;<i class="far fa-paper-plane"></i>');
                $('#mail_modal').modal('hide');
                Swal.fire({
                    position: 'top-mid',
                    type: 'success',
                    title: 'Mail send successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=>{
                    $("#mail_form").trigger("reset");
                })
            },
            error : function(err){
                $('#mail_button').removeClass('disabled');
                $('#mail_button').html('Send &nbsp;&nbsp;<i class="far fa-paper-plane"></i>');
                $('#mail_modal').modal('hide');
                Swal.fire({
                title: 'Opps!',
                text: 'Something went wrong.',
                type: 'error'
                })
            }
        });
    });
    $('#add_user_form').on("submit",function(e){
        e.preventDefault();
        $('#add_user_button').addClass('disabled');
        $('#add_user_button').html('Creating user &nbsp;<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type : 'POST',
            url : 'add-user',
            data: new FormData(this),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success : function(data){
                $('#add_user_button').removeClass('disabled');
                $('#add_user_button').html('Create User');
                Swal.fire({
                    position: 'top-mid',
                    type: 'success',
                    title: 'User created successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=>{
                    $("#add_user_form").trigger("reset");
                    $('#adduser').modal('hide');
                    $("#search").click();

                })

            },
            error : function(err){
                $('#add_user_button').removeClass('disabled');
                $('#add_user_button').html('Create User');
                Swal.fire({
                    type: 'error',
                    title: 'Opps !',
                    text: err.responseJSON.message,
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });
            }
        });
    })

</script>
@endsection