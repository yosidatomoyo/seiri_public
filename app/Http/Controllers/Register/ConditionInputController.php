<?php

//　体調入力
//  ConditionInputController.php
//
//  Created by 吉田知代 on 2022/04/15.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Master;
use App\Models\User;
use App\Models\Seiri_information;
use App\Models\Physiological_cycle_management;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use DateTime;

class ConditionInputController extends Controller
{

    public function __construct()
    {
        $this->seiri_information = new Seiri_information();
        $this->physiological_cycle_management = new Physiological_cycle_management();
    }


    public function index(Request $request)
    {           
        // ユーザー情報が取得できな場合はログイン画面へ遷移   
        if(Auth::id() == NULL){
            return redirect('/login');
        }

        // パラメータがない場合今日の日付を設定
        $day = $request->day; 
        if(is_null($day)){
            $day = Carbon::today();
            return redirect('/conditionInput?day='.$day->format('Y-m-d'));
        }

        // 未来の日付を入力した場合エラーメッセージ表示
        if(Carbon::today() < $day){
            return redirect()->route("conditionInput")
            ->with('error', '未来の日付は指定できません');
        }

        // マスタデータ取得
        $masters = DB::table('masters')->get();

        // マスタデータの取得件数が0件だった場合システムエラー画面へ遷移
        if(count($masters) <= 0){
            return parent::render($request, $exception);
        }

        // 生理情報データ取得
        $seiri_informations = DB::table('seiri_informations')
        ->where([
            ['user_id', Auth::id()],
            ['report_date', $day]
        ])
        ->first();
        
        // データが未登録の場合空データを送信 
        $no_data_seiri_informations =  [
            'report_date' => $day,
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
        

        // オブジェクト型に変換
        $no_data_seiri_informations = (object)$no_data_seiri_informations;

        // データ未登録判定
        if(is_null($seiri_informations)){
            return view('conditionInput', ['masters' => $masters],['seiri_informations' => $no_data_seiri_informations]);  
        }else{
            return view('conditionInput',['masters' => $masters],['seiri_informations' => $seiri_informations]);  
        }
    }

    // 保存処理
    public function store(Request $request)
    {
        // 体温が入力された場合、範囲チェック
        if($request->body_temperature != ''){
            $request->validate([
                'body_temperature' => 'between:34.0,42.0|numeric',
            ]);
        }

        // バリデーションチェック
        $request->validate([
            'report_date' => 'required',
            'memo' => 'max:255'
        ]);

        // 登録済みデータ判定
        $seiri_informations = DB::table('seiri_informations')
        ->where([
            ['user_id', Auth::id()],
            ['report_date', $request->report_date]
        ])
        ->first();

        // 生理開始にチェックが入っていた場合
        if($request->menstruation_date == 1){

            // 生理周期計算
            $physiological_cycle_info = DB::table('physiological_cycle_managements')
            ->select('latest_menstruation_start_date','physiological_cycle','physiological_period','created_at','updated_at')
            ->where('user_id', Auth::id())
            ->first(); 

            $menstruation_start_date = $request->report_date;
            $menstruation_end_date = NULL;

            // DateTime型に変換
            $menstruation_start_date = new DateTime($menstruation_start_date);
            $latest_menstruation_start_date = new DateTime($physiological_cycle_info->latest_menstruation_start_date);

            // 初期生理入力から変更がない場合
            if($physiological_cycle_info->created_at == $physiological_cycle_info->updated_at ){
                // 最近の生理周期　＜　入力した生理開始日の場合
                if($latest_menstruation_start_date < $menstruation_start_date){
                    $physiological_cycle = ($menstruation_start_date->diff($latest_menstruation_start_date))->format('%a');
                // 入力した生理開始日の場合　＜　最近の生理周期
                }else{
                    $physiological_cycle = ($latest_menstruation_start_date->diff($menstruation_start_date))->format('%a');
                }
            // 初期生理入力から変更があった場合
            }else{
                // 最近の生理周期　＜　入力した生理開始日の場合
                if($latest_menstruation_start_date < $menstruation_start_date){
                    $interval = ($menstruation_start_date->diff($latest_menstruation_start_date))->format('%a');
                    $physiological_cycle = ($physiological_cycle_info->physiological_cycle + $interval) / 2;

                // 入力した生理開始日の場合　＜　最近の生理周期
                }else{
                    $seiri_menstruation_start_date = DB::table('seiri_informations')
                        // 全て生理理開始日の取得
                        ->select('menstruation_start_date')
                        ->where('user_id', Auth::id())
                        ->whereNotNull('menstruation_start_date')
                        ->orderByRaw('menstruation_start_date ASC')
                        ->get();

                        $physiological_cycle_element = array();
                        $physiological_cycle_culc = array();
                        $interval = array();

                        foreach($seiri_menstruation_start_date as $start_date){
                            $physiological_cycle_element[] = $start_date->menstruation_start_date;
                        }
                        
                        // 生理開始日を昇順にソート
                        $physiological_cycle_element[] = $menstruation_start_date->format('Y-m-d');
                        sort($physiological_cycle_element);
                        $count = count($physiological_cycle_element)-1;

                        // 生理周期計算
                        for($i = 0; $i < $count; $i++){
                            $date_after = (new DateTime($physiological_cycle_element[$count-$i]));
                            $date_befor = (new DateTime($physiological_cycle_element[$count-$i-1]));
                            if(!($date_after == $date_befor)){
                                $interval[] =  ($date_after->diff($date_befor))->format('%a');
                            }
                        }
                    // 生理周期の平均値を求める
                    $physiological_cycle =  array_sum($interval)/$count;
                }
            }
            
            // 月経期間をデータベースに登録
            if($physiological_cycle_management = $this->physiological_cycle_management->updatePhysiologicalCycleManagements($request->report_date,round($physiological_cycle))){
            }else{
                return redirect('/conditionInput?day='.$request->report_date)->with('flash_message', '生理情報の登録に失敗しました');
            }
            
        // 生理終了にチェックが入っていた場合
        }else if($request->menstruation_date == 2){

            $menstruation_start_date = NULL;
            $menstruation_end_date = $request->report_date;

            // 生理周期計算
            $physiological_cycle_info = DB::table('physiological_cycle_managements')
            ->select('latest_menstruation_start_date','physiological_cycle','physiological_period','created_at','updated_at')
            ->where('user_id', Auth::id())
            ->first(); 

            // DateTime型に変換
            $menstruation_end_date = new DateTime($menstruation_end_date);
            $latest_menstruation_start_date = new DateTime($physiological_cycle_info->latest_menstruation_start_date);

            // 初期生理入力から変更がない場合
            if($physiological_cycle_info->created_at == $physiological_cycle_info->updated_at ){
                // 月経期間計算
                $physiological_period = ($menstruation_end_date->diff($latest_menstruation_start_date))->format('%a');
                // 月経期間がマイナスか10以上の場合は無効にする
                if(!($physiological_period < 0  or $physiological_period < 10)){
                    $physiological_period = $physiological_cycle_info->physiological_period;
                }
                // 初期生理入力から変更がある場合
            }else{

                $seiri_menstruation_end_date = DB::table('seiri_informations')->max('menstruation_end_date');
                $seiri_menstruation_start_date = DB::table('seiri_informations')->max('menstruation_start_date');

                // DateTime型に変換
                $seiri_menstruation_end_date = new DateTime($seiri_menstruation_end_date);
                $seiri_menstruation_start_date = new DateTime($seiri_menstruation_start_date);

                // 月経期間計算
                $physiological_period = ($seiri_menstruation_end_date->diff($seiri_menstruation_start_date))->format('%a');
                $physiological_period = ($physiological_period + $physiological_cycle_info->physiological_period) / 2;
                
                // 月経期間がマイナスか10以上の場合は無効にする
                if(!($physiological_period < 0  or $physiological_period < 10)){
                    $physiological_period = $physiological_cycle_info->physiological_period;
                }
            }
            // 月経期間が変更ない場合はデータベースに登録しない
            if(!($physiological_cycle_info->physiological_period == $physiological_period)){
                if($physiological_cycle_management = $this->physiological_cycle_management->updatePhysiologicalPeriodManagements(round($physiological_period))){
                }else{
                    return redirect('/conditionInput?day='.$request->report_date)->with('flash_message', '生理情報の登録に失敗しました');
                }
            }

        }else {
            $menstruation_start_date = NULL;
            $menstruation_end_date = NULL;
        }

        // 登録処理
        if(is_null($seiri_informations)){
            // seiri_informationsテーブルにデータを登録処理
            if($seiri_information = $this->seiri_information->inserSeiriInformation($request,$menstruation_start_date,$menstruation_end_date)){
                return redirect('/conditionInput?day='.$request->report_date)->with('flash_message', '生理情報の登録が完了しました');
            }else{
                return redirect('/conditionInput?day='.$request->report_date)->with('flash_message', '生理情報の登録に失敗しました');
            }
            
        // 更新処理
        }else{
            // seiri_informationsテーブルにデータを更新処理
            if($seiri_information = $this->seiri_information->updateSeiriInformation($request,$seiri_informations->report_id,$menstruation_start_date,$menstruation_end_date)){
                return redirect('/conditionInput?day='.$request->report_date)->with('flash_message', '生理情報の更新が完了しました');
            }else{
                return redirect('/conditionInput?day='.$request->report_date)->with('flash_message', '生理情報の更新に失敗しました');
            }
        }
    }

}
