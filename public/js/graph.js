//
//  graph.js
//
//  Created by 吉田知代 on 2022/05/15.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

    // データ当たりの幅を設定
    var xAxisLabelMinWidth = 15; 
    var post = JSON.stringify(posts);
    function formatDate (date, format) {
        format = format.replace(/yyyy/g, date.getFullYear());
        format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
        format = format.replace(/dd/g, ('0' + date.getDate()).slice(-2));
        return format;
    };

    // 月の日付を取得
    const date = new Date(dates);
    const day = date.setDate(date.getDate() -1);
    dateEnd = parseInt(formatDate(new Date(day), 'dd'));
    var key = 0;

    // カレンダー開始日の設定
    const startday = date.setDate(date.getDate() - (dateEnd -1 ));
    fullDate = formatDate(new Date(startday), 'yyyy-MM-dd');
    // データ登録日
    registerDate = parseInt(formatDate(new Date(posts[0].report_date), 'dd'));

    // 登録データ数のカウント
    for (var key in posts) {
    }
    var registerCount = parseInt(key)+1;

    // 日付データ格納配列
    var dayArray = new Array();
    // 体温データ格納配列
    var bodyTemperature = new Array();
    // 便通データ格納配列
    var constipationVolume = new Array();
    // 経血量データ格納配列
    var menstrualBloodVolume = new Array();
    // おりものデータ格納配列
    var menstrualDischargeVolume = new Array();
    // 頭痛データ格納配列
    var headache = new Array();
    // 腰痛データ格納配列
    var lowerBackPain = new Array();
    // 腹痛データ格納配列
    var stomachAche = new Array();
    // 胸の張りデータ格納配列
    var chestTension = new Array();
    var keyCount = 0;

    // 月日分データを格納する
    for (let step = 1; step <= dateEnd; step++) {
        // 日付ラベルデータを格納
        dayArray.push(step);

        if(registerDate == step){
            // データが登録されている場合配列にデータを追加
            bodyTemperature.push(posts[keyCount].body_temperature);  
            constipationVolume.push(posts[keyCount].constipation_volume); 
            menstrualBloodVolume.push(posts[keyCount].menstrual_blood_volume); 
            menstrualDischargeVolume.push(posts[keyCount].menstrual_discharge_volume); 
            headache.push(posts[keyCount].headache); 
            lowerBackPain.push(posts[keyCount].lower_back_pain); 
            stomachAche.push(posts[keyCount].stomach_ache); 
            chestTension.push(posts[keyCount].chest_tension); 

            keyCount = parseInt(keyCount)+1;
            console.log('keyCount'+keyCount);
            console.log('registerCount'+registerCount);

            if(keyCount < registerCount){
                registerDate = parseInt(formatDate(new Date(posts[keyCount].report_date), 'dd'));
            }
        } else{
            // データが存在しない場合NULLを格納
            bodyTemperature.push(null);
            constipationVolume.push(24);
            menstrualBloodVolume.push(24);
            menstrualDischargeVolume.push(24);
            headache.push(18);
            lowerBackPain.push(18);
            stomachAche.push(18);
            chestTension.push(18);
        }
    }

    // 基礎体温
    // グラフ全体の幅を計算
    var width = bodyTemperature.length*xAxisLabelMinWidth; 
    //　グラフの幅を設定
    document.getElementById('bodyTemperatureChart').style.width = "1000px"; 
    //htmlと同じ高さを設定
    document.getElementById('bodyTemperatureChart').style.height = "200px"; 

    var myChart = new Chart(document.getElementById('bodyTemperatureChart').getContext('2d'), {
        type: 'line',
        data: {
        labels: dayArray,
            datasets: [{
                labels: dayArray,
                //折れ線グラフ
                type: 'line',  
                label: "体温(℃)",
                data: bodyTemperature,
                backgroundColor: "#ffc0cb",
                borderColor: "rgb(255, 99, 132)",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            }]
        },
        options: {
            responsive: false, //trueにすると画面の幅に合わせて作図してしまう
            tooltips:{
                callbacks: 
                {
                    title: function (tooltipItem, data) {
                        return tooltipItem[0].xLabel + "日"
                    }
                    
                }
            }
        }

    });

    // 便通・経血量・おりもの
    // データ当たりの幅を設定
    var xAxisLabelMinWidth = 15; 
    // グラフ全体の幅を計算
    var width = constipationVolume.length*xAxisLabelMinWidth; 
    //　グラフの幅を設定
    document.getElementById('amountChart').style.width = "1000px"; 
    //htmlと同じ高さを設定
    document.getElementById('amountChart').style.height = "200px"; 

    var myChart = new Chart(document.getElementById('amountChart').getContext('2d'), {
        type: 'line',
        data: {
        labels: dayArray,
            datasets: [
                {
                labels: dayArray,
                //折れ線グラフ
                type: 'line', 
                label: "便通",
                data: constipationVolume,
                backgroundColor: "#008000",
                borderColor: "#008000",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            },
            {
                labels: dayArray,
                //折れ線グラフ
                type: 'line',  
                label: "経血量",
                data: menstrualBloodVolume,
                backgroundColor: "#ffc0cb",
                borderColor: "#ffc0cb",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            },
            {
                labels: dayArray,
                //折れ線グラフ
                type: 'line',  
                label: "おりもの",
                data: menstrualDischargeVolume,
                backgroundColor: "#ffa500",
                borderColor: "#ffa500",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            }
        ]
        },
        options: {
            //trueにすると画面の幅に合わせて作図してしまう
            responsive: false, 
            scales: {
                //Y軸のオプション
                yAxes: [
                    {
                    scaleLabel: {
                        display: true,  
                    },
                    ticks: {
                        fontColor: "black",
                        beginAtZero: true,
                        max: 27,
                        min: 24,
                        stepSize: 1,
                        callback: function(value) {
                            if (value  == 25){
                                return '少ない'
                            }
                            else if(value  == 26){
                                return  '普通'
                            }else if(value == 27){
                                return  '多い'
                            }else{
                                return  'なし'
                            }
                        },
                    }
                },
                ]
            },
            tooltips:{
                callbacks: 
                {
                    title: function (tooltipItem, data) {
                        return tooltipItem[0].xLabel + "日"
                    },
                    label: function (tooltipItem, data) {
                        if (tooltipItem.yLabel  == 25){ 
                            return "少ない"
                        }else if(tooltipItem.yLabel  == 26){
                            return  "普通"
                        }else if(tooltipItem.yLabel == 27){
                            return  "多い"
                        }else{
                            return  "なし"
                        }
                    }
                }
            }
        }
    });

    // 頭痛・腰痛・腹痛・胸の張り
    // データ当たりの幅を設定
    var xAxisLabelMinWidth = 15; 
    // グラフ全体の幅を計算
    var width = headache.length*xAxisLabelMinWidth; 
    //　グラフの幅を設定
    document.getElementById('acheChart').style.width = "1000px"; 
    //htmlと同じ高さを設定
    document.getElementById('acheChart').style.height = "200px"; 

    var myChart = new Chart(document.getElementById('acheChart').getContext('2d'), {
        type: 'line',
        data: {
        labels: dayArray,
            datasets: [
                {
                labels: dayArray,
                //折れ線グラフ
                type: 'line',  
                label: "頭痛",
                data: headache,
                backgroundColor: "#008000",
                borderColor: "#008000",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            },
            {
                labels: dayArray,
                //折れ線グラフ
                type: 'line',  
                label: "腰痛",
                data: lowerBackPain,
                backgroundColor: "#ffc0cb",
                borderColor: "#ffc0cb",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            },
            {
                labels: dayArray,
                type: 'line',  //折れ線グラフ
                label: "腹痛",
                data: stomachAche,
                backgroundColor: "#ffa500",
                borderColor: "#ffa500",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            },
            {
                labels: dayArray,
                //折れ線グラフ
                type: 'line',  
                label: "胸の張り",
                data: chestTension,
                backgroundColor: "#00bfff",
                borderColor: "#00bfff",
                borderWidth: 1.2,
                //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                pointStyle: 'circle',
                //ポイントの半径
                radius: 4,
                //ホバー時の先の太さ
                pointHoverBorderWidth: 2,
                // //ベジェ曲線の張力（0＝直線） 
                // lineTension: 0,
                //線下を塗りつぶすかどうか
                fill: false,
                //軸のID（複数軸存在する場合）
                spanGaps: true
            }
        ]
        },
        options: {
            //trueにすると画面の幅に合わせて作図してしまう
            responsive: false, 
                scales: {
                    //Y軸のオプション
                    yAxes: [{
                        scaleLabel: {
                            display: true,  
                        },
                        ticks: {
                            fontColor: "black",
                            beginAtZero: true,
                            max: 21,
                            min: 18,
                            stepSize: 1,
                            // display: false,
                            showLabelBackdrop:true,
                            callback: function(value) {
                                if (value  == 19){ 
                                    return '少し痛い'
                                }else if(value  == 20){
                                    return  '痛い'
                                }else if(value == 21){
                                    return  'すごく痛い'
                                }else{
                                    return  '痛みなし'
                                }
                            },
                        },
                    }]
            },
            tooltips:{
                callbacks: 
                {
                    title: function (tooltipItem, data) {
                        return tooltipItem[0].xLabel + "日"
                    },
                    label: function (tooltipItem, data) {
                        if (tooltipItem.yLabel  == 19){ 
                            return "少し痛い"
                        }else if(tooltipItem.yLabel  == 20){
                            return  "痛い"
                        }else if(tooltipItem.yLabel == 21){
                            return  "すごく痛い"
                        }else{
                            return  "痛みなし"
                        }
                    }
                }
            }
        }
    });


