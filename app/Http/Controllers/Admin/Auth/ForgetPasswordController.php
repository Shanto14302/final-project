<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPassword;
use App\Mail\ForgetPassword;
use App\Models\ResetPasswordPermission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    public function ForgotPassword(){
        return view('admin.auth.forget_password');
    }

    public function ForgotPasswordMail(ForgotPassword $data){
        $user_info = User::where('email',$data->email)->select('id','role')->first();
        if($user_info->role == 2 && $user_info->role == 2){
            $check_permission = ResetPasswordPermission::where('reset_email',$data->email)->where('reset_status','No')->first();
            if($check_permission){
                return redirect()->back()->with('pending_forgot_password_request',1);
            }else{
                ResetPasswordPermission::create([
                    'reset_user_id' => $user_info->id,
                    'reset_email' => $data->email,
                ]);
                return redirect()->back()->with('send_forgot_password_request',1);
            }
        }else{
            $token = rand(100000,999999);
            $check = DB::table('password_reset_tokens')->where('email', $data->email)->first();
            $mail = Mail::to($data->email)->send(new ForgetPassword($token));
            if($check && $mail){
                DB::table('password_reset_tokens')->where('email', $data->email)->update([
                    'token' =>  Hash::make($token),
                    'created_at' => Carbon::now(),
                    // 'token_time' => time(),
                ]);
            }elseif(!$check && $mail){
                DB::table('password_reset_tokens')->insert([
                    'email' => $data->email,
                    'token' => Hash::make($token),
                    'created_at' => Carbon::now(),
                    // 'token_time' => time(),
                ]);
            }

            

            if($mail){
                return redirect()->back()->with('send_forgot_password_mail',1);
            }else{
                return redirect()->back()->with('send_forgot_password_mail_failed',1);
            }
        }


        
    }

    public function ResetRequests(){
        return view('admin.auth.reset_request');
    }

    public function ResetPasswordForm(){
        return view('admin.auth.reset_password');
    }


    //json dependency
    public function ResetPassword(Request $data){
        $data->validate([
            'token' => 'required',
            'email' => 'required|email|exists:password_reset_tokens,email|max:40',
            'password' =>'required|max:30',
            'rpassword' =>'required|same:password|max:30',
        ]);

        $reset = DB::table('password_reset_tokens')->where('email',$data->email)->first();

        if(!Hash::check($data->token,$reset->token)){
            return response()->json([
                'token' => 'Token does not match'
            ],422);
        }else{
            DB::table('users')->where('email',$data->email)->update([
                'password' => Hash::make($data->rpassword),
            ]);

            $status = Password::reset($data->only('email','token','password'),function($user) use($data){
                $user->update([
                    'password' => Hash::make($data->password),
                ]);
            });
    
            if($status == Password::PASSWORD_RESET){
                return [
                    'message' => 1
                ];
            }else{
                return response()->json([
                    'message' => 0
                ]);
            }
        }
    }

    public function ResetRequestsData(Request $data){
        $reset_requests = ResetPasswordPermission::join('users','reset_password_permissions.reset_user_id','users.id');
        if($data->start_date!=null && $data->end_date!=null){
            $reset_requests =  $reset_requests->whereBetween('reset_password_permissions.created_at',[$data->start_date." 00:00:00", $data->end_date." 23:59:59"]);
        }
        if($data->user_email!=null){
            $reset_requests =  $reset_requests->where('users.email',$data->user_email);
        }
        $reset_requests = $reset_requests->select('reset_password_permissions.*','users.id','users.name','users.email','users.phone','users.status')->get();
        return $reset_requests;
    }

    public function ResetRequestsDataUpdate(Request $data){
        ResetPasswordPermission::where('reset_id',$data->id)->update([
            'reset_status' => 'Yes',
            'reset_approved_by' => Auth::user()->name,
            'updated_at' => Carbon::now(),
        ]);

        $reset_requests = ResetPasswordPermission::join('users','reset_password_permissions.reset_user_id','users.id')->where('reset_id',$data->id)->select('reset_password_permissions.*','users.id','users.name','users.email','users.phone','users.status')->first();

        $token = rand(100000,999999);
        $check = DB::table('password_reset_tokens')->where('email', $reset_requests->email)->first();
        if($check){
            DB::table('password_reset_tokens')->where('email', $reset_requests->email)->update([
                'token' =>  Hash::make($token),
                'created_at' => Carbon::now(),
                // 'token_time' => time(),
            ]);
        }else{
            DB::table('password_reset_tokens')->insert([
                'email' => $reset_requests->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
                // 'token_time' => time(),
            ]);
        }

        $mail = Mail::to($reset_requests->email)->send(new ForgetPassword($token));

        if($mail){
            $msg = 1;
        }else{
            $msg = 0;
        }


        return [
            'reset_requests'=>$reset_requests,
            'msg' => $msg,
        ];
    }
}
