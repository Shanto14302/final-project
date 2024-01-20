@extends('layouts.app')

@section('title')
    View teachers
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Teacher Basic Information</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="update_basic_info_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Name</label>
                            <input type="text" class="form-control" name="teacher_name" id="teacher_name">
                            <input type="hidden" class="form-control" name="basic_teacher_id" id="basic_teacher_id">
                            <input type="hidden" id="trid"  name="trid">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Email</label>
                            <input type="text" class="form-control" name="teacher_email" id="teacher_email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="labelcolor">Teacher Phone</label>
                            <input type="text" class="form-control" name="teacher_phone" id="teacher_phone">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="labelcolor">Teacher ID</label>
                            <input type="text" class="form-control" name="teacher_id" id="teacher_id">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="labelcolor">Teacher Faculty</label>
                            <select name="teacher_facalty" id="teacher_faculty" class="form-control" data-toggle="select2" style="width: 100%">
                                <option value="">Please Select</option>
                                <option value="FIST">FIST</option>
                                <option value="FBE">FBE</option>
                                <option value="FE">FE</option>
                                <option value="FAHS">FAHS</option>
                                <option value="FHSS">FHSS</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Department</label>
                            <input type="text" class="form-control" name="teacher_department" id="teacher_department">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Designation</label>
                            <input type="text" class="form-control" name="teacher_designation" id="teacher_designation">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="update_basic_info_button" class="btn btn-primary waves-effect waves-light">Update Teacher Info</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addteacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Teacher</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="add_teacher_form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Name</label>
                            <input type="text" class="form-control" name="teacher_name" id="teacher_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Email</label>
                            <input type="text" class="form-control" name="teacher_email" id="teacher_email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="labelcolor">Teacher Phone</label>
                            <input type="text" class="form-control" name="teacher_phone" id="teacher_phone">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="labelcolor">Teacher ID</label>
                            <input type="text" class="form-control" name="teacher_id" id="teacher_id">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="labelcolor">Teacher Faculty</label>
                            <select name="teacher_facalty" id="" class="form-control" data-toggle="select2" style="width: 100%">
                                <option value="">Please Select</option>
                                <option value="FIST">FIST</option>
                                <option value="FBE">FBE</option>
                                <option value="FE">FE</option>
                                <option value="FAHS">FAHS</option>
                                <option value="FHSS">FHSS</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Department</label>
                            <input type="text" class="form-control" name="teacher_department" id="teacher_department">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="labelcolor">Teacher Designation</label>
                            <input type="text" class="form-control" name="teacher_designation" id="teacher_designation">
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
                        <button type="submit" id="add_teacher_button" class="btn btn-primary waves-effect waves-light">Create teacher</button>
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
                <h5 class="modal-title" id="exampleModalLongTitle">teacher Basic Information</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="row" id="display">
                    <div class="form-group col-md-6">
                        <label for="" class="labelcolor">Teacher Name</label>
                        <input type="text" class="form-control" name="teacher_name" id="teacher_name" readonly>
                        <input type="hidden" class="form-control" name="basic_teacher_id" id="basic_teacher_id">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="labelcolor">Teacher Email</label>
                        <input type="text" class="form-control" name="teacher_email" id="teacher_email" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="labelcolor">Teacher Phone</label>
                        <input type="text" class="form-control" name="teacher_phone" id="teacher_phone" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="labelcolor">Teacher ID</label>
                        <input type="text" class="form-control" name="teacher_id" id="teacher_id" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="labelcolor">Teacher Faculty</label>
                        <select name="teacher_facalty" id="teacher_faculty" class="form-control" data-toggle="select2" style="width: 100%" readonly>
                            <option value="">Please Select</option>
                            <option value="FIST">FIST</option>
                            <option value="FBE">FBE</option>
                            <option value="FE">FE</option>
                            <option value="FAHS">FAHS</option>
                            <option value="FHSS">FHSS</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="labelcolor">Teacher Department</label>
                        <input type="text" class="form-control" name="teacher_department" id="teacher_department" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="labelcolor">Teacher Designation</label>
                        <input type="text" class="form-control" name="teacher_designation" id="teacher_designation" readonly>
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
                            <input type="hidden" class="form-control" id="teacher_idm" name="teacher_idm">
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
                    <h4 class="mb-0 font-size-18">Teachers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Teachers</a></li>
                            <li class="breadcrumb-item active">View Teacher</li>
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
                                <button class="btn btn-warning float-right" data-toggle="modal" data-target="#addteacher" type="button">Add teacher</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" id="teacher_search_form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">Teacher Facalty</label>
                                    <select name="teacher_facalty" id="" class="form-control" data-toggle="select2" style="width: 100%">
                                        <option value="">Please Select</option>
                                        <option value="FIST">FIST</option>
                                        <option value="FBE">FBE</option>
                                        <option value="FE">FE</option>
                                        <option value="FAHS">FAHS</option>
                                        <option value="FHSS">FHSS</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">Teacher Name</label>
                                    <select name="teacher_name" id="" class="form-control" data-toggle="select2">
                                        <option value="" >Please Select</option>
                                        <option value="all">All</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">Teacher Email</label>
                                    <select name="teacher_email" id="" class="form-control" data-toggle="select2">
                                        <option value="" >Please Select</option>
                                        <option value="all">All</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->email }}">{{ $teacher->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="lebelcolor" for="">Teacher ID</label>
                                    <select name="teacher_id" id="" class="form-control" data-toggle="select2">
                                        <option value="" >Please Select</option>
                                        <option value="all">All</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->id+100000 }}</option>
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
                                        <th>Teacher Name</th>
                                        <th>Teacher Email</th>
                                        <th>Teacher Phone</th>
                                        <th>Teacher Designation</th>
                                        <th>Teacher Facalty</th>
                                        <th>Teacher Department</th>
                                        <th>Teacher Status</th>
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
        $("#teacher_type").val('');
        $('[data-toggle="select2"]').val(null).trigger('change');;
    });

    $('#teacher_search_form').on('submit',function(e){
        e.preventDefault();
        $('#search').addClass('disabled');
        $('#search').html('Searching &nbsp; <i class="mdi mdi-rotate-right mdi-spin"></i>');
        $.ajax({
            type : 'POST',
            url : '{{ route("search_teacher") }}',
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){

                $('#search').removeClass('disabled');
                $('#search').html('Search &nbsp;<i class="fas fa-search"></i>');

                    if(data.count>=1){
                        document.getElementById('search_result').style.display='block';
                        $('#table_data').empty();
                        $.each(data.teachers,function(key,value){
                            let sts = '';
                            let ests = '';
                            let disable = '';
                            let disable2 = '';
                            if(value.status=='Active'){

                                sts = 'checked'
                            }else{
                                sts = '';
                            }

                            if(value.edit_basic==1){
                                 ests = 'checked'
                                 ests_value = 'Editable'
                             }else{
                                 ests = '';
                                 ests_value = 'Not Editable'
                             }

                             if(value.edit_additional==1){
                                 asts = 'checked'
                                 asts_value = 'Editable'
                             }else{
                                 asts = '';
                                 asts_value = 'Not Editable'
                             }

                            if(value.id=={{ Auth::user()->id }}){
                                disable = 'disabled';
                            }
                            if(value.id==1){
                                disable2 = 'disabled';
                            }
                            var role = value.role==1?"Admin":value.role==2?"Supervisor":value.role==3?"Editor":value.role==4?"Teacher":"Student";
                            $('#table_data').append('<tr id="trid-'+value.id+'"><td>'+value.name+'</td> <td>'+value.email+'</td><td>'+value.phone+'</td><td>'+value.teacher_designation+'</td><td>'+value.teacher_facalty+'</td><td>'+value.teacher_department+'</td><td id="td-'+value.id+'" class="text-center">'+value.status+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input '+disable+' '+disable2+' id="change_status" type="checkbox" data-id="'+value.id+'" data-toggle="switchery" '+sts+' data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" /></td><td class="text-center"><button class="btn btn-primary btn-sm mr-1 mt-2" id="edit_button" data-edit="'+value.id+'"><i class="fas fa-pen-nib"></i></button> <button class="btn btn-danger btn-sm mr-1 mt-2" id="delete_button" data-delete="'+value.id+'"><i class="fas fa-prescription-bottle"></i></button>  <button class="btn btn-secondary btn-sm mr-1 mt-2" id="display_button" data-display="'+value.id+'"><i class="fas fa-desktop"></i></button> <button class="btn btn-outline-dark btn-sm mr-1 mt-2" '+disable+' id="mail_button" data-mail="'+value.id+'"><i class="far fa-paper-plane"></i></button></td></tr>');
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
            url : 'update-teacher-status/'+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(value){
                if(value.status=='Active'){
                    if(value.id=={{ Auth::user()->id }}){
                        $('#'+tdid).empty();
                        document.getElementById(tdid).innerHTML=value.status+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  id="change_status" type="checkbox" data-id="'+value.teacher.id+'" data-toggle="switchery" checked data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" />'
                    }else{
                        $('#'+tdid).empty();
                        document.getElementById(tdid).innerHTML=value.status+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="change_status" type="checkbox" data-id="'+value.teacher.id+'" data-toggle="switchery" checked data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" />'
                    }

                }else{
                    document.getElementById(tdid).innerHTML=value.status+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="change_status" type="checkbox" data-id="'+value.teacher.id+'" data-toggle="switchery" data-secondary-color="#df3554" data-color="#18AD0C" data-size="small" />'
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


    //edit teacher
    $(document).on("click","#edit_button",function(){

        var edit = $(this).data('edit');
        var trid = $(this).closest('tr').attr('id');
        $.ajax({
            type : 'GET',
            url : 'get-teacher-information/'+edit,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success: function(data){
                $('#edit_modal').modal('show');
                $('#update_basic_info_form #teacher_name').val(data.name);
                $('#update_basic_info_form #teacher_id').val(data.teacher_id);
                $('#update_basic_info_form #basic_teacher_id').val(data.id);
                $('#update_basic_info_form #trid').val('trid-'+data.id);
                $('#update_basic_info_form #teacher_email').val(data.email);
                $('#update_basic_info_form #teacher_phone').val(data.phone);
                $('#trid').val('trid-'+data.id);


                //additional  info


                $('#update_basic_info_form #teacher_designation').val(data.teacher_designation);
                $('#update_basic_info_form #teacher_department').val(data.teacher_department);
                $('#update_basic_info_form #teacher_faculty').val(data.teacher_facalty);
                $("#update_basic_info_form #teacher_faculty").val(data.teacher_facalty).trigger('change');
            }
        })
    });

    $('#update_basic_info_form').on("submit",function(e){
        e.preventDefault();
        var trid = $('#trid').val();
        let id = '#'+trid
        var trid = $(this).closest('tr').attr('id');
        // alert(id)
        // console.log($(id).tr.children[0]);
        // alert();
        $('#update_basic_info_button').addClass('disabled');
        $('#update_basic_info_button').html('Updating Teacher Info. data ......');
        $.ajax({
            type : 'POST',
            url : '{{ route("update_basic_info_teacher") }}',
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){
                if(data.message==1){
                    $('#update_basic_info_button').removeClass('disabled');
                    $('#update_basic_info_button').html('Update Teacher Info');
                    Swal.fire({
                        position: 'top-mid',
                        type: 'success',
                        title: 'teacher data updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(()=>{
                        $(id).children('td:nth-child(2)').html(data.teacher.email);
                        $(id).children('td:nth-child(3)').html(data.teacher.phone);
                        $(id).children('td:nth-child(4)').html(data.teacher.teacher_designation);
                        $(id).children('td:nth-child(5)').html(data.teacher.teacher_facalty);
                        $(id).children('td:nth-child(6)').html(data.teacher.teacher_department);

                        // var role_name = '';
                        // if(data.teacher.role==1){
                        //     role_name = 'Admin';
                        // }else if(data.teacher.role==2){
                        //     role_name = 'Supervisor';
                        // }else if(data.teacher.role==3){
                        //     role_name = 'Editor';
                        // }
                        $(id).children('td:nth-child(1)').html(data.teacher.name);
                        // $(id).children('td:nth-child(4)').html(role_name);
                        $('#edit_modal').modal('hide');
                        //$( "#search" ).trigger( "click" );
                    })

                }
            },
            error : function(err){
                $('#update_basic_info_button').removeClass('disabled');
                $('#update_basic_info_button').html('Update Teacher Info');
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
            url : 'get-teacher-information/'+edit,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success: function(data){
                $('#display_modal').modal('show');
                $('#display #teacher_name').val(data.name);
                $('#display #teacher_id').val(data.teacher_id);
                $('#display #basic_teacher_id').val(data.id);
                $('#display #trid').val('trid-'+data.id);
                $('#display #teacher_email').val(data.email);
                $('#display #teacher_phone').val(data.phone);



                //additional  info


                $('#display #teacher_designation').val(data.teacher_designation);
                $('#display #teacher_department').val(data.teacher_department);
                $('#display #teacher_faculty').val(data.teacher_facalty);
                $("#display #teacher_faculty").val(data.teacher_facalty).trigger('change');
                $("#display #teacher_faculty").prop("disabled", true);

            }
        })
    });

    //delete teacher
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
                        url : 'delete-teacher/'+id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'JSON',
                        success : function(data){
                            if(data.message==1){
                                Swal.fire({
                                title: 'Deleted!',
                                text: 'Teacher has been deleted.',
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

    //mail modal
    $(document).on("click","#mail_button",function(){
        var edit = $(this).data('mail');
        $('#teacher_idm').attr('value',edit);
        $('#mail_modal').modal('show');
    });

    $('#mail_form').on("submit",function(e){
        e.preventDefault();
        $('#mail_button').addClass('disabled');
        $('#mail_button').html('Sending email &nbsp;<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type : 'POST',
            url : 'send-mail-teacher',
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

    $('#add_teacher_form').on("submit",function(e){
        e.preventDefault();
        $('#add_teacher_button').addClass('disabled');
        $('#add_teacher_button').html('Creating teacher &nbsp;<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type : 'POST',
            url : 'add-teacher',
            data: new FormData(this),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success : function(data){
                $('#add_teacher_button').removeClass('disabled');
                $('#add_teacher_button').html('Create teacher');
                Swal.fire({
                    position: 'top-mid',
                    type: 'success',
                    title: 'teacher created successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=>{
                    $("#add_teacher_form").trigger("reset");
                    $('#addteacher').modal('hide');
                    $("#search").click();

                })

            },
            error : function(err){
                $('#add_teacher_button').removeClass('disabled');
                $('#add_teacher_button').html('Create teacher');
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
