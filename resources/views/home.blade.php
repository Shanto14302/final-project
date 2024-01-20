@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Xacton</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if (Auth::user()->role == 5)
                @php
                    $defense = DB::table('phases')
                        ->where('phase_student_id', Auth::user()->id)
                        ->first();
                @endphp

                <div class="row">
                    @if ($defense)
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-primary border-primary">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-dark float-right">Initial Phase @if ($defense->phase_status != 0)
                                                <i class="fas fa-check"></i>
                                            @endif
                                        </span>
                                        <h5 class="card-title mb-0 text-white">Hello ,{{ Auth::user()->name }}</h5>
                                        <p class="text-white">Your title defense will be held soon. Be aware .</p>
                                    </div>
                                    @php
                                        $supervisor = DB::table('supervisors')
                                            ->join('users', 'supervisors.supervisor_student_accepted', 'users.id')
                                            ->join('teachers', 'supervisors.supervisor_student_accepted', 'teachers.teacher_user_id')
                                            ->where('supervisor_student_id', Auth::user()->id)
                                            ->first();
                                        $cosupervisor = DB::table('supervisors')
                                            ->join('users', 'supervisors.cosupervisor_student_accepted', 'users.id')
                                            ->join('teachers', 'supervisors.cosupervisor_student_accepted', 'teachers.teacher_user_id')
                                            ->where('supervisor_student_id', Auth::user()->id)
                                            ->first();
                                    @endphp
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-12">
                                            <h6 class="d-flex align-items-center mb-0 text-white">
                                                Supervisor :
                                                {{ $supervisor->name }},{{ $supervisor->teacher_designation }},{{ $supervisor->teacher_department }}
                                                <br>
                                                Email : {{ $supervisor->email }} <br>
                                                Phone : {{ $supervisor->phone }}
                                            </h6>
                                            <hr class="bg-white">
                                            <h6 class="d-flex align-items-center mb-0 text-white">
                                                Co-supervisor :
                                                {{ $cosupervisor->name }},{{ $cosupervisor->teacher_designation }},{{ $cosupervisor->teacher_department }}
                                                <br>
                                                Email : {{ $cosupervisor->email }} <br>
                                                Phone : {{ $cosupervisor->phone }}
                                            </h6>
                                        </div>

                                    </div>

                                    <div class="progress badge-soft-light shadow-sm" style="height: 1px;">
                                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%;"></div>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col-->
                        @if ($defense->phase_status != 0)
                            <div class="col-md-6 col-xl-3">
                                <div class="card bg-success border-success">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <span class="badge badge-danger float-right">Title Defense @if ($defense->phase_status != 1 && $defense->phase_status != 0)
                                                    <i class="fas fa-check"></i>
                                                @endif
                                            </span>
                                            <h5 class="card-title mb-0 text-white">Hello ,{{ Auth::user()->name }}</h5>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-12">
                                                <h6 class="d-flex align-items-center mb-0 text-white">
                                                    Supervisor :
                                                    {{ $supervisor->name }},{{ $supervisor->teacher_designation }},{{ $supervisor->teacher_department }}
                                                    <br>
                                                    Email : {{ $supervisor->email }} <br>
                                                    Phone : {{ $supervisor->phone }}
                                                </h6>
                                                <hr class="bg-white">
                                                <h6 class="d-flex align-items-center mb-0 text-white">
                                                    Title Defense Date : {{ $defense->phase_title_defence_start_date }} <br>
                                                    Title Defense Time : {{ $defense->phase_title_defence_end_date }} <br>
                                                </h6>
                                                <hr class="bg-white">
                                            </div>

                                            @if ($defense->phase_status == 1)
                                                <div class="col-12 text-center">
                                                    <a href="{{ route('attemp_title_defense') }}" class="btn btn-danger btn-sm text-white"
                                                        style="cursor: pointer;">Attemp</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        @endif
                        @if ($defense->phase_status != 0 && $defense->phase_status != 1)
                            <div class="col-md-6 col-xl-3">
                                <div class="card bg-danger border-danger">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <span class="badge badge-success float-right">Pre Defense @if ($defense->phase_status != 1 && $defense->phase_status != 0 && $defense->phase_status != 2)
                                                    <i class="fas fa-check"></i>
                                                @endif
                                            </span>
                                            <h5 class="card-title mb-0 text-white">Hello ,{{ Auth::user()->name }}</h5>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-12">
                                                <h6 class="d-flex align-items-center mb-0 text-white">
                                                    Supervisor :
                                                    {{ $supervisor->name }},{{ $supervisor->teacher_designation }},{{ $supervisor->teacher_department }}
                                                    <br>
                                                    Email : {{ $supervisor->email }} <br>
                                                    Phone : {{ $supervisor->phone }}
                                                </h6>
                                                <hr class="bg-white">
                                                <h6 class="d-flex align-items-center mb-0 text-white">
                                                    Start : {{ $defense->phase_pre_defence_start_date }} <br>
                                                    Deadline : {{ $defense->phase_pre_defence_end_date }} <br>
                                                </h6>
                                                <hr class="bg-white">
                                            </div>

                                            @if ($defense->phase_status == 2)
                                                <div class="col-12 text-center">
                                                    <a href="{{ route('attemp_pre_defense') }}"class="btn btn-success btn-sm text-white"
                                                        style="cursor: pointer;">Attemp</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        @endif
                        @if ($defense->phase_status != 0 && $defense->phase_status != 1 && $defense->phase_status != 2)
                            <div class="col-md-6 col-xl-3">
                                <div class="card bg-dark border-dark">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <span class="badge badge-danger float-right">Final Defense @if ($defense->phase_status != 1 && $defense->phase_status != 0 && $defense->phase_status != 2 && $defense->phase_status != 3)
                                                    <i class="fas fa-check"></i>
                                                @endif
                                            </span>
                                            <h5 class="card-title mb-0 text-white">Hello ,{{ Auth::user()->name }}</h5>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-12">
                                                <h6 class="d-flex align-items-center mb-0 text-white">
                                                    Supervisor :
                                                    {{ $supervisor->name }},{{ $supervisor->teacher_designation }},{{ $supervisor->teacher_department }}
                                                    <br>
                                                    Email : {{ $supervisor->email }} <br>
                                                    Phone : {{ $supervisor->phone }}
                                                </h6>
                                                <hr class="bg-white">
                                                <h6 class="d-flex align-items-center mb-0 text-white">
                                                    Start : {{ $defense->phase_final_defence_start_date }} <br>
                                                    Deadline : {{ $defense->phase_final_defence_end_date }} <br>
                                                </h6>
                                                <hr class="bg-white">
                                            </div>

                                            @if ($defense->phase_status == 3)
                                                <div class="col-12 text-center">
                                                    <a href="{{ route('attemp_final_defense') }}" class="btn btn-danger btn-sm text-white"
                                                        style="cursor: pointer;">Attemp</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        @endif
                        @if ($defense->phase_status == 4)
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-dark border-dark">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-12">
                                            <h6 class="d-flex align-items-center mb-0 text-white">
                                                Title defense remark :
                                                {{ $defense->phase_title_defence_remark }}
                                                <br>
                                                Pre defense remark : {{ $defense->phase_pre_defence_remark }} <br>
                                                Final defense remark : {{ $defense->phase_final_defence_remark }} <br>
                                                Final result : {{  number_format((float)$defense->phase_final_result, 2, '.', '') }} <br>
                                                Final result date : {{ $defense->phase_final_result_date }} <br>
                                            </h6>
                                            <hr class="bg-white">

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif



                </div>
            @endif

            <!-- end row -->



        </div> <!-- container-fluid -->
    </div>

@endsection

@section('js')
@endsection
