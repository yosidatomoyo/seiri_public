<?php

//　レポート
//  ReportController.php
//
//  Created by 吉田知代 on 2022/04/30.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Master;
use App\Models\User;
use App\Models\Seiri_information;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

use Auth;
use Carbon\Carbon;
use DateTime;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // ユーザー情報が取得できな場合はログイン画面へ遷移   
        if(Auth::id() == NULL){
            return redirect('/login');
        }

        // 日付の設定
        $day = $request->day; 
        if(is_null($day)){
            $fromDay = Carbon::today()->subDay(6);
            // パラメータがない場合今日の日付を設定
            return redirect('/report?day='.$fromDay->format('Y-m-d'));
        }else{
            $fromDay = new Carbon($day);
            $newFromDay = new Carbon($day);
            $toDay = $newFromDay->addDay(6);

        }
        
        // 生理情報の取得
        $seiri_informations = DB::table('seiri_informations')
            ->where('user_id', Auth::id())
            ->whereBetween('report_date', [$fromDay, $toDay])
            ->orderByRaw('report_date ASC')
            ->get();  

            $seiri_information[] = array();
            $date = $fromDay;
            $newDay = new Carbon($date);

            $str = str_replace("00:00:00", "", $newDay);
            $str = str_replace(" ", "", $str);
            $count = 0;

            for($i = 0; $i < 7; $i++){
                if(isset($seiri_informations[$count])){
                    if($seiri_informations[$count]->report_date == $str){
                        $seiri_information[] = $seiri_informations[$count];
                        $count++;
                    }else{
                        $no_data_seiri_informations =  [
                            'report_date' => $str,
                            'menstruation_start_date' => '',
                            'menstruation_end_date' => '',
                            'body_condition' => '',
                            'body_temperature' => '',
                            'feeling' => '',
                            'menstrual_pain' => '',
                            'menstrual_blood_volume' => '',
                            'menstrual_discharge_color' => '',
                            'menstrual_discharge_quality' => '',
                            'menstrual_discharge_volume' => '',
                            'constipation_color'=> '',
                            'constipation_quality' => '',
                            'constipation_volume' => '',
                            'headache' => '',
                            'lower_back_pain' => '',
                            'stomach_ache' => '',
                            'chest_tension' => '',
                            'memo' => ''
                        ];
                        $seiri_information[]  = (object)$no_data_seiri_informations;
                        
                    }
                }else{
                    $no_data_seiri_informations =  [
                        'report_date' => $str,
                        'menstruation_start_date' => '',
                        'menstruation_end_date' => '',
                        'body_condition' => '',
                        'body_temperature' => '',
                        'feeling' => '',
                        'menstrual_pain' => '',
                        'menstrual_blood_volume' => '',
                        'menstrual_discharge_color' => '',
                        'menstrual_discharge_quality' => '',
                        'menstrual_discharge_volume' => '',
                        'constipation_color'=> '',
                        'constipation_quality' => '',
                        'constipation_volume' => '',
                        'headache' => '',
                        'lower_back_pain' => '',
                        'stomach_ache' => '',
                        'chest_tension' => '',
                        'memo' => ''
                    ];
                    $seiri_information[] = (object)$no_data_seiri_informations;
                }
               
                $newDay = $newDay->addDay(1);
                $str = str_replace("00:00:00", "", $newDay);
                $str = str_replace(" ", "", $str);
            }

        // データ未登録判定
        if(count($seiri_information) == 0){
            return view('nothingReport',['date' => $fromDay]);
        }else{
            return view('report',['seiri_informations' => $seiri_information],['date' => $fromDay]);
        }

    }

}
