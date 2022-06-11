<?php

//　パスワード変更（ユーザー情報確認）
//  PasswordResetLinkController.php
//
//  Created by 吉田知代 on 2022/05/20.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\AlphaNumHalf;
use App\Rules\Hiragana;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetLinkController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function request(Request $request)
    {
        // バリデーションチェック
        $request->validate([
            'userId' => ['required','min:5','max:24',new AlphaNumHalf],
            'birthday' => ['required', 'date', 'max:10'],
            'secretQuestion' => ['required','min:2','max:10',new Hiragana],
        ]);

        // 登録情報取得
        $user_informations = DB::table('users')
        ->select('secret_question')
        ->where([
            ['userId', $request->userId],
            ['birthday', $request->birthday]
        ])            
        ->first(); 
       
        // 登録情報取得が取得できない場合はリダイレクト
        if($user_informations == NULL){
            return redirect('/forgot-password')->with('flash_message', 'アカウント情報が見つかりません。');
        }else{
            // 秘密の質問の照合
            if (Hash::check($request->secretQuestion, $user_informations->secret_question )) {
                //セッションに書き込む
		        $request->session()->put("userId", $request->userId);
                return view('auth.reset-password');
            }else{
                return redirect('/forgot-password')->with('flash_message', 'アカウント情報が見つかりません。');
            }
        }
    }
}
