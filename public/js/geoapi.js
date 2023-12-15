'use strict';



$(document).ready(function () {
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
            })
    }

    setPrefecture();
});