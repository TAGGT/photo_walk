<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  @vite('resources/css/app.css')
  <title>Document</title>
</head>

<x-app-layout>
<x-slot name="header">
	Index
</x-slot>

<body>

  <main>
  <form action="/posts/reserch" id="search-photo" method="get" enctype="multipart/form-data">
      @csrf
      <!-- 基本タグ入力欄 -->
      <div class="tag">
        <h2>Category</h2>
        <select name="tag_id">
          @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
          @endforeach
	      </select>
      </div>

      <!-- カスタムタグ入力欄 -->
      <div id=custom_tag_form>
        <p>カスタムタグ(#区切り)<br>
        <textarea class="mt-1" name="custom_tags" cols="20" rows="2"></textarea></p>
        <p class="custom_tag__error" style="color:red">{{ $errors->first('post.custom_tag') }}</p>
      </div>

      <!-- 地名、緯度経度入力欄
      <div class="geo-options  border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
      <p>県</p>
      <select id="geoapi-prefectures"></select>
        <button class='border-solid border-2 border-gray-500 px-2 rounded' id='prefecture' type='button'>決定</button>
      </div>

      <div class="geo-options border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
        <p>市区町村</p>
        <select id="geoapi-cities" name="geoapi-cities"></select>
        <p>市区町村一文字目(ひらがな)<br>
        <input type="text" name="initial" id="initial-form" class="mr-1">
        <button class='border-solid border-2 border-gray-500 px-2 rounded px-1' id='city' type='button'>決定</button></p>
      </div>

      <div class="geo-options  border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
        <p>町域</p>
        <select id="geoapi-towns">
        </select>
        <button class='border-solid border-2 border-gray-500 px-2 rounded' id='town' type='button'>決定</button>
      </div>
      緯度経度入力欄
      <p>緯度<br>
      <input type="text" name="latitude" id="latitude_form"></p>
      <p class="latitude__error" style="color:red">{{ $errors->first('post.latitude') }}</p>
      <p>経度<br>
      <input type="text" name="longitude" id="longitude_form"></p>
      <p class="longitude__error" style="color:red">{{ $errors->first('post.longitude') }}</p>
      
      マップ表示　一応
      <div id="map" style="height:500px"></div>
      <button class='border-solid border-2 border-gray-500 px-2 rounded' type='button' onclick="redrawMap()">Redraw Map</button> -->

      <p><input class='border-solid border-2 border-gray-500 px-2 rounded' type="submit" class="submit" value="検索"></p>
  </form>

  </main>

  <script src="{{ asset('/js/create.js') }}"></script>
  <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
  <script src="{{ asset('/js/geoapi.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}&callback=getAxis" async defer></script>

</body>
</x-app-layout>
</html>