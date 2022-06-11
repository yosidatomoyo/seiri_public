<?php

//
//  Physiological_cycle_management.php
//
//  Created by 吉田知代 on 2022/03/15.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Physiological_cycle_management extends Model
{
    // use HasApiTokens, HasFactory, Notifiable;

    // モデルに関連付けるテーブル
    protected $table = 'physiological_cycle_managements';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    public function findAllPhysiological_cycle_management()
    {
        return Physiological_cycle_management::all();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'latest_menstruation_start_date',
        'physiological_cycle',
        'physiological_period',
        'created_at',
        'updated_at'
   
    ];

    // 生理周期登録
    public function insertPhysiologicalCycleManagements($request)
    {
        // リクエストデータを基に登録する
        return $this->create([
            'user_id' => Auth::id(),
            'latest_menstruation_start_date' => $request->latest_menstruation_start_date,
            'physiological_cycle' => $request->physiological_cycle,
            'physiological_period' => $request->physiological_period
        ]);
    }

    // 生理周期更新
    public function updatePhysiologicalCycleManagements($latest_menstruation_start_date,$physiological_cycle)
    {
        // リクエストデータを基に更新する
        return $this
            ->where('user_id',Auth::id())
            ->update([
                'latest_menstruation_start_date' => $latest_menstruation_start_date,
                'physiological_cycle' => $physiological_cycle
        ]);
    }

    // 生理期間更新
    public function updatePhysiologicalPeriodManagements($physiological_period)
    {
        // リクエストデータを基に更新する
        return $this
            ->where('user_id',Auth::id())
            ->update([
                'physiological_period' => $physiological_period
        ]);
    }


}
