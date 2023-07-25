@extends('layouts.app')
@section('title')
    Access Denied
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <img src="{{ asset('public/files/admin/access-denied.jpg') }}" width="100%" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 mx-auto">
                                <h4 class="text-center text-danger">
                                    <sup><i style="font-size: 12px" class="fas fa-quote-left"></i></sup> There are many lucky people in the world who have the access . Sorry to say that your the unlucky one who doesn't have the access of this beautiful panel. <sup><i style="font-size: 12px" class="fas fa-quote-left fa-rotate-180"></i></sup>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection