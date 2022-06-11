<!-- 
　 ユーザー登録確認
  register-confirm.blade.php

  Created by 吉田知代 on 2022/05/20.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->


<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <div class="space">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <x-label class="label" for="userId" :value="__('ユーザー登録確認')" />
        <br>
        <x-label class="center" for="label" :value="__('以下の内容で登録を行います。よろしければ画面下の「登録」を押して下さい。')" />


        <div class="frame">
            <form method="POST" action="{{ route('register-confirm.store') }}">
                @csrf

                <!-- ユーザーID -->
                <div class="mt-4">
                    <x-label for="userId" :value="__('ユーザーID')" />
                     {{ $input["userId"] }} 
                </div>

                <!-- ユーザー名 -->
                <div class="mt-4">
                    <x-label for="name" :value="__('ユーザー名')" />
                    {{ $input["name"] }}
                </div>


                <!-- パスワード -->
                <div class="mt-4">
                    <x-label for="password" :value="__('パスワード')" />
                    {{ $input["password"] }}
                </div>

                <!-- 生年月日 -->
                <div class="mt-4">
                    <x-label for="birthday" :value="__('生年月日')" />
                    {{ $input["birthday"] }}
                </div>

                <!-- 秘密の質問 -->
                <div class="mt-4">
                    <x-label for="birthday" :value="__('秘密の質問')" />
                    {{ $input["secretQuestion"] }}
                </div>

                <div class="center">
                    <button class="Button" type="button" onClick="history.back()" >
                        {{ __('戻る') }}
                    </button>
                    <button class="Button">
                        {{ __('登録') }}
                    </button>

                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
