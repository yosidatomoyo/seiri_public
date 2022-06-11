<?php

//　パスワード変更
//  NewPasswordController.php
//
//  Created by 吉田知代 on 2022/05/20.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    public function __construct()
    {
        $this->user_informations = new User();
    }

    public function index(Request $request)
    {
        //セッションからユーザーIDを取り出す
		$userId = $request->session()->get("userId");
        // ユーザー情報が取得できない場合はパスワードリセット画面へ遷移
        if($userId == NULL){
            return redirect('/forgot-password');
        }
        return view('auth.reset-password');
    }


    // パスワード変更
    public function store(Request $request)
    {
        //セッションからユーザーIDを取り出す
        $userId = $request->session()->get("userId");
        // ユーザー情報が取得できない場合はパスワードリセット画面へ遷移
        if($userId == NULL){
            return redirect('/forgot-password');
        }
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // パスワード変更処理
        if($user_informations = $this->user_informations->resetPassword($userId,$request)){
            //セッションを空にする
            $request->session()->forget("userId");
            return redirect('/login')->with('flash_message', 'パスワード変更が完了しました。');
        }else{
            //セッションを空にする
            $request->session()->forget("userId");
            return redirect('/forgot-password')->with('flash_message', 'パスワード変更に失敗しました');

        }


    }
}
