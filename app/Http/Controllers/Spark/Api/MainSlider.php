<?php

namespace App\Http\Controllers\Spark\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spark\MainSlider as SparkMainSlider;
use Illuminate\Support\Facades\DB;

class MainSlider extends Controller
{
    public function SparkMainSlider(Request $data){
        $main_sliders = SparkMainSlider::where('spark_main_slider_delete',0)->where('spark_main_slider_status','Active')->orderBy('spark_main_slider_status','ASC')->get();
        $main_slider_headline = DB::table('spark_main_slider_headlines')->where('spark_main_slider_headline_delete',0)->first();
        return [
            'main_sliders'=>$main_sliders,
            'main_slider_headline'=>$main_slider_headline
        ];
    }
}
