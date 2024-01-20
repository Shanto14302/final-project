<?php

namespace App\Http\Controllers\Spark;

use App\Http\Controllers\Controller;
use App\Models\Spark\MainSlider as SparkMainSlider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class MainSlider extends Controller
{
    public function SparkMainSlider(Request $data){
        $main_sliders = SparkMainSlider::where('spark_main_slider_delete',0)->orderBy('spark_main_slider_status','ASC')->get();
        $main_slider_headline = DB::table('spark_main_slider_headlines')->where('spark_main_slider_headline_delete',0)->first();
        return view('spark.main_slider',compact('main_sliders','main_slider_headline'));
    }

    public function SparkMainSliderHeadline(Request $data){
        $data->validate([
            'slider_title' => 'required',
            'slider_sub_title' => 'required',
        ]);
        $update = DB::table('spark_main_slider_headlines')->where('spark_main_slider_headline_id',1)->update([
            'spark_main_slider_headline' => $data->slider_title,
            'spark_main_slider_sub_title' => $data->slider_sub_title,
            'updated_at'=>Carbon::now(),
        ]);

        if($update){
            return [
                'message'=>'Successfully Updated',
            ];
        }else{
            return response()->json([
                'message'=>'Opps ! Something went wrong',
            ],422);
        }
    }

    public function SparkMainSliderImage(Request $data){
        $data->validate([
            'slider_image_update' => 'required|mimes:jpeg,jpg,png|max:2000',
        ]);

        $img = Image::make($data->slider_image_update);
        $height = Image::make($data->slider_image_update)->height();
        if($height!=500){
            return response()->json(['message'=>'Main slider image height must be 500px'.$height],422);
        }else{
            $file = $data->slider_image_update;
            $extension = $file->getClientOriginalExtension();
            $file_name = "main_slider-".time().'.'.$extension;
            
            $file->move(public_path('files/main_slider'),$file_name);
            $create = DB::table('spark_main_sliders')->insert([
                'spark_main_slider_image' => 'public/files/main_slider/'.$file_name,
                'created_at'=>Carbon::now(),
            ]);

            if($create){
                return $create;
            }else{
                return response()->json(['message'=>'Server error'],422); 
            }
        }
    }

    public function SparkMainSliderImageStatus(Request $data){
        if($data->status=='Active'){
            $update = DB::table('spark_main_sliders')->where('spark_main_slider_id',$data->id)->update([
                'spark_main_slider_status'=>'Deactive',
                'updated_at'=>Carbon::now(),
            ]);
            if($update){
                return [
                    'status'=>'Deactive',
                    'value'=>DB::table('spark_main_sliders')->where('spark_main_slider_id',$data->id)->first(),
                ];
            }else{
                return response()->json(['message'=>'Server error'],422); 
            }
        }else{
            $update = DB::table('spark_main_sliders')->where('spark_main_slider_id',$data->id)->update([
                'spark_main_slider_status'=>'Active',
                'updated_at'=>Carbon::now(),
            ]);
            if($update){
                return [
                    'status'=>'Active',
                    'value'=>DB::table('spark_main_sliders')->where('spark_main_slider_id',$data->id)->first(),
                ];
            }else{
                return response()->json(['message'=>'Server error'],422); 
            }
        }
    }

    public function SparkMainSliderImageDelete(Request $data){
        $delete = DB::table('spark_main_sliders')->where('spark_main_slider_id',$data->id)->update([
            'spark_main_slider_delete'=>1,
            'updated_at'=>Carbon::now(),
        ]);

        if($delete){
            return [
                'value'=>DB::table('spark_main_sliders')->where('spark_main_slider_id',$data->id)->first(),
            ];
        }else{
            return response()->json(['message'=>'Server error'],422); 
        }
    }
}
