<?php

//　初期設定
//  InitialSettingController.php
//
//  Created by 吉田知代 on 2022/06/1.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Physiological_cycle_management;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Auth;


class InitialSettingController extends Controller
{

    public function __construct()
    {
        $this->physiological_cycle_managements = new Physiological_cycle_management();
    }

    public function index(Request $request)
    {            
        return view('initialSetting');  
    }


    // 登録処理
    public function store(Request $request)
    {
        // バリデーションチェック
        $request->validate([
            'latest_menstruation_start_date' => 'required',
            'physiological_cycle' => 'numeric',
            'physiological_period' => 'required'
        ]);
        // seiri_informationsテーブルにデータを登録処理
        $physiological_cycle_managements = $this->physiological_cycle_managements->insertPhysiologicalCycleManagements($request);
        return redirect('/dashboard');
    }

}
