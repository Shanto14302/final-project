@extends('layouts.app')
@section('title')
    Spark-It Contact
@endsection

@section('css')
    
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
                            <li class="breadcrumb-item active">Contact Information</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Contact Details</h4>
                    </div>
                    
                    <div class="card-body" >
                        <form action="" method="POST" id="update_contact_info_form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Phone Number 1</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $contact->spark_phone_1 }}" name="phone_number_1">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Phone Number 2</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $contact->spark_phone_2 }}" name="phone_number_2">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Phone Number 3</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $contact->spark_phone_3 }}" name="phone_number_3">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Email Address</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="email" class="form-control" value="{{ $contact->spark_email }}" name="email_address">
                                    <label for=""></label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" id="update_contact_info_button" class="btn btn-success form-control">Update Contact Details</button>
                                </div>
                            </div>
                            
                        
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Social Information(Links)</h4>
                    </div>
                    
                    <div class="card-body" >
                        <form action="" method="POST" id="update_social_info_form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Facebook</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $contact->spark_facebook_link }}" name="facebook">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Instagram</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $contact->spark_instagram_link }}" name="instagram">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Youtube</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $contact->spark_youtube_link }}" name="youtube">
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Twitter</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{ $contact->spark_twitter_link }}" name="twitter">
                                    <label for=""></label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" id="update_social_info_button" class="btn btn-info form-control">Update Social Information</button>
                                </div>
                            </div>
                            
                        
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="div-header mt-3">
                        <h4 class="card-title text-center">Address</h4>
                    </div>
                    
                    <div class="card-body" >
                        <form action="" method="POST" id="update_address_form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Location Link</label>
                                </div>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="4" name="location_link">{{ $contact->spark_location_link }}</textarea>
                                    <label for=""></label>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-4">
                                    <label for="" class="lebelcolor">Address</label>
                                </div>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="3" name="address">{{ $contact->spark_address }}</textarea>
                                    <label for=""></label>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" id="update_address_button" class="btn btn-primary form-control">Update Address Details</button>
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
    <script>
        $('#update_contact_info_form').on("submit",function(e){
            e.preventDefault();
            document.getElementById('update_contact_info_button').innerHTML='Updating &nbsp; <i class="mdi mdi-rotate-right mdi-spin"></i>';
            $.ajax({
                type : 'POST',
                url : '{{ route("spark_contact") }}',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                success : function(data){
                    document.getElementById('update_contact_info_button').innerHTML='Update Contact Details';
                    Swal.fire({
                        type: 'success',
                        title: '',
                        text: 'Spark Contact Information Updated Successfully',
                        showConfirmButton: true,
                    })
                },
                error : function(err){
                    document.getElementById('update_contact_info_button').innerHTML='Update Contact Details';
                    Swal.fire({
                        type: 'error',
                        title: '',
                        text: err.responseJSON.message,
                        showConfirmButton: true,
                    })
                }
            });
        });

        $('#update_social_info_form').on("submit",function(e){
            e.preventDefault();
            document.getElementById('update_social_info_button').innerHTML='Updating &nbsp; <i class="mdi mdi-rotate-right mdi-spin"></i>';
            $.ajax({
                type : 'POST',
                url : '{{ route("spark_social") }}',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                success : function(data){
                    document.getElementById('update_social_info_button').innerHTML='Update Social Information';
                    Swal.fire({
                        type: 'success',
                        title: '',
                        text: 'Spark Social Information Updated Successfully',
                        showConfirmButton: true,
                    })
                },
                error : function(err){
                    document.getElementById('update_social_info_button').innerHTML='Update Social Information';
                    Swal.fire({
                        type: 'error',
                        title: '',
                        text: err.responseJSON.message,
                        showConfirmButton: true,
                    })
                }
            });
        });

        $('#update_address_form').on("submit",function(e){
            e.preventDefault();
            document.getElementById('update_address_button').innerHTML='Updating &nbsp; <i class="mdi mdi-rotate-right mdi-spin"></i>';
            $.ajax({
                type : 'POST',
                url : '{{ route("spark_address") }}',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'JSON',
                success : function(data){
                    document.getElementById('update_address_button').innerHTML='Update Address Details';
                    Swal.fire({
                        type: 'success',
                        title: '',
                        text: 'Spark Address Updated Successfully',
                        showConfirmButton: true,
                    })
                },
                error : function(err){
                    document.getElementById('update_address_button').innerHTML='Update Address Details';
                    Swal.fire({
                        type: 'error',
                        title: '',
                        text: err.responseJSON.message,
                        showConfirmButton: true,
                    })
                }
            });
        });
    </script>
@endsection