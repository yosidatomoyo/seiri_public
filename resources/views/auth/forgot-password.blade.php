
<!-- 
　 ユーザー情報確認（パスワード変更）
  forgot-password.blade.php

  Created by 吉田知代 on 2022/06/3.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-guest-layout>
    <div class="space">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        @if (session('flash_message'))
            <div class="flash_message font-medium text-red-600">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="login">

        <div class="mt-4">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('ユーザー情報の確認を行います。') }}
            </div>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('ユーザーID、生年月日、秘密の質問を入力しユーザー確認ボタンを押してください。') }}
            </div>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('※ユーザーIDをお忘れの方はアカウントの再登録をお願いします。') }}
            </div>
        </div>

            <form method="POST" action="{{ route('password.request') }}">
                @csrf 

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="userId" :value="__('ユーザーID')" />
                    <x-input id="userId"  class="block mt-1 w-full" type="text" name="userId"/>
                </div>

                <div class="mt-4">
                    <x-label for="birthday" :value="__('生年月日')" />
                    <x-input id="birthday"  class="block mt-1 w-full" type="date" name="birthday"/>
                </div>

                <div class="mt-4">
                    <x-label for="secretQuestion" :value="__('秘密の質問')" />
                    <x-input id="secretQuestion"  class="block mt-1 w-full" type="text" name="secretQuestion"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('ユーザー確認') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

