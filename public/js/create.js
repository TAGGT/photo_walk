  
  function getAxis() {
    navigator.geolocation.getCurrentPosition(initMap);
}

function initMap(position) {

    //var geo_text = "緯度:" + position.coords.latitude + "\n";
    //geo_text += "経度:" + position.coords.longitude + "\n";

    var longitudeElement = document.getElementById("longitude_form");

    longitudeElement.value = position.coords.longitude;

    var latitudeElement = document.getElementById("latitude_form");

    latitudeElement.value = position.coords.latitude;

    //initMapの
    map = document.getElementById("map");
                
    // 東京タワーの緯度、経度を変数に入れる
    let axis = {lat: position.coords.latitude, lng: position.coords.longitude };

    // オプションの設定
    opt = {
      // 地図の縮尺を指定
      zoom: 13,

      // センターを東京タワーに指定
      center: axis,
    };

    // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
    mapObj = new google.maps.Map(map, opt);

    marker = new google.maps.Marker({
    // ピンを差す位置を東京タワーに設定
    position: axis,

    // ピンを差すマップを指定
    map: mapObj,

    // ホバーしたときに「tokyotower」と表示されるように指定

    title: 'Object',
  });     

}

  function redrawMap() {
                map = document.getElementById("map");
                var longitudeElement = document.getElementById("longitude_form");

                var latitudeElement = document.getElementById("latitude_form");
                
                // 東京タワーの緯度、経度を変数に入れる
                let axis = {lat: parseFloat(latitudeElement.value), lng: parseFloat(longitudeElement.value) };

                // オプションの設定
                opt = {
                    // 地図の縮尺を指定
                    zoom: 13,

                    // センターを東京タワーに指定
                    center: axis,
                };

                // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
                mapObj = new google.maps.Map(map, opt);

                marker = new google.maps.Marker({
                    // ピンを差す位置を東京タワーに設定
                    position: axis,

                    // ピンを差すマップを指定
                    map: mapObj,

                    // ホバーしたときに「tokyotower」と表示されるように指定

                    title: 'Object',
                });
            }
            
            function drawMap() {
                map = document.getElementById("map");
                
                
                // 東京タワーの緯度、経度を変数に入れる
                let axis = {lat:  lati , lng:  lngi  };

                // オプションの設定
                opt = {
                    // 地図の縮尺を指定
                    zoom: 13,

                    // センターを東京タワーに指定
                    center: axis,
                };

                // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
                mapObj = new google.maps.Map(map, opt);

                marker = new google.maps.Marker({
                    // ピンを差す位置を東京タワーに設定
                    position: axis,

                    // ピンを差すマップを指定
                    map: mapObj,

                    // ホバーしたときに「tokyotower」と表示されるように指定

                    title: 'Object',
                });
            }