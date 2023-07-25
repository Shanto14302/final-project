@extends('layouts.app')
@section('title')
    Reset Password Requests
@endsection
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('public/main/plugins/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/main/plugins/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .dt-buttons{
            margin-bottom: 20px;
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
                        <h4 class="mb-0 font-size-18 text-uppercase">Reset Password Request</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Datatables</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>     
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center mb-4">Search Keys</h4>
                           <form action="" method="POST" id="reset_request_form">
                            @csrf
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="">Start Date</label>
                                        <input type="date" id="start_date" onchange="create_end_date(this.value)" max="{{ date("Y-m-d") }}" name="start_date" class="form-control">

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">End Date</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">User Email</label>
                                        <input type="email" name="user_email" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3 pt-4">
                                        <button type="submit" id="reset_request_search" class="btn btn-success form-control mt-1">Search </button>
                                    </div>
                                </div>
                            </form> 
                            <div class="form-group col-md-1 float-right ">
                                <button type="button" id="reset_request_form_reset" onclick="reset_form()" class="btn btn-sm btn-outline-danger mt-1 ml-4" >Reset <i class="fas fa-sync-alt"></i> </button>
                            </div>
                            <script>
                                function create_end_date(x){
                                    $('#end_date').removeAttr('readonly');
                                    $('#end_date').attr('min',x);
                                }
                                function reset_form(){
                                    $('#end_date').attr('readonly','readonly');
                                    $("#reset_request_form")[0].reset()
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>  
            <!-- end page title -->
 
            <div class="row" id="reset_request_results_div" style="display:none">
                <div class="col-12">
                    <div class="card">
                       
                        <div class="card-body" id="reset_request_results">
                            
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div>
    </div>
@endsection
@section('js')
 <!-- third party js -->
 <script src="{{ asset('public/main/plugins/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/dataTables.responsive.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/dataTables.buttons.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/buttons.html5.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/buttons.flash.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/buttons.print.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/dataTables.select.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/pdfmake.min.js')}}"></script>
 <script src="{{ asset('public/main/plugins/datatables/vfs_fonts.js')}}"></script>
 <!-- third party js ends -->


 <!-- Datatables init -->
 {{-- <script src="{{ asset('public/main/assets/pages/datatables-demo.js')}}"></script>    --}}

 <script src="{{ asset('resources/js/admin/reset_request.js') }}"></script>
@endsection