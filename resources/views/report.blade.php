<!-- 
　 レポート
  report.blade.php

  Created by 吉田知代 on 2022/05/01.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->

<x-app-layout>
    <x-slot name="header">
    </x-slot>


<html lang="ja">

    <head>
    <link rel="stylesheet" href="{{ asset('css/report.css') }}">
        <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--FontAwesome-->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head> 

    <div class="space">
        <div class="contents">
            <button id="prev" class="prev-button" onclick="prev()">‹</button>

                <x-input id="report_date" 
                type="date" 
                name="report_date" 
                :value="$date->format('Y-m-d')" 
                required autofocus/>
            
            <button id="next" class="prev-button" onclick="next()">›</button>
       
        </div>

        <div class="row">

            <div class="red col-12 col-md-6">
                <?php 
                    for($i = 1; $i < 5; $i++){
                ?>

                <div>
                    <?php echo $seiri_informations[$i]->report_date  ?>
                </div>  

                    <div class="contents dashed">                           
                        <div class="itemDayReport">
                            <div class="contents">
                                <div class="itemLabel">
                                    <p>体温　　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if(!($seiri_informations[$i]->body_temperature == null)){
                                        echo $seiri_informations[$i]->body_temperature .'℃';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>気分　　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if($seiri_informations[$i]->feeling == 22){
                                        echo '良い';
                                    }else if($seiri_informations[$i]->feeling == 23){
                                        echo '普通';
                                    }else if($seiri_informations[$i]->feeling == 24){
                                        echo '悪い';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>生理痛　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->menstrual_pain == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->menstrual_pain == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->menstrual_pain == 21){
                                            echo 'すごく痛い';
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>経血量　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->menstrual_blood_volume == 25){
                                            echo '少ない';
                                        }else if($seiri_informations[$i]->menstrual_blood_volume == 26){
                                            echo '普通';
                                        }else if($seiri_informations[$i]->menstrual_blood_volume == 27){
                                            echo '多い';
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>おりもの：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if($seiri_informations[$i]->menstrual_discharge_color == 25){
                                        echo '少ない';
                                    }else if($seiri_informations[$i]->menstrual_discharge_color == 26){
                                        echo '普通';
                                    }else if($seiri_informations[$i]->menstrual_discharge_color == 27){
                                        echo '多い';
                                    }                       
                                    ?>
                                </div>
                            </div>

                        </div>  

                        <div class="itemDayReport ">

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>便通：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if($seiri_informations[$i]->constipation_color == 25){
                                        echo '少ない';
                                    }else if($seiri_informations[$i]->constipation_color == 26){
                                        echo '普通';
                                    }else if($seiri_informations[$i]->constipation_color == 27){
                                        echo '多い';
                                    }                                   
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>頭痛：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->headache == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->headache == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->headache == 21){
                                            echo 'すごく痛い';
                                        }  
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>腰痛：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->lower_back_pain == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->lower_back_pain == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->lower_back_pain == 21){
                                            echo 'すごく痛い';
                                        }                                     
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>腹痛：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->stomach_ache == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->stomach_ache == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->stomach_ache == 21){
                                            echo 'すごく痛い';
                                        }                                        
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>胸の張り：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->chest_tension == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->chest_tension == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->chest_tension == 21){
                                            echo 'すごく痛い';
                                        }                                    
                                    ?>
                                </div>
                            </div>

                        </div>  
                    </div>  
                    <br>  
                <?php
                }
                ?>   
            </div>



            <div class="red col-12 col-md-6">
                <?php 
                    for($i = 5; $i < 8; $i++){
                ?>
                <div>
                    <?php echo $seiri_informations[$i]->report_date  ?>
                </div>  
                    <div class="contents dashed">                           
                        <div class="itemDayReport">
                            <div class="contents">
                                <div class="itemLabel">
                                    <p>体温　　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if(!($seiri_informations[$i]->body_temperature == null)){
                                        echo $seiri_informations[$i]->body_temperature .'℃';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>気分　　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if($seiri_informations[$i]->feeling == 22){
                                        echo '良い';
                                    }else if($seiri_informations[$i]->feeling == 23){
                                        echo '普通';
                                    }else if($seiri_informations[$i]->feeling == 24){
                                        echo '悪い';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>生理痛　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->menstrual_pain == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->menstrual_pain == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->menstrual_pain == 21){
                                            echo 'すごく痛い';
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>経血量　：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->menstrual_blood_volume == 25){
                                            echo '少ない';
                                        }else if($seiri_informations[$i]->menstrual_blood_volume == 26){
                                            echo '普通';
                                        }else if($seiri_informations[$i]->menstrual_blood_volume == 27){
                                            echo '多い';
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>おりもの：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if($seiri_informations[$i]->menstrual_discharge_color == 25){
                                        echo '少ない';
                                    }else if($seiri_informations[$i]->menstrual_discharge_color == 26){
                                        echo '普通';
                                    }else if($seiri_informations[$i]->menstrual_discharge_color == 27){
                                        echo '多い';
                                    }                       
                                    ?>
                                </div>
                            </div>

                        </div>  

                        <div class="itemDayReport ">

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>便通：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                    if($seiri_informations[$i]->constipation_color == 25){
                                        echo '少ない';
                                    }else if($seiri_informations[$i]->constipation_color == 26){
                                        echo '普通';
                                    }else if($seiri_informations[$i]->constipation_color == 27){
                                        echo '多い';
                                    }                                   
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>頭痛：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->headache == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->headache == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->headache == 21){
                                            echo 'すごく痛い';
                                        }  
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>腰痛：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->lower_back_pain == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->lower_back_pain == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->lower_back_pain == 21){
                                            echo 'すごく痛い';
                                        }                                     
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>腹痛：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->stomach_ache == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->stomach_ache == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->stomach_ache == 21){
                                            echo 'すごく痛い';
                                        }                                        
                                    ?>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p>胸の張り：</p>
                                </div>
                                <div class="item">
                                    <?php 
                                        if($seiri_informations[$i]->chest_tension == 19){
                                            echo '少し痛い';
                                        }else if($seiri_informations[$i]->chest_tension == 20){
                                            echo '痛い';
                                        }else if($seiri_informations[$i]->chest_tension == 21){
                                            echo 'すごく痛い';
                                        }                                    
                                    ?>
                                </div>
                            </div>

                        </div>  
                    </div>  
                    <br>  
                <?php
                }
                ?>   
            </div>
        </div>
    </div>

    <script>
        function formatDate (date, format) {
            format = format.replace(/yyyy/g, date.getFullYear());
            format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
            format = format.replace(/dd/g, ('0' + date.getDate()).slice(-2));
            return format;
        };

        function prev(e) {
            let param = location.search
            let stringParam = String(param);
            let dateParam = stringParam.replace("?day=", "");  
            var dt = new Date(dateParam);
            let prevDay = '';
            if(!(dateParam)){
                var dt = new Date(); 
                prevDay = dt.setDate(dt.getDate() - 14);
            }else{
                prevDay = dt.setDate(dt.getDate() - 7);

            }    

            date = formatDate(new Date(prevDay), 'yyyy-MM-dd');
            
            var url = new URL(window.location.href);
                    url.searchParams.set('day',date);
                    location.href = url;

        }

        function next() {
            let param = location.search
            let stringParam = String(param);
            let dateParam = stringParam.replace("?day=", "");  
            var dt = new Date(dateParam);

            let prevDay = '';
            if(!(dateParam)){
                var dt = new Date(); 
                prevDay = dt.setDate(dt.getDate());
            }else{
                prevDay = dt.setDate(dt.getDate() + 7);

            }   
            date = formatDate(new Date(prevDay), 'yyyy-MM-dd');
            
            var url = new URL(window.location.href);
                    url.searchParams.set('day',date);
                    location.href = url;

        }

        function dateSearch(e) {
            let param = location.search
            let stringParam = String(param);
            let dateParam = stringParam.replace("?day=", "");
            const dateSince = document.getElementById("report_date");
            const value = e.target.value;


            if(value != dateParam){
                var url = new URL(window.location.href);
                    url.searchParams.set('day',value);
                    location.href = url;
            }
        }

        window.onload = () => {
        document.getElementById("report_date").addEventListener("blur", dateSearch);
        input.focus();
        }


    </script>

    </html>

</x-app-layout>
