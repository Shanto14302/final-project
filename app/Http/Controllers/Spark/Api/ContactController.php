<?php

namespace App\Http\Controllers\Spark\Api;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\Spark\Spark_contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function GetContactInfo(){
        $contact = Spark_contact::first();
        $logo_top = Logo::where('logo_for','spark')->where('logo_position','spark_top')->where('logo_status','Active')->where('logo_delete',0)->select('logo_image')->first();
        $logo_bottom = Logo::where('logo_for','spark')->where('logo_position','spark_bottom')->where('logo_status','Active')->where('logo_delete',0)->select('logo_image')->first();
        return [
            'contact'=>$contact,
            'logo_top'=>$logo_top,
            'logo_bottom'=>$logo_bottom,
        ];
    }
}
