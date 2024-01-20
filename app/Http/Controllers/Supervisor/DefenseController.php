<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefenseController extends Controller
{
    public function InitialPhase(){
        $students = Phase::join('users','phases.phase_student_id','users.id')->join('students','phases.phase_student_id','students.student_user_id')->where('phase_supervisor_id',Auth::user()->id)->where('phase_status',0)->get();
        return view('teachers.initial_phase',compact('students'));
    }

    public function InitialPhaseInsert(Request $data){
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_title_defence_start_date'=>$data->start_date,
            'phase_title_defence_end_date'=>$data->end_date,
            'phase_title_defense_instruction'=>$data->instruction,
            'phase_title_defence_status'=>'Title',
            'phase_status'=>1,
        ]);
        return redirect()->back()->with('success',1);
    }

    public function TitleDefense(){
        $students = Phase::join('users','phases.phase_student_id','users.id')->join('students','phases.phase_student_id','students.student_user_id')->where('phase_supervisor_id',Auth::user()->id)->where('phase_status',1)->get();
        return view('teachers.title_defense',compact('students'));
    }

    public function TitleDefenseUpdate(Request $data){
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_defence_topic'=>$data->topic,
            'phase_title_defense_type'=>$data->defense_type,
            'phase_title_defense_description'=>$data->description,
            'phase_title_defense_objective'=>$data->objective,
            'phase_title_defense_motivation'=>$data->motivation,
            'phase_title_defence_remark'=>$data->remark,

        ]);
        return redirect()->back()->with('success',1);
    }

    public function TitleDefenseStatusUpdate(Request $data){
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_title_defence_status'=>'Taken',
            'phase_pre_defence_start_date'=>$data->start_date,
            'phase_pre_defence_end_date'=>$data->end_date,
            'phase_pre_defence_status'=>'Pre',
            'phase_pre_defence_instruction'=>$data->instruction,
            'phase_status'=>2,
            'updated_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with('success_update',1);
    }

    public function PreDefense(){
        $students = Phase::join('users','phases.phase_student_id','users.id')->join('students','phases.phase_student_id','students.student_user_id')->where('phase_supervisor_id',Auth::user()->id)->where('phase_status',2)->get();
        return view('teachers.pre_defense',compact('students'));
    }

    public function PreDefenseUpdate(Request $data){
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_defence_topic'=>$data->topic,
            'phase_title_defense_type'=>$data->defense_type,
            'phase_pre_defence_description'=>$data->description,
            'phase_pre_defence_remark'=>$data->remark,

        ]);
        return redirect()->back()->with('success',1);
    }

    public function PreDefenseStatusUpdate(Request $data){
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_pre_defence_status'=>'Taken',
            'phase_final_defence_start_date'=>$data->start_date,
            'phase_final_defence_end_date'=>$data->end_date,
            'phase_final_defence_status'=>'Final',
            'phase_final_defence_instruction'=>$data->instruction,
            'phase_status'=>3,
            'updated_at'=>Carbon::now(),
        ]);

        return redirect()->back()->with('success_update',1);
    }

    public function FinalDefense(){
        $students = Phase::join('users','phases.phase_student_id','users.id')->join('students','phases.phase_student_id','students.student_user_id')->where('phase_supervisor_id',Auth::user()->id)->where('phase_status',3)->get();
        return view('teachers.final_defense',compact('students'));
    }

    public function FinalDefenseUpdate(Request $data){
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_defence_topic'=>$data->topic,
            'phase_title_defense_type'=>$data->defense_type,
            'phase_final_defence_description'=>$data->description,
            'phase_final_defence_remark'=>$data->remark,

        ]);
        return redirect()->back()->with('success',1);
    }

    public function PublishFinalResult(Request $data){
        $phase = Phase::where('phase_id',$data->phase_id)->first();
        $result = ($phase->phase_title_defence_remark+$phase->phase_pre_defence_remark+$phase->phase_final_defence_remark)/3;
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_final_defence_status'=>'Taken',
            'phase_status'=>4,
            'phase_final_result'=>$result,
            'phase_final_result_date'=>Carbon::now(),

        ]);

        return redirect()->back()->with('success_update',1);
    }

    public function Viewresult(){
        $students = Phase::join('users','phases.phase_student_id','users.id')->join('students','phases.phase_student_id','students.student_user_id')->where('phase_supervisor_id',Auth::user()->id)->orderBy('phase_id','DESC')->get();
        return view('teachers.view_result',compact('students'));
    }

    //student
    public function AttempTitleDefense(){
        $student = Phase::join('users','phases.phase_supervisor_id','users.id')->join('teachers','phases.phase_supervisor_id','teachers.teacher_user_id')->where('phase_student_id',Auth::user()->id)->first();
        return view('students.attemp_title_defense',compact('student'));
    }
    public function AttempTitleDefenseInsert(Request $data){
        $data->validate([
            'slide'=>'required|mimes:pdf,pptx,ppt',
        ]);
        $file = $data->file('slide');
        $extension = $file->getClientOriginalExtension();
        $file_name = Auth::user()->id."-".time().'.'.$extension;
        $file->move(public_path('files/title_defense'),$file_name);
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_defence_topic'=>$data->topic,
            'phase_title_defense_type'=>$data->defense_type,
            'phase_title_defense_description'=>$data->description,
            'phase_title_defense_objective'=>$data->objective,
            'phase_title_defense_motivation'=>$data->motivation,
            'phase_title_defence_file'=>'public/files/title_defense/'.$file_name,
        ]);

        return redirect()->back()->with('success',1);
    }



    public function AttempPreDefense(){
        $student = Phase::join('users','phases.phase_supervisor_id','users.id')->join('teachers','phases.phase_supervisor_id','teachers.teacher_user_id')->where('phase_student_id',Auth::user()->id)->first();
        return view('students.attemp_pre_defense',compact('student'));
    }

    public function AttempPreDefenseInsert(Request $data){
        $data->validate([
            'slide'=>'required|mimes:pdf,pptx,ppt',
        ]);
        $file = $data->file('slide');
        $extension = $file->getClientOriginalExtension();
        $file_name = Auth::user()->id."-".time().'.'.$extension;
        $file->move(public_path('files/pre_defense'),$file_name);
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_pre_defence_description'=>$data->description,
            'phase_pre_defence_file'=>'public/files/pre_defense/'.$file_name,
        ]);

        return redirect()->back()->with('success',1);
    }

    public function AttempFinalDefense(){
        $student = Phase::join('users','phases.phase_supervisor_id','users.id')->join('teachers','phases.phase_supervisor_id','teachers.teacher_user_id')->where('phase_student_id',Auth::user()->id)->first();
        return view('students.attemp_final_defense',compact('student'));
    }

    public function AttempFinalDefenseInsert(Request $data){
        $data->validate([
            'slide'=>'required|mimes:pdf,pptx,ppt',
        ]);
        $file = $data->file('slide');
        $extension = $file->getClientOriginalExtension();
        $file_name = Auth::user()->id."-".time().'.'.$extension;
        $file->move(public_path('files/final_defense'),$file_name);
        $update = Phase::where('phase_id',$data->phase_id)->update([
            'phase_final_defence_description'=>$data->description,
            'phase_final_defence_file'=>'public/files/final_defense/'.$file_name,
        ]);

        return redirect()->back()->with('success',1);
    }

}
