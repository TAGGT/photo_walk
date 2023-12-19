<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<<<<<<< HEAD
  @vite('resources/css/app.css') 
=======
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
>>>>>>> testTail
</head>
<x-app-layout>
<x-slot name="header">
	Index
</x-slot>
<body>

  <main>
    <h1 class="text-3xl bg-red-500 font-bold underline">
    Hello world!
  </h1>
    <!-- ブログの投稿用フォーム -->
    <!-- actionの値の見直し可能性あり -->
    <form action="/posts" id="post-photo" method="post" enctype="multipart/form-data">
      @csrf
<<<<<<< HEAD
      <p class="font-bold">カスタムタグ<br>
=======
      <p　class="font-bold">カスタムタグ<br>
>>>>>>> testTail
      <textarea name="custom_tags" cols="20" rows="2">{{ old('post.custom_tag') }}</textarea></p>
      <p class="custom_tag__error" style="color:red">{{ $errors->first('post.custom_tag') }}</p>

      <div class="image">
        <input type="file" name="image">
      </div>
      
      <div class="geo-options">
        <select id="geoapi-prefectures">
        </select>
        <button id='prefecture' type='button'>決定</button>
      </div>

      <div class="geo-options">
        <select id="geoapi-cities" name="geoapi-cities">
        </select>
        <p>一文字目(ひらがな)<br>
        <input type="text" name="initial" id="initial-form"></p>
        <button id='city' type='button'>決定</button>
      </div>

      <div class="geo-options">
        <select id="geoapi-towns">
        </select>
        <button id='town' type='button'>決定</button>
      </div>

      <p>緯度<br>
      <input type="text" name="post[latitude]" id="latitude_form"></p>
      <p class="latitude__error" style="color:red">{{ $errors->first('post.latitude') }}</p>
      <p>経度<br>
      <input type="text" name="post[longitude]" id="longitude_form"></p>
      <p class="longitude__error" style="color:red">{{ $errors->first('post.longitude') }}</p>
      <div id="map" style="height:500px"></div>
      <button type='button' onclick="redrawMap()">Redraw Map</button>

 

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


  <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
  <script src="{{ asset('/js/create.js') }}"></script>
  <script src="{{ asset('/js/geoapi.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}&callback=getAxis" async defer></script>
</body>
</x-app-layout>

</html>