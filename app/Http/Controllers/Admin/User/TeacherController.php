<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Mail\User\UserMail;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    public function GetTeacher(){
        $teachers = User::where('role',4)->orderBy('name','ASC')->get();
        return view('teachers.all_teachers',compact('teachers'));
    }

    public function AddTeacher(Request $data){
        $data->validate([
            'teacher_name'=>'required',
            'teacher_email'=>'required|email|unique:users,email',
            'teacher_phone'=>'required|max:15|unique:users,phone',
            'teacher_id'=>'required|unique:teachers,teacher_id',
            'teacher_facalty'=>'required',
            'teacher_department'=>'required',
            'teacher_designation'=>'required',
            'password'=>'required',
            'rpassword'=>'required|same:password',
        ]);

        $create_user = User::create([
            'name' => $data->teacher_name,
            'email' => $data->teacher_email,
            'phone' => $data->teacher_phone,
            'role' => 4,
            'password' => Hash::make($data->password),
        ]);
        $last =  DB::getPdo()->lastInsertId();
        $create_teacher = Teacher::create([
            'teacher_user_id' => $last,
            'teacher_id' => $data->teacher_id,
            'teacher_facalty' => $data->teacher_facalty,
            'teacher_department' => $data->teacher_department,
            'teacher_designation' =>$data->teacher_designation,
        ]);

        if($create_user && $create_teacher){
            return ['message'=>1];
        }else{
            return response()->json(['message'=>1],422);
        }
    }

    public function SearchTeacher(Request $data){
        $teachers = User::where('role','=',4)->join('teachers','users.id','teachers.teacher_user_id')->where('delete',0);

        if($data->teacher_facalty!='' && $data->teacher_facalty!='all'){
            $teachers = $teachers->where('teachers.teacher_facalty',$data->teacher_facalty);
        }
        if($data->teacher_name!='' && $data->teacher_name!='all'){
            $teachers = $teachers->where('name','LIKE','%'.$data->teacher_name.'%');
        }
        if($data->teacher_email!='' && $data->teacher_email!='all'){
            $teachers = $teachers->where('email',$data->teacher_email);
        }
        if($data->teacher_id!='' && $data->teacher_id!='all'){
            $teachers = $teachers->where('id',$data->teacher_id);
        }

        $teachers = $teachers->get();
        $count = $teachers->count();
        return response()->json([
            'teachers' => $teachers,
            'count' => $count,
        ],200);
    }

    public function UpdateTeacherStaus(Request $data){
        $user = User::where('id',$data->id)->first();
        $status = '';
        if($user->status=='Active'){
            User::where('id',$data->id)->update([
                'status' => 'Deactive',
            ]);
            $status = 'Deactive';
        }else{
            User::where('id',$data->id)->update([
                'status' => 'Active',
            ]);
            $status = 'Active';
        }

        return response()->json([
            'teacher' => $user,
            'status' => $status,
        ],200);
    }

    public function GetTeacherInfo(Request $data){
        $user = User::leftJoin('teachers','users.id','teachers.teacher_user_id')->where('id',$data->id)->first();
        return $user;
    }

    public function UpdateBasicInfo(Request $data){
        $data->validate([
            'teacher_name'=>'required',
            'teacher_email'=>'required|email',
            'teacher_phone'=>'required|max:15',
            'teacher_id'=>'required',
            'teacher_facalty'=>'required',
            'teacher_department'=>'required',
            'teacher_designation'=>'required'
        ]);

        $update = User::where('id',$data->basic_teacher_id)->update([
            'name' => $data->teacher_name,
            'email' => $data->teacher_email,
            'phone' => $data->teacher_phone,
            'updated_at'=>Carbon::now(),
        ]);
        $update_teacher = Teacher::where('teacher_user_id',$data->basic_teacher_id)->update([
            'teacher_id' => $data->teacher_id,
            'teacher_facalty' => $data->teacher_facalty,
            'teacher_department' => $data->teacher_department,
            'teacher_designation' =>$data->teacher_designation,
        ]);

        $user = User::leftJoin('teachers','users.id','teachers.teacher_user_id')->where('id',$data->basic_teacher_id)->first();

        if($update){
            return [
                'message' => 1,
                'teacher' => $user,
            ];
        }else{
            return [
                'message' => 0,
            ];
        }
    }

    public function DeleteTeacher(Request $data){
        if($data->id){
            $update = User::where('id',$data->id)->update([
                'delete' =>1,
                'updated_at' => Carbon::now(),
            ]);

            if($update){
                return [
                    'message' => 1,
                    'teacher' => request()->id,
                ];
            }else{
                return [
                    'message' => 0,
                    'teacher' => request()->id,
                ];
            }

        }
    }

    public function MailToTeacher(Request $data){
        $user_email = User::where('id',$data->teacher_idm)->select('email')->first();

        $mail = Mail::to($user_email->email)->send(new UserMail($data->mail_subject,$data->mail_body));
        if($mail){
            return [
                'message'=>1,
            ];
        }else{
            return response()->json([
                'message'=>0,
            ],422);
        }
    }
}
