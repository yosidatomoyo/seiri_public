<?php

//　ユーザー登録
//  RegisteredUserController.php
//
//  Created by 吉田知代 on 2022/05/3.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Http\Controllers\Auth;

use App\Rules\AlphaNumHalf;
use App\Rules\Hiragana;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\View;

class RegisteredUserController extends Controller
{

    private $formItems = ["userId", "name", "password","birthday","secretQuestion"];

    public function index()
    {
        $users = User::table('users')->get();
        return view('auth.register', ['users' => $users]);
    }

  
    public function create()
    {
        return view('auth.register');
    }

    public function post(Request $request)
    {
        $input = $request->only($this->formItems);
        // バリデーションチェック
        $request->validate([
            'userId' => ['required','unique:users,userId','min:5','max:24',new AlphaNumHalf],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => ['required', 'date', 'max:10'],
            'secretQuestion' => ['required','min:2','max:10',new Hiragana],

        ]);

		//セッションに書き込む
		$request->session()->put("form_input", $input);
        return redirect('/register-confirm'); 
	}

    // 登録確認
    public function confirm(Request $request)
    {
		//セッションから値を取り出す
		$input = $request->session()->get("form_input");
		
		//セッションに値が無い時はフォームに戻る
		if(!$input){
            return redirect('/register'); 
		}
		 return view("auth.register-confirm",["input" => $input]);
	}	

    // 登録処理
    public function store(Request $request)
    {
		//セッションから値を取り出す
		$input = $request->session()->get("form_input");
		
		//セッションに値が無い時はフォームに戻る
		if(!$input){
            return redirect('/register'); 
		}

        // ユーザー情報セット
        $user = User::create([
            'userId' => $input["userId"],
            'name' => $input["name"],
            'password' => Hash::make($input["password"]),
            'birthday' => $input["birthday"],
            'secret_question' => Hash::make($input["secretQuestion"])
        ]);

        // ユーザー情報登録
        event(new Registered($user));

        Auth::login($user);
        return redirect('/register-completion');
    }

    // 登録完了
    public function completion(Request $request)
    {
		//セッションから値を取り出す
		$input = $request->session()->get("form_input");

        //セッションに値が無い時はフォームに戻る
		if(!$input){
            return redirect('/initialSetting'); 
		}

   		//セッションを空にする
		$request->session()->forget("form_input");
        return view("auth.register-completion",["input" => $input]);

    }



   

}
