<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Mail\User\UserMail;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function GetStudent(){
        $students = User::join('students','users.id','students.student_user_id')->where('role',5)->orderBy('name','ASC')->get();
        return view('students.all_students',compact('students'));
    }

    public function AddStudent(Request $data){
        $data->validate([
            'student_name'=>'required',
            'student_email'=>'required|email|unique:users,email',
            'student_phone'=>'required|max:15|unique:users,phone',
            'student_id'=>'required|unique:students,student_id',
            'student_facalty'=>'required',
            'student_department'=>'required',
            'student_batch'=>'required',
            'student_section'=>'required',
            'password'=>'required',
            'rpassword'=>'required|same:password',
        ]);

        $create_user = User::create([
            'name' => $data->student_name,
            'email' => $data->student_email,
            'phone' => $data->student_phone,
            'role' => 5,
            'password' => Hash::make($data->password),
        ]);
        $last =  DB::getPdo()->lastInsertId();
        $create_student = Student::create([
            'student_user_id' => $last,
            'student_id' => $data->student_id,
            'student_facalty' => $data->student_facalty,
            'student_department' => $data->student_department,
            'student_batch' =>$data->student_batch,
            'student_section' =>$data->student_section,
        ]);

        if($create_user && $create_student){
            return ['message'=>1];
        }else{
            return response()->json(['message'=>1],422);
        }
    }

    public function SearchStudent(Request $data){
        $students = User::join('students','users.id','students.student_user_id')->where('role','=',5)->where('delete',0);

        if($data->student_facalty!='' && $data->student_facalty!='all'){
            $students = $students->where('students.student_facalty',$data->student_facalty);
        }
        if($data->student_name!='' && $data->student_name!='all'){
            $students = $students->where('name','LIKE','%'.$data->student_name.'%');
        }
        if($data->student_email!='' && $data->student_email!='all'){
            $students = $students->where('email',$data->student_email);
        }
        if($data->student_id!='' && $data->student_id!='all'){
            $students = $students->where('id',$data->student_id);
        }

        $students = $students->get();
        $count = $students->count();
        return response()->json([
            'students' => $students,
            'count' => $count,
        ],200);
    }

    public function UpdateStudentStaus(Request $data){
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
            'student' => $user,
            'status' => $status,
        ],200);
    }

    public function GetStudentInfo(Request $data){
        $user = User::leftJoin('students','users.id','students.student_user_id')->where('id',$data->id)->first();
        return $user;
    }

    public function UpdateBasicInfo(Request $data){
        $data->validate([
            'student_name'=>'required',
            'student_email'=>'required|email',
            'student_phone'=>'required|max:15',
            'student_id'=>'required',
            'student_facalty'=>'required',
            'student_department'=>'required',
            'student_batch'=>'required',
            'student_section'=>'required',
        ]);

        $update = User::where('id',$data->basic_student_id)->update([
            'name' => $data->student_name,
            'email' => $data->student_email,
            'phone' => $data->student_phone,
            'updated_at'=>Carbon::now(),
        ]);
        $update_student = student::where('student_user_id',$data->basic_student_id)->update([
            'student_id' => $data->student_id,
            'student_facalty' => $data->student_facalty,
            'student_department' => $data->student_department,
            'student_batch' =>$data->student_batch,
            'student_section' =>$data->student_section,
        ]);

        $user = User::leftJoin('students','users.id','students.student_user_id')->where('id',$data->basic_student_id)->first();

        if($update){
            return [
                'message' => 1,
                'student' => $user,
            ];
        }else{
            return [
                'message' => 0,
            ];
        }
    }

    public function DeleteStudent(Request $data){
        if($data->id){
            $update = User::where('id',$data->id)->update([
                'delete' =>1,
                'updated_at' => Carbon::now(),
            ]);

            if($update){
                return [
                    'message' => 1,
                    'student' => request()->id,
                ];
            }else{
                return [
                    'message' => 0,
                    'student' => request()->id,
                ];
            }

        }
    }

    public function MailToStudent(Request $data){
        $user_email = User::where('id',$data->student_idm)->select('email')->first();

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
