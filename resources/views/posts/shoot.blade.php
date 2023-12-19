<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  @vite('resources/css/app.css')
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

      <!-- 画像入力欄 -->
      <div class="image">
        <input type="file" name="image" capture="user" accept="video/*">
      </div>

      <!-- 緯度経度入力欄 -->
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


  <script src="{{ asset('/js/create.js') }}"></script>
  
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}&callback=getAxis" async defer></script>
</body>
</x-app-layout>

</html>