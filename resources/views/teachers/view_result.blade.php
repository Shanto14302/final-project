@extends('layouts.app')
@section('title')
    results
@endsection
@section('css')
    <link href="{{ asset('public/main/plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Results</h4>
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
                                        <th>Co-supervisor</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->name }}<br> Email : {{ $student->email }} <br> Phone : {{ $student->phone }}</td>
                                            <td>{{ $student->student_id }}</td>
                                            <td>{{ $student->student_facalty }}</td>
                                            <td>{{ $student->student_department }}</td>
                                            <td>{{ $student->student_batch }}</td>
                                            <td>{{ $student->student_section }}</td>
                                            @php
                                            if($student->phase_cosupervisor_id!=NULL){
                                                $accepted_cosup = DB::table('users')->join('teachers','users.id','teachers.teacher_user_id')->where('id',$student->phase_cosupervisor_id)->first();
                                            }

                                            @endphp
                                            <td>@if($student->phase_cosupervisor_id!=NULL) {{ $accepted_cosup->name }},{{ $accepted_cosup->teacher_designation }},{{ $accepted_cosup->teacher_department }},{{ $accepted_cosup->teacher_facalty }} <br> Email : {{ $accepted_cosup->email }} <br> Phone : {{ $accepted_cosup->phone }} @else {{ $student->supervisor_student_accepted }} @endif</td>
                                            <td>
                                                Date : {{ $student->phase_final_defence_start_date }} <br>
                                                Time : {{ $student->phase_final_defence_end_date }}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#accept_title_modal{{ $student->phase_id }}">View</a>

                                            </td>
                                        </tr>


                                        {{-- Accept title modal --}}
                                        <div class="modal fade bd-example-modal" id="accept_title_modal{{ $student->phase_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                        <button type="button" class="close waves-effect waves-light"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <input type="hidden" name="phase_id" value="{{ $student->phase_id }}">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label for="">Type</label>
                                                                    <select name="defense_type" id="" class="form-control" required readonly disabled>
                                                                        <option value="Project" @if($student->phase_title_defense_type=='Project') selected @endif>Project</option>
                                                                        <option value="Research" @if($student->phase_title_defense_type=='Research') selected @endif>Research</option>
                                                                        <option value="Research based project" @if($student->phase_title_defense_type=='Research based project') selected @endif>Research based project</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <label for="">Topic</label>
                                                                    <input type="text" name="topic" class="form-control" value="{{ $student->phase_defence_topic }}" required readonly disabled>
                                                                </div>
                                                                <div class="col-lg-12 mt-2">
                                                                    <label for="">Title defense remark</label>
                                                                    <input type="number" min="0" max="100" name="remark" class="form-control" value="{{ $student->phase_title_defence_remark }}" readonly disabled>
                                                                </div>

                                                                <div class="col-lg-12 mt-2">
                                                                    <label for="">Pre defense remark</label>
                                                                    <input type="number" min="0" max="100" name="remark" class="form-control" value="{{ $student->phase_pre_defence_remark }}" readonly disabled>
                                                                </div>
                                                                <div class="col-lg-12 mt-2">
                                                                    <label for="">Final defense remark</label>
                                                                    <input type="number" min="0" max="100" name="remark" class="form-control" value="{{ $student->phase_final_defence_remark }}" readonly disabled>
                                                                </div>
                                                                <div class="col-lg-12 mt-2">
                                                                    <label for="">Final Result</label>
                                                                    <input type="number" min="0" max="100" name="remark" class="form-control" value="{{  number_format((float)$student->phase_final_result, 2, '.', '') }}" readonly disabled>
                                                                </div>
                                                            </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                <tbody>


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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
        $(document).ready(function() {
            $('#summernote').summernote();
        });
        $(document).ready(function() {
            $('#summernote2').summernote();
        });
        $(document).ready(function() {
            $('#summernote3').summernote();
        });
        $(document).ready(function() {
            $('#summernote4').summernote();
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
             "finalventDuplicates": false,
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
             toastr["success"]("Data updated successfully")
         });
     </script>
     @endif
     @if (Session::get('success_update'))
     <script>
         $(document).ready(function(){

             toastr.options = {
             "closeButton": false,
             "debug": false,
             "newestOnTop": false,
             "progressBar": true,
             "positionClass": "toast-top-right",
             "finalventDuplicates": false,
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
             toastr["success"]("Result published successfully")
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
             "finalventDuplicates": false,
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
