<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBasicInfoUpdate;
use App\Http\Requests\UpdateAdditionalInfo;
use App\Http\Requests\User\AddUserRequest;
use App\Mail\User\CreateUserMail;
use App\Mail\User\UserMail;
use App\Models\Admin\AdminProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function ViewUsers()
    {
        $users = User::where('role','!=',4)->orderBy('name','ASC')->get();
        return view('admin.user.view_users',compact('users'));
    }

    public function SearchAdmin(Request $data){

        // return $data->all();
        $users = User::where('role','!=',4)->where('delete','!=',1);

        if($data->user_type!='' && $data->user_type!='all'){
            $users = $users->where('role',$data->user_type);
        }
        if($data->user_name!='' && $data->user_name!='all'){
            $users = $users->where('name','LIKE','%'.$data->user_name.'%');
        }
        if($data->user_email!='' && $data->user_email!='all'){
            $users = $users->where('email',$data->user_email);
        }
        if($data->user_id!='' && $data->user_id!='all'){
            $users = $users->where('id',$data->user_id);
        }

        $users = $users->get();
        $count = $users->count();
        return response()->json([
            'users' => $users,
            'count' => $count,
        ],200);
    }

    public function UpdateUserStaus(Request $data){
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
            'user' => $user,
            'status' => $status,
        ],200);
    }

    public function GetUserInfo(Request $data){
        $user = User::leftJoin('admin_profiles','users.id','admin_profiles.profile_user_id')->where('id',$data->id)->first();
        return $user;
    }


    public function UpdateBasicInfo(Request $data){

        $data->validate([
            'user_name' => 'required|max:50',
            'user_email' => 'required|email|max:50|unique:users,email,'.$data->user_id,
            'user_phone' => 'required|max:20|unique:users,phone,'.$data->user_id,
        ]);
        $update = User::where('id',$data->user_id)->update([
            'name' => $data->user_name,
            'email' => $data->user_email,
            'phone' => $data->user_phone,
            'role' => $data->user_role,
            'updated_at' => Carbon::now(),
        ]);

        $user = User::where('id',$data->user_id)->first();

        if($update){
            return [
                'message' => 1,
                'user' => $user,
            ];
        }else{
            return [
                'message' => 0,
            ];
        }
    }

    public function UpdateAdditionalInfo(UpdateAdditionalInfo $data){
        $profile = AdminProfile::where('profile_user_id',$data->user_id)->first();
        if($profile){
            $update = AdminProfile::where('profile_user_id',$data->user_id)->update([
                'profile_user_father_name' => $data->father_name,
                'profile_user_mother_name' => $data->mother_name,
                'profile_user_gender' => $data->gender,
                'profile_user_address' => $data->address,
                'profile_user_dob' => $data->dob,
                'updated_at' => Carbon::now(),
            ]);
    
            if($update){
                return [
                    'message' => 1,
                ];
            }else{
                return [
                    'message' => 0,
                    'gender' => $data->gender,
                ];
            }
        }else{
            $user = User::where('id',$data->user_id)->first();
            $update = AdminProfile::create([
                'profile_user_id' => $data->user_id,
                'profile_employee_id' => $data->user_id,
                'profile_user_father_name' => $data->father_name,
                'profile_user_mother_name' => $data->mother_name,
                'profile_user_gender' => $data->gender,
                'profile_user_address' => $data->address,
                'profile_user_dob' => $data->dob,
                'profile_user_image' => $data->gender=='Male' ? 'public/files/admin_images/male.png' :'public/files/admin_images/female.png',
                'created_at' => Carbon::now(),
            ]);
    
            if($update){
                return [
                    'message' => 1,
                ];
            }else{
                return [
                    'message' => 0,
                    'gender' => $data->gender,
                ];
            }
        }
        
    }

    public function DeleteUser(Request $data){
        if($data->id){
            $update = User::where('id',$data->id)->update([
                'delete' =>1,
                'updated_at' => Carbon::now(),
            ]);

            if($update){
                return [
                    'message' => 1,
                    'user' => request()->id,
                ];
            }else{
                return [
                    'message' => 0,
                    'user' => request()->id,
                ];
            }

        }
    }

    public function MailToUser(Request $data){
        $user_email = User::where('id',$data->user_idm)->select('email')->first();
        ;

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

    public function AddUser(AddUserRequest $data){
        $create = User::create([
            'name' => $data->user_name,
            'email' => $data->user_email,
            'phone' => $data->user_phone,
            'role' => $data->user_role,
            'password' => Hash::make($data->password),
        ]);
        if($create){
            Mail::to($data->user_email)->send(new CreateUserMail($data->user_name,$data->password));
            return ['message'=>1];

        }else{
            return response()->json(['message'=>1],422);
        }
    }
}
