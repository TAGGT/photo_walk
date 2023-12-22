<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
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
      <div class="border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
      <p>カスタムタグ(#区切り)<br>
      <textarea class="mt-1" name="custom_tags" cols="20" rows="2"></textarea></p>
      <p class="custom_tag__error" style="color:red">{{ $errors->first('post.custom_tag') }}</p>
      </div>

      <div class="image p-1">
        <input type="file" name="image">
      </div>
      
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

      <!-- 緯度経度入力欄-->
      <div class=" border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
      <p>緯度<br>
      <input type="text" name="post[latitude]" id="latitude_form"></p>
      <p class="latitude__error" style="color:red">{{ $errors->first('post.latitude') }}</p>
      <p>経度<br>
      <input type="text" name="post[longitude]" id="longitude_form"></p>
      <p class="longitude__error" style="color:red">{{ $errors->first('post.longitude') }}</p>
      </div>
      <button class='border-solid border-2 border-gray-500 px-2 m-1 rounded' type='button' onclick="getAxis()">Get Current Position</button>
      <button class='border-solid border-2 border-gray-500 px-2 rounded m-1' type='button' onclick="redrawMap()">Redraw Map</button>
      <div id="map" style="height:400px; width:70%" class="m-2"></div>
      

 

      <div class="tag border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2"">
        <h2>Category</h2>
        <select name="post[tag_id]">
          @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
          @endforeach
	      </select>
      </div>
      
      <p><input class='border-solid border-2 border-gray-500 px-2 rounded submit m-1' type="submit" value="保存"></p>
</form>






  </main>


  <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
  <script src="{{ asset('/js/create.js') }}"></script>
  <script src="{{ asset('/js/geoapi.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}&callback=getAxis" async defer></script>
</body>
</x-app-layout>

</html>