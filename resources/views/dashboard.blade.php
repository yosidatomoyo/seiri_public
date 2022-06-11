<!-- 
　 ホーム
  dashboard.blade.php

  Created by 吉田知代 on 2022/02/1.
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
        <link rel="stylesheet" href="{{ asset('css/calender.css') }}">
        <script src="{{ url(('js/calender.js')) }}" defer></script>
    </head> 


    <div class="space">
        <div class="row">
            <div class="red col-12 col-md-6">
                <div class="py-4">
                    <div class="max-w-0xl sm:px-1 lg:px-100">
                        <div class="seiriState">
                                <div class="contents">
                                    <div class="item">
                                        <p class ="seiriDateLabel">生理予定日</p>
                                        <p class ="seiriDate">7月31日(水)</p>
                                    </div>
                                    <div class="item">
                                        <p class ="bodyStateStar">体の状態　　☆☆☆☆☆</p>
                                        <p class ="bodyStateStar">妊娠可能性　☆☆☆☆☆</p>
                                    </div>
                                    <div class="item">
                                        <p class ="seiriCountdownLabel">生理日まで</p>
                                        <p class ="seiriCountdown">5日</p>
                                    </div>
                                </div>
                          
                        </div>
                    </div>
                </div>  

                <div class="py-1">
                    <div class="max-w-6xl sm:px-1 lg:px-100">
                            <div class="bodyState">
                                <span class="box-title">○○さんの体の状態</span>
                                <p>生理前症状、大丈夫でしょうか</p>
                                <p>体を冷やさずに、温めると和らぎます</p>

                            </div>
                    </div>
                </div>  
            </div>

            <div class="red col-12 col-md-6">      
                <!-- ボタンクリックで月移動 -->
                <div id="next-prev-button">
                    <button id="prev" onclick="prev()">‹</button>
                    <button id="next" onclick="next()">›</button>
                </div>
                <!-- xxxx年xx月を表示 -->
                <h1 id="header"></h1>

                <!-- カレンダー -->
                <div id="calendar"></div>
            </div>

        </div>
    </div>

    </html>

</x-app-layout>
