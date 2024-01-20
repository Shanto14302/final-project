@extends('layouts.app')

@section('title')
    Spark-It Main Slider
@endsection

@section('css')
<link href="{{ asset('public/main/plugins/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Spark It Solution</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Spark It Solution</a></li>
                            <li class="breadcrumb-item active">Main Slider</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Slider Headline</h4>
                    </div>
                    
                    <div class="card-body" >
                        <form action="" id="slider_headline_form" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Slider Title</label>
                                <textarea name="slider_title" class="form-control" id="" cols="30" rows="6">{{ $main_slider_headline->spark_main_slider_headline }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Slider Sub-title</label>
                                <textarea name="slider_sub_title" class="form-control" id="" cols="30" rows="6">{{ $main_slider_headline->spark_main_slider_sub_title }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="slider_headline_button" class="btn btn-success float-right">Update Headline</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Slider Images</h4>
                    </div>
                    
                    <div class="card-body" >
                        <form action="" id="slider_images_form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Upload Image (Height : 500px)</label>
                                <input type="file" class="dropify" data-height="290" name="slider_image_update" id="slider_image_update" accept="image/png, image/jpeg,image/jpeg"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="slider_images_button" class="btn btn-success float-right">Upload Slider Image</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>

            <div class="col-xl-4 mx-auto">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">All Slider Images</h4>
                        <p class="card-subtitle mb-4"></p>
                        
                        <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($main_sliders as $main_slider)
                                @php
                                    $i++;
                                @endphp
                                    <div class="carousel-item {{ $i==1?'active':'' }}" id="div-{{ $main_slider->spark_main_slider_id }}">
                                        <img class="mx-auto" src="{{ asset($main_slider->spark_main_slider_image) }}" height="100%" width="100%" alt="..." class="d-block img-fluid">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p id="{{ $main_slider->spark_main_slider_id }}"><button data-status="{{ $main_slider->spark_main_slider_id }}" data-status_value="{{ $main_slider->spark_main_slider_status }}"  class="btn btn-sm btn-dark status_change">{{ $main_slider->spark_main_slider_status }}</button><button  data-delete="{{ $main_slider->spark_main_slider_id }}" class="btn btn-sm btn-danger ml-2 delete-slide">Delete</button></p>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('public/main/plugins/dropify/dropify.min.js')}}"></script>
<script src="{{ asset('public/main/assets/pages/fileuploads-demo.js')}}"></script>


<script src="{{ asset('resources/js/admin/profile/profile_update.js')}}"></script>

<script>
    $('#slider_headline_form').on("submit",function(e){
        e.preventDefault();
        document.getElementById('slider_headline_button').innerHTML='Updating &nbsp; <i class="mdi mdi-rotate-right mdi-spin"></i>';
        $('#slider_headline_button').addClass('disabled');
        $.ajax({
            type : 'POST',
            url : '{{ route("spark_main_slider_headline") }}',
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){
                $('#slider_headline_button').removeClass('disabled');
                document.getElementById('slider_headline_button').innerHTML='Update Headline';
                Swal.fire({
                    type: 'success',
                    title: '',
                    text: 'Spark Main Slider Headline Updated Successfully',
                    showConfirmButton: true,
                })
            },
            error : function(err){
                $('#slider_headline_button').removeClass('disabled');
                document.getElementById('slider_headline_button').innerHTML='Update Headline';
                Swal.fire({
                    type: 'error',
                    title: '',
                    text: err.responseJSON.message,
                    showConfirmButton: true,
                })
            }
        });
    })
    $('#slider_images_form').on("submit",function(e){
        e.preventDefault();
        document.getElementById('slider_images_button').innerHTML='Updating &nbsp; <i class="mdi mdi-rotate-right mdi-spin"></i>';
        $('#slider_images_button').addClass('disabled');
        $.ajax({
            type : 'POST',
            url : '{{ route("spark_main_slider_image") }}',
            data: new FormData(this),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success : function(data){
                $('#slider_images_button').removeClass('disabled');
                document.getElementById('slider_images_button').innerHTML='Upload Slider Image';
                Swal.fire({
                    type: 'success',
                    title: '',
                    text: 'Spark Main Slider Image Uploaded Successfully',
                    showConfirmButton: true,
                }).then(()=>{
                    $('#slider_images_form').trigger("reset");
                })
            },
            error : function(err){
                $('#slider_images_button').removeClass('disabled');
                document.getElementById('slider_images_button').innerHTML='Upload Slider Image';
                Swal.fire({
                    type: 'error',
                    title: '',
                    text: err.responseJSON.message,
                    showConfirmButton: true,
                })
            }
        });
    })

    $(document).on("click",".status_change",function(){
        var iid = $(this).closest('p').attr('id');
        
        $.ajax({
            type : 'GET',
            url : 'spark-main-slider-image-staus/'+$(this).data('status')+'/'+$(this).data('status_value'),
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){
                Swal.fire({
                    type: 'success',
                    title: '',
                    text: 'Spark Main Slider Updated Successfully',
                    showConfirmButton: true,
                }).then(()=>{
                    document.getElementById(iid).innerHTML='<button data-status="'+data.value.spark_main_slider_id+'" data-status_value="'+data.status+'"  class="btn btn-sm btn-dark status_change">'+data.status+'</button><button data-delte="'+data.value.spark_main_slider_id+'" class="btn btn-sm btn-danger ml-2">Delete</button>';
                });
            },
            error : function(err){
                // $('#slider_headline_button').removeClass('disabled');
                // document.getElementById('slider_headline_button').innerHTML='Update Headline';
                Swal.fire({
                    type: 'error',
                    title: '',
                    text: err.responseJSON.message,
                    showConfirmButton: true,
                })
            }
        });
    })

    $(document).on("click",".delete-slide",function(){
        var iid = $(this).data('delete');
        
        $.ajax({
            type : 'GET',
            url : 'spark-main-slider-image-delete/'+$(this).data('delete'),
            data: $(this).serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            success : function(data){
                Swal.fire({
                    type: 'success',
                    title: '',
                    text: 'Spark Main Slider Deleted Successfully',
                    showConfirmButton: true,
                }).then(()=>{
                    document.getElementById("div-"+iid).style.display="none";
                });
            },
            error : function(err){
                // $('#slider_headline_button').removeClass('disabled');
                // document.getElementById('slider_headline_button').innerHTML='Update Headline';
                Swal.fire({
                    type: 'error',
                    title: '',
                    text: err.responseJSON.message,
                    showConfirmButton: true,
                })
            }
        });
    })
</script>
@endsection