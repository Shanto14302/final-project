@extends('layouts.app')
@section('title')
Attemp Pre Defense
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
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="card-title">Pre Defense Information</h4>
                                    <hr>
                                    <h6 class="card-title">Supervisor : {{ $student->name }} , {{ $student->teacher_designation }} , {{ $student->teacher_department }}</h6>
                                    <h6 class="card-title">Email : {{ $student->email }}</h6>
                                    <h6 class="card-title">Phone : {{ $student->phone }}</h6>
                                    <h6 class="card-title"><u>Supervisor Instruction</u></h6>

                                    <p>
                                        {!! $student->phase_pre_defence_instruction !!}
                                    </p>
                                </div>
                                @if($student->phase_status==2)
                                <div class="col-lg-6">
                                    <h4 class="card-title">Pre Defense Form</h4>
                                    <hr>
                                    @if ($student->phase_pre_defence_file==NULL && $student->phase_pre_defence_start_date>=date('Y-m-d'))


                                    <form action="{{ route('attemp_pre_defense') }}" class="theme-form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="phase_id" value="{{ $student->phase_id }}">

                                            <div class="form-group col-lg-12">
                                                <label for="">Topic</label>
                                                <input type="text" class="form-control" name="topic"  value="{{ $student->phase_defence_topic }}" required readonly>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label for="">Description</label>
                                                <textarea class="form-control" id="summernote" name="description" required>

                                                </textarea>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="">Slide</label>
                                                <input type="file" class="form-control" name="slide" accept=".pdf,.ppt,.pptx" required>
                                                @error('slide')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <button type="submit" class="btn btn-success float-right" >Submit</button>
                                        </div>
                                    </form>
                                    @else
                                        @if ($student->phase_pre_defence_start_date<date('Y-m-d'))
                                        <h4 class="card-title">Date over</h4>

                                        @else
                                        <h4 class="card-title">Already submitted</h4>
                                        @endif
                                        <div class="row">

                                            <div class="col-lg-6 mt-2">
                                                {{-- <label for="">Download Slide</label> --}}
                                                <a target="__blank" href="{{ asset($student->phase_pre_defence_file) }}" class="btn btn-info btn-sm mt-4"> Click here to download slide</a>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <label for="">Topic</label>
                                                <input type="text" name="topic" class="form-control" value="{{ $student->phase_defence_topic }}" readonly>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <label for="">Description</label>
                                                <textarea name="description" id="summernote4" class="form-control" readonly disabled>{!! $student->phase_pre_defence_description !!}</textarea>
                                            </div>

                                        </div>

                                    @endif
                                </div>
                                @elseif($student->phase_status==0)
                                Your are in initial phase
                                @elseif($student->phase_status==1)
                                Your are in title defense
                                @else
                                <div class="col-lg-6">
                                    <h4 class="card-title">Pre defense successfully completed</h4>
                                    <div class="row">

                                        <div class="col-lg-6 mt-2">
                                            {{-- <label for="">Download Slide</label> --}}
                                            <a target="__blank" href="{{ asset($student->phase_pre_defence_file) }}" class="btn btn-info btn-sm mt-4"> Click here to download slide</a>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <label for="">Topic</label>
                                            <input type="text" name="topic" class="form-control" value="{{ $student->phase_defence_topic }}" readonly>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <label for="">Description</label>
                                            <textarea name="description" id="summernote4" class="form-control" readonly disabled>{!! $student->phase_pre_defence_description !!}</textarea>
                                        </div>

                                    </div>
                                </div>
                                @endif
                            </div>

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
            $('#summernote4').summernote('disable');
        });
        $(document).ready(function() {
            $('#summernote5').summernote('disable');
        });
        $(document).ready(function() {
            $('#summernote6').summernote('disable');
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
             toastr["success"]("Pre defense data updated successfully")
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
