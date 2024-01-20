<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBasicInfoUpdate;
use App\Http\Requests\AdminProfileUpdate;
use App\Http\Requests\UpdateAdditionalInfo;
use App\Http\Requests\UpdatePassword;
use App\Models\Admin\AdminProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDO;

class AdminProfileController extends Controller
{
    public function AdminProfile(){
        $profile =  AdminProfile::join('users','admin_profiles.profile_user_id','users.id')->where('profile_user_id',Auth::user()->id)->first();
        if($profile){
            $profile_info = $profile;
        }else{
            $profile_info = '';
        }
        return view('admin.profile.admin_profile',compact('profile_info'));
    }

    public function AdminProfileUpdate(AdminProfileUpdate $data){
        $file = $data->file('profile_image');
        $extension = $file->getClientOriginalExtension();
        $file_name = Auth::user()->id."-".time().'.'.$extension;
        $file->move(public_path('files/admin_images'),$file_name);
        $create = AdminProfile::create([
            'profile_user_id' => Auth::user()->id,
            'profile_employee_id' => Auth::user()->id+100000,
            'profile_user_father_name' => $data->father_name,
            'profile_user_mother_name' => $data->mother_name,
            'profile_user_gender' => $data->gender,
            'profile_user_address' => $data->address,
            'profile_user_image' => 'public/files/admin_images/'.$file_name,
        ]);
        if($create){
            $profile =  AdminProfile::where('profile_user_id',Auth::user()->id)->first();
            return response()->json([
                'profile'=>$profile,
            ],200);
        }else{
            return response()->json([
                'error'=>1,
            ],500);
        }
    }

    public function UpdateBasicInfo(AdminBasicInfoUpdate $data){
        $update = User::where('id',Auth::user()->id)->update([ 
            'name' => $data->user_name,
            'email' => $data->user_email,
            'phone' => $data->user_phone,
            'updated_at' => Carbon::now(),
        ]);

        if($update){
            return [
                'message' => 1,
            ];
        }else{
            return [
                'message' => 0,
            ];
        }
    }

    public function UpdateAdditionalInfo(UpdateAdditionalInfo $data){
        $update = AdminProfile::where('profile_user_id',Auth::user()->id)->update([
            'profile_user_father_name' => $data->father_name,
            'profile_user_mother_name' => $data->mother_name,
            'profile_user_gender' => $data->gender,
            'profile_user_address' => $data->address,
            'profile_user_dob' => $data->dob,
        ]);

        if($update){
            return [
                'message' => 1,
            ];
        }else{
            return [
                'message' => 0,
            ];
        }
    }

    public function UpdateImageInfo(Request $data){
        $data->validate([
            'profile_image_update'=>'required|mimes:png,jpg,jpeg'
        ]);

        $profile = AdminProfile::where('profile_user_id',Auth::user()->id)->first();
        unlink($profile->profile_user_image);
        $file = $data->file('profile_image_update');
        $extension = $file->getClientOriginalExtension();
        $file_name = Auth::user()->id."-".time().'.'.$extension;
        $file->move(public_path('files/admin_images'),$file_name);
        $update = AdminProfile::where('profile_user_id',Auth::user()->id)->update([
            'profile_user_image' => 'public/files/admin_images/'.$file_name,
        ]);

        if($update){
            return [
                'message' => 1,
            ];
        }else{
            return [
                'message' => 0,
            ];
        }
    }

    public function UpdatePassword(UpdatePassword $data){
        
        $user = User::find(Auth::user()->id);
        // return $data->new_password;
        if(Hash::check($data->old_password,$user->password)){
            $update = User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($data->new_password),
                'updated_at' => Carbon::now(),
            ]);
            return response()->json(['message'=>1]);
        }else{
            return response()->json(['message'=>'Invalid user password'],422);
        }
    }
}
