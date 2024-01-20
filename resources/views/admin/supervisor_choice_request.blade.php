@extends('layouts.app')
@section('title')
    Supervisor Choice
@endsection
@section('css')
    <link href="{{ asset('public/main/plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Supervisor Choice Requests</h4>
                            {{-- <p class="card-subtitle mb-4">
                                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction
                                function:
                                <code>$().DataTable();</code>.
                            </p> --}}

                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Faculty </th>
                                        <th>Department</th>
                                        <th>Batch</th>
                                        <th>Section</th>
                                        <th>Supervisor</th>
                                        <th>Co-supervisor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->student_id }}</td>
                                            <td>{{ $request->student_facalty }}</td>
                                            <td>{{ $request->student_department }}</td>
                                            <td>{{ $request->student_batch }}</td>
                                            <td>{{ $request->student_section }}</td>
                                            @php
                                            if($request->supervisor_student_accepted!=NULL){
                                                $accepted_sup = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->supervisor_student_accepted)->first();
                                            }
                                                
                                            @endphp
                                            <td>@if($request->supervisor_student_accepted!=NULL) {{ $accepted_sup->name }},{{ $accepted_sup->teacher_designation }},{{ $accepted_sup->teacher_department }},{{ $accepted_sup->teacher_facalty }} @else {{ $request->supervisor_student_accepted }} @endif</td>
                                            @php
                                            if($request->cosupervisor_student_accepted!=NULL){
                                                $accepted_cosup = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->cosupervisor_student_accepted)->first();
                                            }
                                                
                                            @endphp
                                            <td>@if($request->cosupervisor_student_accepted!=NULL) {{ $accepted_cosup->name }},{{ $accepted_cosup->teacher_designation }},{{ $accepted_cosup->teacher_department }},{{ $accepted_cosup->teacher_facalty }} @else {{ $request->supervisor_student_accepted }} @endif</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_modal{{ $request->supervisor_id }}"><i
                                                        class="fas fa-chalkboard"></i></a>
                                                        @if ($request->supervisor_status=='Editable')
                                                <a onclick="return confirm('Are you sure want to delete ?')" href="{{ route('delete_supervisor',$request->supervisor_id) }}" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i></a>
                                                        @endif
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-lg" id="edit_modal{{ $request->supervisor_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Select Supervisor</h5>
                                                        <button type="button" class="close waves-effect waves-light"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('supervisor_choice_request') }}" method="POST" >
                                                            @csrf
                                                            <div class="row">
                                                                <input type="hidden" name="ss_id" value="{{ $request->supervisor_id }}">
                                                                <input type="hidden" name="student_id" value="{{ $request->supervisor_student_id }}">
                                                                <div class="form-group col-md-6">
                                                                    @php
                                                                        $sup1 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->supervisor_student_choice_1)->first();
                                                                        $sup2 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->supervisor_student_choice_2)->first();
                                                                        $sup3 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->supervisor_student_choice_3)->first();
                                                                        // if($supervisor->request!=NULL){
                                                                        //     $sup = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$supervisor->supervisor_student_accepted)->first();
                                                                        // }
                                                                    @endphp
                                                                    <label for="" class="labelcolor">Supervisor</label>
                                                                    <select name="supervisor" id="supervisor"
                                                                        class="form-control" data-toggle="select2"
                                                                        style="width: 100%" required>
                                                                        <option value="">Please Select</option>
                                                                        <option value="{{ $sup1->id }}">{{ $sup1->name }},{{ $sup1->teacher_designation }},{{ $sup1->teacher_department }},{{ $sup1->teacher_facalty }}</option>
                                                                        <option value="{{ $sup2->id }}">{{ $sup2->name }},{{ $sup2->teacher_designation }},{{ $sup2->teacher_department }},{{ $sup2->teacher_facalty }}</option>
                                                                        <option value="{{ $sup3->id }}">{{ $sup3->name }},{{ $sup3->teacher_designation }},{{ $sup3->teacher_department }},{{ $sup3->teacher_facalty }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    @php
                                                                        $cosup1 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->cosupervisor_student_choice_1)->first();
                                                                        $cosup2 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->cosupervisor_student_choice_2)->first();
                                                                        $cosup3 = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$request->cosupervisor_student_choice_3)->first();
                                                                        
                                                                    @endphp
                                                                    <label for="" class="labelcolor">Co-supervisor</label>
                                                                    <select name="cosupervisor" id="cosupervisor"
                                                                        class="form-control" data-toggle="select2"
                                                                        style="width: 100%" required>
                                                                        <option value="">Please Select</option>
                                                                        <option value="{{ $cosup1->id }}">{{ $cosup1->name }},{{ $cosup1->teacher_designation }},{{ $cosup1->teacher_department }},{{ $cosup1->teacher_facalty }}</option>
                                                                        <option value="{{ $cosup2->id }}">{{ $cosup2->name }},{{ $cosup2->teacher_designation }},{{ $cosup2->teacher_department }},{{ $cosup2->teacher_facalty }}</option>
                                                                        <option value="{{ $cosup3->id }}">{{ $cosup3->name }},{{ $cosup3->teacher_designation }},{{ $cosup3->teacher_department }},{{ $cosup3->teacher_facalty }}</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" id="update_basic_info_button"
                                                                    class="btn btn-primary waves-effect waves-light">Update
                                                                    Supervisor Info</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('public/main/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/switchery/switchery.min.js') }}"></script>
    <!-- third party js -->
    <script src="{{ asset('public/main/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/main/plugins/datatables/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('public/main/assets/pages/datatables-demo.js') }}"></script>
    <script>
        $('[data-toggle="select2"]').select2();
        $(document).on("click", '#refresh', function() {
            $("#student_type").val('');
            $('[data-toggle="select2"]').val(null).trigger('change');;
        });
    </script>
     @if (Session::get('success'))
     <script>
         $(document).ready(function(){
 
             toastr.options = {
             "closeButton": false,
             "debug": false,
             "newestOnTop": false,
             "progressBar": true,
             "positionClass": "toast-top-right",
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
             toastr["success"]("Supervisor and Co-supervisor selected successfully")
         });
     </script>
     @endif
     @if (Session::get('delete'))
     <script>
         $(document).ready(function(){
 
             toastr.options = {
             "closeButton": false,
             "debug": false,
             "newestOnTop": false,
             "progressBar": true,
             "positionClass": "toast-top-right",
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
             toastr["success"]("Request Deleted successfully")
         });
     </script>
     @endif
@endsection
