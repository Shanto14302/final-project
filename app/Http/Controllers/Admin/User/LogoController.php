<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UploadLogoRequest;
use App\Models\Logo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LogoController extends Controller
{
    public function GetLogo(){
        return view('admin.user.logo');
    }

    public function UploadLogo(UploadLogoRequest $data){
        
        if($data->type=='image'){
            $upload_file = $data->file('image');
            $height = Image::make($data->image)->height();
            $width = Image::make($data->image)->width();
            if($data->position=='admin_top'){
                if($height!=60 || $width!=200){
                    return response()->json(['message'=>'Admin top image must be 200x60'],422);
                }else{
                    $file = $data->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $file_name = "logo-".time().'.'.$extension;
                    $file->move(public_path('files/web_images'),$file_name);
                    $update = Logo::create([
                        'logo_for'=>'Admin',
                        'logo_position' => 'public/files/admin_images/'.$file_name,
                    ]);
                }
            }
        }
    }
}
