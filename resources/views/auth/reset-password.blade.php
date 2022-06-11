<!-- 
　 パスワード変更
  reset-password.blade.php

  Created by 吉田知代 on 2022/06/20.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf


            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('新しいパスワード')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('新しいパスワード(確認)')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('パスワード変更') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
