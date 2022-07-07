<?php

//　ホーム
//  HomeController.php
//
//  Created by 吉田知代 on 2022/06/27.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

class HomeController extends Controller
{

    public function index(Request $request)
    {
        // 日付の設定
        $date = Carbon::today();
    

        // 生理周期情報取得
        $physiological_cycle_managements = DB::table('physiological_cycle_managements')
            ->select('latest_menstruation_start_date', 
                     'physiological_cycle',
                     'physiological_period'
                     )
            ->where('user_id', Auth::id())
            ->first();  
        
        // 生理開始日計算
        $latest_menstruation_start_date = new Carbon($physiological_cycle_managements->latest_menstruation_start_date);
        $latest_menstruation_start_date = $latest_menstruation_start_date->addDays($physiological_cycle_managements->physiological_cycle);
        echo $latest_menstruation_start_date;

        // 生理開始日カウント計算
        $menstruation_start_count = new Carbon($latest_menstruation_start_date);
        if($menstruation_start_count->gt($date)){
            $menstruation_start_count = "生理まで".$latest_menstruation_start_date->diffInDays($date);
        }else{
            $menstruation_start_count = "生理開始日から".$latest_menstruation_start_date->diffInDays($date);

        }
        echo($menstruation_start_count);
        
        
        // return view('dashboard', ['masters' => $masters],['seiri_informations' => $no_data_seiri_informations]);  
        return view('dashboard');  

    }

}
