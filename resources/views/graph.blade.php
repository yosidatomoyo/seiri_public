<!-- 
　 ホーム
  graph.blade.php

  Created by 吉田知代 on 2022/05/04.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-app-layout>
    <x-slot name="header">
    </x-slot>


<html lang="ja">

    <head>
    <link rel="stylesheet" href="{{ asset('css/graph.css') }}">
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

        <!--  独自ライブラリ読み込み -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

        <script type="text/javascript" src="{{ url(('js/graph.js')) }}" defer></script>
        
        <script type="text/javascript">
            const posts = @json($seiri_informations);
            const dates = @json($endDate);
        </script>

    </head> 

    <div class="space">
        
        <!-- <div id="next-prev-button">
            <button id="prev" onclick="prev()">‹</button>
            <button id="next" onclick="next()">›</button>
        </div> -->
        <!-- xxxx年xx月を表示 -->
        <div id="next-prev-button">        
        <x-input id="graph_date" 
                type="month" 
                name="graph_date" 
                :value="$endDate->format('Y-m')" 
                min="2020-01"
        />

        </div>
       
        <label>
            基礎体温
        </label>
        <div class="chartWrapper">
            <div class="chartContainer"> 
                <canvas id="bodyTemperatureChart" class="chartStyle"></canvas>
            </div>
        </div>

        <label>
            便通・経血量・おりもの
        </label>
        <div class="chartWrapper">
            <div class="chartContainer2"> 
                <canvas id="amountChart" class="chartStyle"></canvas>
            </div>
        </div>

        <label>
            頭痛・腰痛・腹痛・胸の張り
        </label>
        <div class="chartWrapper">
            <div class="chartContainer2"> 
                <canvas id="acheChart" class="chartStyle"></canvas>
            </div>
        </div>

    </div>

    <script>

        function dateSearch(e) {
            let param = location.search
            let stringParam = String(param);
            let dateParam = stringParam.replace("?day=", "");
            const dateSince = document.getElementById("graph_date");
            const value = e.target.value;
            
            if(value != dateParam){
                var url = new URL(window.location.href);
                    url.searchParams.set('day',value);
                    location.href = url;
            }
        }
            window.onload = () => {
            document.getElementById("graph_date").addEventListener("blur", dateSearch);
            input.focus();

        }


    </script>


    </html>

</x-app-layout>
