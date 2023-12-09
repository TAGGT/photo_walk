<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<x-app-layout>
<x-slot name="header">
	Index
</x-slot>
<body>

  <main>
	  <div class='my-photo'>
		    <div>
          <img src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
        </div>
	  </div>

    <div id="map" style="height:500px"></div>

    <div class='tags'>
		    <p>{{ $photo->tag->name }}</p>
        <p>
          @foreach ($photo->custom_tags as $custom_tag)
          {{$custom_tag->name}}
          @endforeach
        </p>
	  </div>
    <form action="/posts/{{ $photo->id }}" id="form_{{ $photo->id }}" method="post">
      @csrf
      @method('DELETE')
      <button type="button" onclick="deletePhoto({{ $photo->id }})">delete</button> 
    </form>
    <a href="/posts/{{ $photo->id }}/edit">edit</a>

	  <a href='/posts/home'>return</a>
	  


  </main>


  <script>
  
  function deletePhoto(id) {
  	'use strict'
  	if(confirm('投稿の削除を実行しますか？')){
  		document.getElementById(`form_${id}`).submit();
  	}
  }

  function initMap() {
                map = document.getElementById("map");
                
                // 東京タワーの緯度、経度を変数に入れる
                let axis = {lat: {{$photo->latitude}}, lng: {{$photo->longitude}} };

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

<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}&callback=initMap" async defer></script>
</body>
</x-app-layout>
</html>