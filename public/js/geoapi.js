'use strict';



$(document).ready(function () {
    var current_city;
    
    function callGeoApi() {
        fetch('https://geoapi.heartrails.com/api/json?method=getTowns&city=新宿') //（1）
            .then((response) => response.json()) //（2）
            .then((res) => {


                // (3)　通信が成功した場合の実行したい処理を記述する
                console.log(res.response.location);

            })

            .catch(error => {
                //(5)
                alert("実行失敗");
                alert(error);
            })

    }

    function setPrefecture() {
        fetch('https://geoapi.heartrails.com/api/json?method=getPrefectures') //（1）
            .then((response) => response.json()) //（2）
            .then((res) => {
                var prefectures = res.response.prefecture;
                var select = $('#geoapi-prefectures'); // <select>要素を取得

                // 配列の各要素をループしてオプションを追加
                $.each(prefectures, function (index, prefecture) {
                    select.append('<option value="' + prefecture + '">' + prefecture + '</option>');
                });
                
                select.trigger('change');
            })
    }



    setPrefecture();
    $('#prefecture').on('click', function () {
        const selected_prefecture = document.getElementById("geoapi-prefectures").value;

        fetch('https://geoapi.heartrails.com/api/json?method=getCities&prefecture=' + selected_prefecture) //（1）
            .then((response) => response.json()) //（2）
            .then((res) => {
                var cities = res.response.location;
                var select = $('#geoapi-cities'); // <select>要素を取得

                // 配列の各要素をループしてオプションを追加 
                $.each(cities, function (index, city) {
                    select.append('<option value="' + city.city + '">' + city.city + '</option>');
                });
                
                select.trigger('change');
            })
    });
    
    $('#city').on('click', function () {
        const selected_city = document.getElementById("geoapi-cities").value;
        current_city = selected_city;
        console.log('current_city='+current_city);
        const initial_char = document.getElementById("initial-form").value;
        fetch('https://geoapi.heartrails.com/api/json?method=getTowns&city=' + selected_city) //（1）
            .then((response) => response.json()) //（2）
            .then((res) => {
                var towns = res.response.location;
                $('select#geoapi-towns option').remove();
                var select = $('#geoapi-towns'); // <select>要素を取得
                select.innerHTML = '';
                // 配列の各要素をループしてオプションを追加 
                $.each(towns, function (index, town) {
                    if (initial_char && initial_char.length > 0) { // inputValueが存在し、長さが0より大きい場合の条件を追加
                        
                        if (town.town_kana.charAt(0) === initial_char.charAt(0)) {
                            console.log(town.town_kana);
                            console.log(initial_char);
                            select.append('<option value="' + town.town + '">' + town.town + '</option>');
                        }
                    } else {
                        alert("文字が入力されていません。");
                    }
                    
                });
                
                select.trigger('change');
            })

        
    });
    
    $('#town').on('click', function () {
        const selected_town = document.getElementById("geoapi-towns").value;

        fetch('https://geoapi.heartrails.com/api/json?method=getTowns&city=' + current_city) //（1）
            .then((response) => response.json()) //（2）
            .then((res) => {
                var towns = res.response.location;
                
                
                // 配列の各要素をループしてオプションを追加 
                $.each(towns, function (index, town) {
                    if (selected_town === town.town) { // inputValueが存在し、長さが0より大きい場合の条件を追加
                        console.log(town);
                        $("#latitude_form").val(town.y);
                        $("#longitude_form").val(town.x);
                        redrawMap();
                    }
                })
                select.trigger('change');
            })

        
    });

});