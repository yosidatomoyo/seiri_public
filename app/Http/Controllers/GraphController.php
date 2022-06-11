<?php

//　グラフ
//  GraphController.php
//
//  Created by 吉田知代 on 2022/05/10.
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

class GraphController extends Controller
{

    public function index(Request $request)
    {
        // ユーザー情報が取得できな場合はログイン画面へ遷移   
        if(Auth::id() == NULL){
            return redirect('/login');
        }

        // 日付の設定
        $date = $request->day;
        if(is_null($date)){
            $date = Carbon::today();
        }
        
        $startDate = Carbon::create($date)->startOfMonth();
        $endDate = Carbon::create($date)->endOfMonth();
        // 体調情報取得
        $seiri_informations = DB::table('seiri_informations')
            ->select('report_date', 
                     'body_temperature',
                     'menstrual_pain',
                     'menstrual_blood_volume',
                     'menstrual_discharge_volume',
                     'constipation_volume',
                     'headache',
                     'lower_back_pain',
                     'stomach_ache',
                     'chest_tension'
                     )
            ->where('user_id', Auth::id())
            ->whereBetween('report_date', [$startDate, $endDate])
            ->orderByRaw('report_date ASC')
            ->get();  
        
        // データが未登録の場合空データを送信 
        $no_data_seiri_informations =  [
            'report_date' => $date,
            'body_temperature' => '',
            'menstrual_pain' => '',
            'menstrual_blood_volume' => '',
            'menstrual_discharge_quality' => '',
            'menstrual_discharge_volume' => '',
            'constipation_quality' => '',
            'constipation_volume' => '',
            'headache' => '',
            'lower_back_pain' => '',
            'stomach_ache' => '',
            'chest_tension' => '',
        ];

        // オブジェクト型に変換
        $no_data_seiri_informations = (object)$no_data_seiri_informations;

        // データ未登録判定
        if(is_null($seiri_informations)){
            return view('graph',['seiri_informations' => $no_data_seiri_informations],['endDate' => $endDate]);  
        }else{
            return view('graph',['seiri_informations' => $seiri_informations],['endDate' => $endDate]);  
        }
    }

}
