@extends('layouts.app')
@section('title')
    Logo
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
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Control Panel</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Control Panel</a></li>
                            <li class="breadcrumb-item active">Logo</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Application Image Manger</h4>
                        <h4 class="card-title text-right mr-3"></h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="web_content_form" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="from-group col-md-6 mt-2">
                                    <label for="" class="labelcolor">Select Position</label>
                                    <select name="position" id="position" class="form-control">
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="admin_top">Admin Top</option>
                                        <option value="admin_bottom">Admin Bottom</option>
                                        <option value="admin_title_image">Admin Title Image</option>
                                    </select>
                                </div>
                                <div class="from-group col-md-6 mt-2">
                                    <label for="" class="labelcolor">Select Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="" selected disabled>Please Select Position First</option>
                                        
                                    </select>
                                </div>
                                <div class="from-group col-md-12 mt-2" id="upload_type">
                                    
                                </div>
                                <div class="from-group col-md-12 mt-3">
                                    <button class="btn btn-success float-right" id="web_content_buuton" type="submit" >ADD INFORMATION</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('js')
    <script src="{{ asset('public/main/plugins/dropify/dropify.min.js')}}"></script>
    <script src="{{ asset('public/main/assets/pages/fileuploads-demo.js')}}"></script>
    <script src="{{ asset('resources/js/admin/logo.js') }}"></script>

    <script>
        // function content_form(){
        //     var flag = 0;
        //     var position = $('#position').val();
        //     var type = $('#type').val();
        //     if(!position){
        //         flag=1;
        //         Swal.fire({
        //             type: 'error',
        //             title: '',
        //             text: 'Position required',
        //             showConfirmButton: true,
        //         })
        //     }else{
        //         flag=0;
        //     }
        //     if(!type){
        //         flag=1;
        //         Swal.fire({
        //             type: 'error',
        //             title: '',
        //             text: 'Type required',
        //             showConfirmButton: true,
        //         })
        //     }else{
        //         flag=0;
        //     }
        //     if(type=='image'){
        //         if(!$('#image').val()){
        //             flag=1;
        //             Swal.fire({
        //                 type: 'error',
        //                 title: '',
        //                 text: 'Image required',
        //                 showConfirmButton: true,
        //             })
        //         }else{
        //             var Extension = $('#image').val().substring($('#image').val().lastIndexOf('.') + 1).toLowerCase();
        //             if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
        //                 flag = 0;
                       
        //             }else{
        //                 flag = 1;
        //                 Swal.fire({
        //                     type: 'error',
        //                     title: '',
        //                     text: 'Image should be [png,jpg,jpeg]',
        //                     showConfirmButton: true,
        //                 })
        //             }
        //         }
                
                
        //     }
        //     if(flag==0){

        //     }
        // }
        $('#web_content_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                type : 'POST',
                url : '{{ route("upload_logo") }}',
                data: new FormData(this),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success : function(data){

                },
                error : function(err){
                    console.log(err.responseJSON.message);
                }
            })
        })
    </script>
@endsection