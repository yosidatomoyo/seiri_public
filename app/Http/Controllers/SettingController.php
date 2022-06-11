<?php

//　設定
//  Setting.php
//
//  Created by 吉田知代 on 2022/04/30.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use DateTime;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->user_informations = new User();
    }

    public function index()
    {
        // ユーザー情報が取得できな場合はログイン画面へ遷移   
        if(Auth::id() == NULL){
            return redirect('/login');
        }

        // ユーザー情報取得
        $user_informations = DB::table('users')
                ->where('id', Auth::id())            
                ->first(); 

        return view('setting',['user_informations' => $user_informations]);  
    }

    // 登録処理
    public function store(Request $request)
    {
        $user_informations = DB::table('users')
        ->select('password')
        ->where('id', Auth::id())            
        ->first(); 

        $currentPassword = $user_informations->password;
        $password = $request->password;
        // バリデーションチェック
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => ['required', 'date', 'max:10'],
            'current_password' => [
                function ($attribute, $value, $fail) use ($currentPassword, $password) { 
                    if (!Hash::check($currentPassword, $password)) {
                        return $fail('現在のパスワードと入力したパスワードが一致しません。');
                    }
                }
            ]
        ]);

        $user_informations = $this->user_informations->updateUserInformation($request);
        return redirect('/setting');        
    }

    // TODO 削除処理
    public function delete(Request $request)
    {
    }
}
