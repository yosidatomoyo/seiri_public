<!-- 
　 初期体調情報登録
  initialSetting.blade.php

  Created by 吉田知代 on 2022/05/10.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-app-layout>
    <x-slot name="header">
    </x-slot>


    <html lang="ja">

        <head>
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
            <!-- Required meta tags -->
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!--FontAwesome-->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            <!-- Bootstrap -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        </head> 


        <div class="space">
            <x-condition-input-validation-error class="mb-4" :errors="$errors" />
            <form action="{{ route('initialSetting.store') }}" method="POST">
                @csrf
                    <div class="contents">
                        <div class="itemLabel">
                            <p class ="">{{ __('生理開始日') }}</p>
                        </div>
                        <div class="item">
                            <x-input 
                            id="latest_menstruation_start_date" 
                            type="date" 
                            name="latest_menstruation_start_date" 
                            />
                        </div>
                    </div>
                    <div class="contents">
                        <div class="itemLabel">
                            <p class ="">{{ __('生理周期') }}</p>
                        </div>
                        <div class="item">
                            <x-input id="physiological_cycle" 
                                type="text" 
                                name="physiological_cycle" 
                                maxlength="2" 
                                />
                            {{ __('日') }}
                        </div>
                    </div>

                    <div class="contents">
                        <div class="itemLabel">
                            <p class ="">{{ __('生理期間') }}</p>
                        </div>
                        <div class="item">
                        <select class="listbox js-choices rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                        id="physiological_period" 
                        name="physiological_period">
                            <option value =""></option>
                            @for($i = 1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        {{ __('日') }}
                        </div>
                    </div>
                

                <button type="submit" class="Button">
                    {{ __('登録') }}
                </button>
            </form>
        </div>

    </html>

</x-app-layout>
