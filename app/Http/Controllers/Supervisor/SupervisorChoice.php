<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use App\Models\Supervisor;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorChoice extends Controller
{
    public function SupervisorChoice(){
        $supervisor = Supervisor::where('supervisor_student_id',Auth::user()->id)->first();
        return view('students.supervisor_choice',compact('supervisor'));
    }

    public function GetFacultyTeacher(Request $data){
        $teachers = Teacher::join('users','teachers.teacher_user_id','users.id')->where('teacher_facalty',$data->faculty)->get();
        return [
            'teachers'=>$teachers,
        ];
    }

    public function SupervisorChoiceInsert(Request $data){
        $create = Supervisor::create([
            'supervisor_student_id'=>Auth::user()->id,
            'supervisor_student_choice_1'=>$data->choice_1_id,
            'supervisor_student_choice_2'=>$data->choice_2_id,
            'supervisor_student_choice_3'=>$data->choice_3_id,
        ]);

        if($create){
            return 1;
        }else{
            return response()->json([
                'message'=>'Not inserted',
            ],422);
        }
    }

    public function CosupervisorChoiceInsert(Request $data){
        $create = Supervisor::where('supervisor_student_id',Auth::user()->id)->update([
            // 'supervisor_student_id'=>Auth::user()->id,
            'cosupervisor_student_choice_1'=>$data->cochoice_1_id,
            'cosupervisor_student_choice_2'=>$data->cochoice_2_id,
            'cosupervisor_student_choice_3'=>$data->cochoice_3_id,
        ]);

        if($create){
            return 1;
        }else{
            return response()->json([
                'message'=>'Not inserted',
            ],422);
        }
    }

    public function SupervisorChoiceRequests(){
        $requests = Supervisor::join('students','supervisors.supervisor_student_id','students.student_user_id')->join('users','supervisors.supervisor_student_id','users.id')->get();
        return view('admin.supervisor_choice_request',compact('requests'));
    }

    public function SupervisorChoiceRequestsUpdate(Request $data){
        $requests = Supervisor::where('supervisor_id',$data->ss_id)->update([
            'supervisor_student_accepted'=>$data->supervisor,
            'cosupervisor_student_accepted'=>$data->cosupervisor,
            'supervisor_status'=>'Edited',
            'updated_at'=>Carbon::now(),
        ]);
        $check = Phase::where('phase_row_id',$data->ss_id)->first();
        if(!$check){
            Phase::create([
                'phase_row_id'=>$data->ss_id,
                'phase_student_id'=>$data->student_id,
                'phase_supervisor_id'=>$data->supervisor,
                'phase_cosupervisor_id'=>$data->cosupervisor,
            ]);
        }else{
            Phase::where('phase_row_id',$data->ss_id)->update([
                'phase_supervisor_id'=>$data->supervisor,
                'phase_cosupervisor_id'=>$data->cosupervisor,
            ]);
        }

        return redirect()->back()->with('success',1);
    }
    public function DeleteSupervisor(Request $data){
        Supervisor::where('supervisor_id',$data->id)->delete();
        return redirect()->back()->with('delete',1);
    }

    public function Viewresult(){
        $students = Phase::join('users','phases.phase_student_id','users.id')->join('students','phases.phase_student_id','students.student_user_id')->orderBy('phase_id','DESC')->get();
        return view('admin.view_result_admin',compact('students'));
    }
}
