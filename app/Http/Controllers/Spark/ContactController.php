<?php

namespace App\Http\Controllers\Spark;

use App\Http\Controllers\Controller;
use App\Http\Requests\Spark\SparkContact;
use App\Models\Spark\Spark_contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function SparkContact(){
        $contact = Spark_contact::first();
        return view('spark.contact_information',compact('contact'));
    }
    public function SparkContactUpdate(Request $data){
         $update = Spark_contact::where('spark_contact_id',1)->update([
            'spark_phone_1' => $data->phone_number_1,
            'spark_phone_2' => $data->phone_number_2,
            'spark_phone_3' => $data->phone_number_3,
            'spark_email' => $data->email_address,
            'updated_at' => Carbon::now(),
         ]);

         if($update){
            return [
                'message'=>1
            ];
         }else{
            return response()->json([
                'message' => 'Something went wrong',
            ],422);
         }
    }
    public function SparkSocialUpdate(Request $data){
        $update = Spark_contact::where('spark_contact_id',1)->update([
           'spark_facebook_link' => $data->facebook,
           'spark_instagram_link' => $data->instagram,
           'spark_youtube_link' => $data->youtube,
           'spark_twitter_link' => $data->twitter,
           'updated_at' => Carbon::now(),
        ]);

        if($update){
           return [
               'message'=>1
           ];
        }else{
           return response()->json([
               'message' => 'Something went wrong',
           ],422);
        }
   }

   public function SparkAddressUpdate(Request $data){
    $update = Spark_contact::where('spark_contact_id',1)->update([
       'spark_location_link' => $data->location_link,
       'spark_address' => $data->address,
       'updated_at' => Carbon::now(),
    ]);

    if($update){
       return [
           'message'=>1
       ];
    }else{
       return response()->json([
           'message' => 'Something went wrong',
       ],422);
    }
}
}
