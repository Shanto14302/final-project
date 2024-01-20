@extends('layouts.app')
@section('title')
    Supervisor Choice
@endsection
@section('css')
<link href="{{ asset('public/main/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/main/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/main/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title text-center">Supervisor Choice</h4>
                            {{-- <p class="card-subtitle mb-4">Example of basic tabs.</p> --}}

                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <a href="#spervisor_choice" data-toggle="tab" aria-expanded="false" class="nav-link @if($supervisor==NULL) active @endif">
                                        <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                        <span class="d-none d-lg-block">Supervisor Choice (Max 3)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#view_spervisor_choice" data-toggle="tab" aria-expanded="false" class="nav-link @if($supervisor!=NULL) active @endif">
                                        <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                        <span class="d-none d-lg-block">View Spervisor Choice</span>
                                    </a>
                                </li>
                               
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane show @if($supervisor==NULL) active @endif" id="spervisor_choice">
                                    <form action="" id="supervisor_choice_form" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label for="">Faculty</label>
                                                <select name="" id="teacher_faculty" class="form-control" data-toggle="select2" style="width: 100%">
                                                    <option value="">Please Select</option>
                                                    <option value="FIST">FIST</option>
                                                    <option value="FBE">FBE</option>
                                                    <option value="FE">FE</option>
                                                    <option value="FAHS">FAHS</option>
                                                    <option value="FHSS">FHSS</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="">Select Supervisor</label>
                                                <select name="" id="supervisor" class="form-control" data-toggle="select2" style="width: 100%">
                                                    <option value="">Please Select</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" id="choice_button" class="btn btn-primary form-control mt-2">Add</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-10">
                                                <label for="">Choice 1</label>
                                                <input type="text" id="choice_1" name="choice_1" class="form-control" readonly>
                                                <input type="hidden" id="choice_1_id" name="choice_1_id" class="form-control" value="">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" class="btn btn-danger form-control mt-2 delete_choice_1"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="form-group col-lg-10">
                                                <label for="">Choice 2</label>
                                                <input type="text" id="choice_2" name="choice_2" class="form-control" readonly>
                                                <input type="hidden" id="choice_2_id" name="choice_2_id" class="form-control" value="">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" class="btn btn-danger form-control mt-2 delete_choice_2"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="form-group col-lg-10">
                                                <label for="">Choice 3</label>
                                                <input type="text" id="choice_3" name="choice_3" class="form-control" readonly>
                                                <input type="hidden" id="choice_3_id" name="choice_3_id" class="form-control" value="">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" class="btn btn-danger form-control mt-2 delete_choice_3"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                        @if (!$supervisor)
                                            <div class="row">
                                                <div class="form-group col-lg-4" id="submit_btn_append">
                                                    
                                                </div>
                                            </div>
                                        @endif
                                        
                                    </form>
                                </div>
                                <div class="tab-pane show @if($supervisor!=NULL) active @endif" id="view_spervisor_choice">
                                    <div class="table-responsive">
                                        @if ($supervisor)
                                            @php
                                                $sup1 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->supervisor_student_choice_1)->first();
                                                $sup2 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->supervisor_student_choice_2)->first();
                                                $sup3 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->supervisor_student_choice_3)->first();
                                                if($supervisor->supervisor_student_accepted!=NULL){
                                                    $sup = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->supervisor_student_accepted)->first();
                                                }
                                            @endphp
                                            <h5>My Supervisor : @if($supervisor->supervisor_student_accepted==NULL)Not Selected Yet @else {{ $sup->name }} @endif</h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Supervisor Name</th>
                                                        <th>Faculty</th>
                                                        <th>Department</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="supervisor_view_table">
                                                    
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{ $sup1->name }}</td>
                                                        <td>{{ $sup1->teacher_facalty }}</td>
                                                        <td>{{ $sup1->teacher_department }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>{{ $sup2->name }}</td>
                                                        <td>{{ $sup2->teacher_facalty }}</td>
                                                        <td>{{ $sup2->teacher_department }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>{{ $sup3->name }}</td>
                                                        <td>{{ $sup3->teacher_facalty }}</td>
                                                        <td>{{ $sup3->teacher_department }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                        Not choose yet
                                        @endif
                                    </div>
                                </div>
                               
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title text-center">Co-supervisor Choice</h4>
                            {{-- <p class="card-subtitle mb-4">Example of basic tabs.</p> --}}

                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <a href="#spervisor_cochoice" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                        <span classs="d-none d-lg-block">Co-supervisor Choice (Max 3)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#view_spervisor_cochoice" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                        <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                        <span class="d-none d-lg-block">View Co-spervisor Choice</span>
                                    </a>
                                </li>
                               
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="spervisor_cochoice">
                                    <form action="" id="supervisor_cochoice_form" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label for="">Faculty</label>
                                                <select name="" id="teacher_faculty" class="form-control" data-toggle="select2" style="width: 100%">
                                                    <option value="">Please Select</option>
                                                    <option value="FIST">FIST</option>
                                                    <option value="FBE">FBE</option>
                                                    <option value="FE">FE</option>
                                                    <option value="FAHS">FAHS</option>
                                                    <option value="FHSS">FHSS</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="">Select Co-supervisor</label>
                                                <select name="" id="supervisor" class="form-control" data-toggle="select2" style="width: 100%">
                                                    <option value="">Please Select</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" id="cochoice_button" class="btn btn-primary form-control mt-2">Add</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-10">
                                                <label for="">Choice 1</label>
                                                <input type="text" id="cochoice_1" name="cochoice_1" class="form-control" readonly>
                                                <input type="hidden" id="cochoice_1_id" name="cochoice_1_id" class="form-control" value="">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" class="btn btn-danger form-control mt-2 delete_cochoice_1"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="form-group col-lg-10">
                                                <label for="">Choice 2</label>
                                                <input type="text" id="cochoice_2" name="cochoice_2" class="form-control" readonly>
                                                <input type="hidden" id="cochoice_2_id" name="cochoice_2_id" class="form-control" value="">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" class="btn btn-danger form-control mt-2 delete_cochoice_2"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <div class="form-group col-lg-10">
                                                <label for="">Choice 3</label>
                                                <input type="text" id="cochoice_3" name="cochoice_3" class="form-control" readonly>
                                                <input type="hidden" id="cochoice_3_id" name="cochoice_3_id" class="form-control" value="">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for=""></label>
                                                <button type="button" class="btn btn-danger form-control mt-2 delete_cochoice_3"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                        @if ($supervisor && $supervisor->cosupervisor_student_choice_1==NULL)
                                            <div class="row">
                                                <div class="form-group col-lg-4" id="submit_btn_append">
                                                    
                                                </div>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                                <div class="tab-pane" id="view_spervisor_cochoice">
                                    @if ($supervisor && $supervisor->cosupervisor_student_choice_1!=NULL)
                                    @php
                                        $cosup1 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->cosupervisor_student_choice_1)->first();
                                        $cosup2 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->cosupervisor_student_choice_2)->first();
                                        $cosup3 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->cosupervisor_student_choice_3)->first();
                                        if($supervisor->cosupervisor_student_accepted!=NULL){
                                            $cosup = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->cosupervisor_student_accepted)->first();
                                        }
                                    @endphp
                                    <h5>My Co-supervisor : @if($supervisor->cosupervisor_student_accepted==NULL)Not Selected Yet @else {{ $cosup->name }} @endif</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Supervisor Name</th>
                                                <th>Faculty</th>
                                                <th>Department</th>
                                            </tr>
                                        </thead>
                                        <tbody id="supervisor_view_table">
                                            
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $cosup1->name }}</td>
                                                <td>{{ $cosup1->teacher_facalty }}</td>
                                                <td>{{ $cosup1->teacher_department }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $cosup2->name }}</td>
                                                <td>{{ $cosup2->teacher_facalty }}</td>
                                                <td>{{ $cosup2->teacher_department }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $cosup3->name }}</td>
                                                <td>{{ $cosup3->teacher_facalty }}</td>
                                                <td>{{ $cosup3->teacher_department }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    Not choose yet
                                    @endif
                                </div>
                               
                            </div>

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection


@section('js')
<script src="{{ asset('public/main/plugins/select2/select2.min.js')}}"></script>
<script src="{{ asset('public/main/plugins/switchery/switchery.min.js')}}"></script>
<script>
    $('[data-toggle="select2"]').select2();
    $(document).on("click",'#refresh',function(){
        $("#student_type").val(''); 
        $('[data-toggle="select2"]').val(null).trigger('change');;
    });
 </script>

 <script>
    $('#teacher_faculty').change(function(){
        if($(this).val()!=''){
            $.ajax({
                type : 'GET',
                url : 'get-faculty-teacher/'+$(this).val(),
                dataType: 'JSON',
                success : function(data){
                    $('#supervisor').empty();
                    $('#supervisor').append('<option value="">Please Select</option>');
                    $.each(data.teachers,function(key,value){
                        $('#supervisor').append('<option value="'+value.id+'">'+value.name+','+value.teacher_designation+','+value.teacher_department+'</option>');
                    })
                },
                error : function(error){

                }
            });
        }
    })

    

    $('#choice_button').click(function(){
        var choices = {choice_1:'werwr',choice_2:'',choice_3:''};
        // console.log(choices);
        if($('#supervisor').val()!=''){
            
            if($('#choice_1').val()==''){
                if($('#choice_2').val()==$('#supervisor  option:selected').text() || $('#choice_3').val()==$('#supervisor  option:selected').text()){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: 'Same supervisor not allowed',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }else{
                    $('#choice_1').val($('#supervisor  option:selected').text());
                    $('#choice_1_id').val($('#supervisor').val());
                }
            }else if($('#choice_2').val()==''){
                if($('#choice_3').val()==$('#supervisor  option:selected').text() || $('#choice_1').val()==$('#supervisor  option:selected').text()){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: 'Same supervisor not allowed',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }else{
                    $('#choice_2').val($('#supervisor  option:selected').text());
                    $('#choice_2_id').val($('#supervisor').val());
                }
                
            }else if($('#choice_3').val()==''){
                if($('#choice_1').val()==$('#supervisor  option:selected').text() || $('#choice_2').val()==$('#supervisor  option:selected').text()){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: 'Same supervisor not allowed',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }else{
                    $('#choice_3').val($('#supervisor  option:selected').text());
                    $('#choice_3_id').val($('#supervisor').val());
                }
                
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Opps !',
                    text: 'You cant choose not more then 3 supervisor',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });

            
            }

            if($('#choice_1').val()!='' && $('#choice_2').val()!='' && $('#choice_3').val()!=''){
                $('#supervisor_choice_form #submit_btn_append').empty();
                $('#supervisor_choice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
            }else{
                $('#supervisor_choice_form #submit_btn_append').empty();
            }
            
        }
    })
    $('.delete_choice_1').click(function(){
        $('#choice_1').val('');
        $('#choice_1_id').val('');
        if($('#choice_1').val()!='' && $('#choice_2').val()!='' && $('#choice_3').val()!=''){
            $('#supervisor_choice_form #submit_btn_append').empty();
            $('#supervisor_choice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
        }else{
            $('#supervisor_choice_form #submit_btn_append').empty();
        }
    })
    $('.delete_choice_2').click(function(){
        $('#choice_2').val('');
        $('#choice_2_id').val('');
        if($('#choice_1').val()!='' && $('#choice_2').val()!='' && $('#choice_3').val()!=''){
            $('#supervisor_choice_form #submit_btn_append').empty();
            $('#supervisor_choice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
        }else{
            $('#supervisor_choice_form #submit_btn_append').empty();
        }
    })
    $('.delete_choice_3').click(function(){
        $('#choice_3').val('');
        $('#choice_3_id').val('');
        if($('#choice_1').val()!='' && $('#choice_2').val()!='' && $('#choice_3').val()!=''){
            $('#supervisor_choice_form #submit_btn_append').empty();
            $('#supervisor_choice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
        }else{
            $('#supervisor_choice_form #submit_btn_append').empty();
        }
    })

    $('#supervisor_choice_form').submit(function(e){
        e.preventDefault();
        $('#supervisor_choice_form #submit_btn').addClass('disabled');
        $('#supervisor_choice_form #submit_btn').html('Submitting &nbsp;<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type : 'POST',
            url : 'supervisor-choice',
            data: new FormData(this),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success : function(data){
                $('#supervisor_choice_form #submit_btn').removeClass('disabled');
                $('#supervisor_choice_form #submit_btn').html('Submit');
                Swal.fire({
                    position: 'top-mid',
                    type: 'success',
                    title: 'Supervisor choice requested successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=>{
                    $('[data-toggle="select2"]').val(null).trigger('change');
                    $('#supervisor_choice_form #submit_btn_append').empty();
                    $('#supervisor_choice_form').trigger('reset');
                    location.reload();
                })
            },
            error : function(err){
                $('#supervisor_choice_form #submit_btn').removeClass('disabled');
                $('#supervisor_choice_form #submit_btn').html('Submit');
                Swal.fire({
                title: 'Opps!',
                text: 'Something went wrong.',
                type: 'error'
                })
            }
        });
    });


    $('#supervisor_cochoice_form #teacher_faculty').change(function(){
        if($(this).val()!=''){
            $.ajax({
                type : 'GET',
                url : 'get-faculty-teacher/'+$(this).val(),
                dataType: 'JSON',
                success : function(data){
                    $('#supervisor_cochoice_form #supervisor').empty();
                    $('#supervisor_cochoice_form #supervisor').append('<option value="">Please Select</option>');
                    $.each(data.teachers,function(key,value){
                        $('#supervisor_cochoice_form #supervisor').append('<option value="'+value.id+'">'+value.name+','+value.teacher_designation+','+value.teacher_department+'</option>');
                    })
                },
                error : function(error){

                }
            });
        }
    });

    //co supervisor choice
    $('#cochoice_button').click(function(){
        var cochoices = {cochoice_1:'werwr',cochoice_2:'',cochoice_3:''};
        // console.log(cochoices);
        if($('#supervisor_cochoice_form #supervisor').val()!=''){
            
            if($('#cochoice_1').val()==''){
                if($('#cochoice_2').val()==$('#supervisor_cochoice_form #supervisor  option:selected').text() || $('#cochoice_3').val()==$('#supervisor_cochoice_form #supervisor  option:selected').text()){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: 'Same supervisor not allowed',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }else{
                    $('#cochoice_1').val($('#supervisor_cochoice_form #supervisor  option:selected').text());
                    $('#cochoice_1_id').val($('#supervisor_cochoice_form #supervisor').val());
                }
            }else if($('#cochoice_2').val()==''){
                if($('#cochoice_3').val()==$('#supervisor_cochoice_form #supervisor  option:selected').text() || $('#cochoice_1').val()==$('#supervisor_cochoice_form #supervisor  option:selected').text()){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: 'Same supervisor not allowed',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }else{
                    $('#cochoice_2').val($('#supervisor_cochoice_form #supervisor  option:selected').text());
                    $('#cochoice_2_id').val($('#supervisor_cochoice_form #supervisor').val());
                }
                
            }else if($('#cochoice_3').val()==''){
                if($('#cochoice_1').val()==$('#supervisor_cochoice_form #supervisor  option:selected').text() || $('#cochoice_2').val()==$('#supervisor_cochoice_form #supervisor  option:selected').text()){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps !',
                        text: 'Same supervisor not allowed',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }else{
                    $('#cochoice_3').val($('#supervisor_cochoice_form #supervisor  option:selected').text());
                    $('#cochoice_3_id').val($('#supervisor_cochoice_form #supervisor').val());
                }
                
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Opps !',
                    text: 'You cant choose not more then 3 supervisor',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });

            
            }

            if($('#cochoice_1').val()!='' && $('#cochoice_2').val()!='' && $('#cochoice_3').val()!=''){
                $('#supervisor_cochoice_form #submit_btn_append').empty();
                $('#supervisor_cochoice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
            }else{
                $('#supervisor_cochoice_form #submit_btn_append').empty();
            }
            
        }
    });

    //delete co supervisor
    $('.delete_cochoice_1').click(function(){
        $('#cochoice_1').val('');
        $('#cochoice_1_id').val('');
        if($('#cochoice_1').val()!='' && $('#cochoice_2').val()!='' && $('#cochoice_3').val()!=''){
            $('#supervisor_cochoice_form #submit_btn_append').empty();
            $('#supervisor_cochoice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
        }else{
            $('#supervisor_cochoice_form #submit_btn_append').empty();
        }
    })
    $('.delete_cochoice_2').click(function(){
        $('#cochoice_2').val('');
        $('#cochoice_2_id').val('');
        if($('#cochoice_1').val()!='' && $('#cochoice_2').val()!='' && $('#cochoice_3').val()!=''){
            $('#supervisor_cochoice_form #submit_btn_append').empty();
            $('#supervisor_cochoice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
        }else{
            $('#supervisor_cochoice_form #submit_btn_append').empty();
        }
    })
    $('.delete_cochoice_3').click(function(){
        $('#cochoice_3').val('');
        $('#cochoice_3_id').val('');
        if($('#cochoice_1').val()!='' && $('#cochoice_2').val()!='' && $('#cochoice_3').val()!=''){
            $('#supervisor_cochoice_form #submit_btn_append').empty();
            $('#supervisor_cochoice_form #submit_btn_append').append('<button id="submit_btn" class="btn btn-success" type="submit">Submit</button>');
        }else{
            $('#supervisor_cochoice_form #submit_btn_append').empty();
        }
    })

    $('#supervisor_cochoice_form').submit(function(e){
        e.preventDefault();
        $('#supervisor_cochoice_form #submit_btn').addClass('disabled');
        $('#supervisor_cochoice_form #submit_btn').html('Submitting &nbsp;<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type : 'POST',
            url : 'cosupervisor-choice',
            data: new FormData(this),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success : function(data){
                $('#supervisor_cochoice_form #submit_btn').removeClass('disabled');
                $('#supervisor_cochoice_form #submit_btn').html('Submit');
                Swal.fire({
                    position: 'top-mid',
                    type: 'success',
                    title: 'Co-supervisor choice requested successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=>{
                    $('[data-toggle="select2"]').val(null).trigger('change');
                    $('#supervisor_cochoice_form #submit_btn_append').empty();
                    $('#supervisor_cochoice_form').trigger('reset');
                    location.reload();
                })
            },
            error : function(err){
                $('#supervisor_cochoice_form #submit_btn').removeClass('disabled');
                $('#supervisor_cochoice_form #submit_btn').html('Submit');
                Swal.fire({
                title: 'Opps!',
                text: 'Something went wrong.',
                type: 'error'
                })
            }
        });
    });

 </script>
@endsection