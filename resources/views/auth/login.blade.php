<!-- 
　 ログイン
  login.blade.php

  Created by 吉田知代 on 2022/03/03.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    @if (session('flash_message'))
        <div class="flash_message font-medium text-green-600">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="space">
        <div class="label">
            ログイン
        </div>
        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-label for="userId" :value="__('ユーザーID')" />
                    <x-input id="iuserIdd" class="block mt-1 w-full" type="text" name="userId" :value="old('userId')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('パスワード')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('オートログインを有効にする') }}</span>
                    </label>
                </div>

                <div class="buttonSet">
                    <button class="loginButton">
                        {{ __('ログイン') }}
                    </button>
                </div>
                
            </form>
        </div>
    </div>
    <div class="center">
        <div>
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}" >
                    {{ __('新規会員登録の方') }}
                </a>
            @endif
        </div>
        <div>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('パスワードをお忘れの方') }}
                </a>
            @endif
        </div>
    </div>
</x-guest-layout>
