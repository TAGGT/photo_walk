<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<x-app-layout>
<x-slot name="header">
	Index
</x-slot>
<body>

  <main>
    <!-- ブログの投稿用フォーム -->
    <!-- actionの値の見直し可能性あり -->
    <form action="/posts" id="post-photo" method="post" enctype="multipart/form-data">
      @csrf
      <p>カスタムタグ<br>
      <textarea name="custom_tags" cols="20" rows="2">{{ old('post.custom_tag') }}</textarea></p>
      <p class="custom_tag__error" style="color:red">{{ $errors->first('post.custom_tag') }}</p>

      <div class="image">
        <input type="file" name="image">
      </div>

      <p>緯度<br>
      <input type="text" name="post[latitude]" id="latitude_form"></p>
      <p class="latitude__error" style="color:red">{{ $errors->first('post.latitude') }}</p>
      <p>経度<br>
      <input type="text" name="post[longitude]" id="longitude_form"></p>
      <p class="longitude__error" style="color:red">{{ $errors->first('post.longitude') }}</p>
      <div id="map" style="height:500px"></div>
      <button onclick="redrawMap()">Redraw Map</button>

 

      <div class="tag">
        <h2>Category</h2>
        <select name="post[tag_id]">
          @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
          @endforeach
	      </select>
      </div>
      
      <p><input type="submit" class="submit" value="保存"></p>
</form>
  </main>


  <script>
  
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
                let axis = {lat: latitudeElement.value, lng: longitudeElement.value };

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
  </script>
</body>
</x-app-layout>

</html>