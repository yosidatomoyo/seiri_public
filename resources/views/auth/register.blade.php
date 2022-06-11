<!-- 
　 ユーザー登録
  register.blade.php

  Created by 吉田知代 on 2022/04/20.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-guest-layout>
    <div class="space">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
       
        <x-label class="label" for="userId" :value="__('ユーザー登録')" />
        <br>
        <x-label for="userId" :value="__('※ユーザーIDは一度登録すると変更できません')" />
        <x-label for="message" :value="__('※ユーザーIDは5桁以上の半角英数字、パスワードは8桁以上の半角英数字を入力してください。')" />

        <div class="frame">
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <!-- ユーザーID -->
                <div class="mt-4">
                    <x-label for="userId" :value="__('ユーザーID')" />
                    <x-input id="userId" class="block mt-1 w-full" type="text" name="userId" :value="old('userId')" />
                </div>

                <!-- ユーザー名 -->
                <div class="mt-4">
                    <x-label for="name" :value="__('ユーザー名')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"/>
                </div>

                <!-- パスワード -->
                <div class="mt-4">
                    <x-label for="password" :value="__('パスワード')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"/>
                </div>

                <!-- 確認パスワード -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('パスワード(確認)')" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"  />
                </div>

                <!-- 生年月日 -->
                <div class="mt-4">
                    <x-label for="birthday" :value="__('生年月日')" />
                    <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday"/>
                </div>

                <!-- 秘密の質問 -->
                <div class="mt-4">
                    <x-label for="secretQuestion" :value="__('秘密の質問')" />
                    <x-input id="secretQuestion" class="block mt-1 w-full" type="text" name="secretQuestion"/>
                </div>

                <div class="left justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('アカウントお持ちの方はこちら') }}
                    </a>
                </div>

                <div class="center justify-end mt-4">
                    <button class="Button">
                        {{ __('登録') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
