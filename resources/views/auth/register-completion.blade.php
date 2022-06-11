<!-- 
　 ユーザー登録完了
  register-completion.blade.php

  Created by 吉田知代 on 2022/05/20.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->


<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <div class="space">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <x-label class="label" for="userId" :value="__('ユーザー登録完了')" />
        <br>
        <x-label class="center" for="label" :value="__('以下の内容でユーザー登録が完了しました。')" />
        <x-label class="center" for="label" :value="__('ログイン時にユーザーID、パスワードが必要です。')" />
        <x-label class="center" for="label" :value="__('ユーザーIDをお忘れになると再登録が必要になりますので、登録内容をお控えください。')" />


        <div class="frame">
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

                <!-- 生年月日 -->
                <div class="mt-4">
                    <x-label for="birthday" :value="__('生年月日')" />
                    {{ $input["birthday"] }}
                </div>

                <div class="center">
                    <input type="button" class="Button" onclick="location.href='./initialSetting'" value="次へ">
                </div>
        </div>
    </div>
</x-guest-layout>
