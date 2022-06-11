<!-- 
　 設定
  setting.blade.php

  Created by 吉田知代 on 2022/05/20.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-app-layout>
    <x-slot name="header">
    </x-slot>


<html lang="ja">

    <head>
    <link rel="stylesheet" href="{{ asset('css/setting.css') }}">
    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frame.css') }}">


        <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--FontAwesome-->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!--   jQuery・bootstrapライブラリ読み込み -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head> 

    <div class="space">
        <form action="{{ route('setting.store') }}" method="POST">
        @csrf
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="frame">
                <x-label for="userId" class="contents" :value="__('ユーザーID')" />         
                <x-label class="userId" :value="$user_informations->userId" /> 

                <x-label for="username" class="contents"  :value="__('ユーザー名')" />         
                <div class="contents underSpace">
                    <x-input 
                        class="block mt-1 w-full"
                        id="name" 
                        type="text" 
                        name="name" 
                        
                        :value="$user_informations->name" 
                    />
                </div>

                <x-label for="birthday" class="contents"  :value="__('生年月日')" />         
                <div class="contents underSpace">
                    <x-input
                    class="block mt-1 w-full"
                    id="birthday" 
                    type="date" 
                    name="birthday" 
                    :value="$user_informations->birthday" 
                />                            
                </div>
            
     
                <x-label for="password" class="contents"  :value="__('新しいパスワード')" />         
                <div class="contents underSpace">
                    <x-input 
                    class="block mt-1 w-full"
                    id="password"
                    type="password" 
                    name="password" 
                    value="" 
                    />                          
                </div>

  
                <x-label for="password_confirmation" class="contents"  :value="__('新しいパスワード（確認）')" />         
                <div class="contents underSpace">
                    <x-input 
                    class="block mt-1 w-full"
                    id="password_confirmation"
                    type="password" 
                    name="password_confirmation" 
                    value=""
                    />   
                            
                </div>


                <x-label for="current_password" class="contents" :value="__('ご本人確認のため、現在のパスワードを入力してください')" />         

                <div class="contents underSpace">
                <x-input 
                    class="block mt-1 w-full"
                    id="current_password"
                    type="password" 
                    name="current_password" 
                    value=""
                    />                               
                </div>

                <div>
                    <a class="underline block font-medium text-midium text-gray-700" href="{{ route('password.request') }}">
                        {{ __('パスワードを忘れた方はこちら') }}
                    </a>
                </div>
                <div>
                    <a class="underline block font-medium text-midium text-gray-700" href="{{ route('login') }}">
                        {{ __('アカウント削除') }}
                    </a>
                </div>

        </div>
        <div>
            <div class="ButtonSet">
                <button class="Button" type="submit">{{ __('変更') }}</button>
            </div>
        </div>

        </form>
    </div>

    </html>

</x-app-layout>
