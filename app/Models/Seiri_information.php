<?php
//
//  Seiri_information.php
//
//  Created by 吉田知代 on 2022/03/15.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\Seiri_information as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Seiri_information extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    // モデルに関連付けるテーブル
    protected $table = 'seiri_informations';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'report_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'report_date',
        'menstruation_start_date',
        'menstruation_end_date',
        'body_condition',
        'body_temperature',
        'feeling',
        'menstrual_pain',
        'menstrual_blood_volume',
        'menstrual_discharge_color',
        'menstrual_discharge_quality',
        'menstrual_discharge_volume',
        'constipation_color',
        'constipation_quality',
        'constipation_volume',
        'headache',
        'lower_back_pain',
        'stomach_ache',
        'chest_tension',
        'memo',
        'created_at',
        'updated_at'
    ];

    /**
     * 一覧画面表示用にSeiri_informationテーブルから全てのデータを取得
     */
    public function findAllSeiri_informations()
    {
        return Seiri_information::all();
    }

    // 体調情報登録
    public function inserSeiriInformation($request,$menstruation_start_date,$menstruation_end_date)
    {
        // リクエストデータを基に登録する
        return $this->create([
            'user_id' => Auth::id(),
            'report_date' => $request->report_date,
            'menstruation_start_date' => $menstruation_start_date,
            'menstruation_end_date' => $menstruation_end_date,
            'body_condition' => $request->body_condition,
            'body_temperature' => $request->body_temperature,
            'feeling' => $request->feeling,
            'menstrual_pain' => $request->menstrual_pain,
            'menstrual_blood_volume' => $request->menstrual_blood_volume,
            'menstrual_discharge_color' => $request->menstrual_discharge_color,
            'menstrual_discharge_quality' => $request->menstrual_discharge_quality,
            'menstrual_discharge_volume' => $request->menstrual_discharge_volume,
            'constipation_color' => $request->constipation_color,
            'constipation_quality' => $request->constipation_quality,
            'constipation_volume' => $request->constipation_volume,
            'headache' => $request->headache,
            'stomach_ache' => $request->stomach_ache,
            'lower_back_pain' => $request->lower_back_pain,
            'chest_tension' => $request->chest_tension,
            'memo' => $request->memo
        ]);
    }

    // 体調情報更新
    public function updateSeiriInformation($request,$report_id,$menstruation_start_date,$menstruation_end_date)
    {
        // リクエストデータを基に更新する
        return $this
            ->where('report_id',$report_id)
            ->update([
                'user_id' => Auth::id(),
                'report_date' => $request->report_date,
                'menstruation_start_date' => $menstruation_start_date,
                'menstruation_end_date' => $menstruation_end_date,
                'body_condition' => $request->body_condition,
                'body_temperature' => $request->body_temperature,
                'feeling' => $request->feeling,
                'menstrual_pain' => $request->menstrual_pain,
                'menstrual_blood_volume' => $request->menstrual_blood_volume,
                'menstrual_discharge_color' => $request->menstrual_discharge_color,
                'menstrual_discharge_quality' => $request->menstrual_discharge_quality,
                'menstrual_discharge_volume' => $request->menstrual_discharge_volume,
                'constipation_color' => $request->constipation_color,
                'constipation_quality' => $request->constipation_quality,
                'constipation_volume' => $request->constipation_volume,
                'headache' => $request->headache,
                'stomach_ache' => $request->stomach_ache,
                'lower_back_pain' => $request->lower_back_pain,
                'chest_tension' => $request->chest_tension,
                'memo' => $request->memo
            ]);
    }

}
