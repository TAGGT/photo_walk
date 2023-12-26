<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  @vite('resources/css/app.css')
  @vite('resources/css/test.css')
  <title>Document</title>
</head>
<x-app-layout>
<x-slot name="header">
	Index
</x-slot>
<body>

  <main>
    <div class="m-4">
      <h1 class="underline text-2xl font-bold">写真編集</h1>
    </div>
    <!-- ブログの投稿用フォーム -->
    <!-- actionの値の見直し可能性あり -->
    <form action="/posts/{{$photo->id}}" id="post-photo" method="post">
      @csrf
      @method('PUT')
      <div class="tag border-gray-500 w-2/3 border-solid border-2 rounded p-3 m-2">
        <h2>Category</h2>
        <select name="post[tag_id]">
          @foreach($tags as $tag)
            
            @if($photo->tag->id == $tag->id)
              <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
            @else
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endif
          @endforeach
          
	      </select>
      
      <p>カスタムタグ(#区切り)<br>
      <textarea class="mt-1" name="custom_tags" cols="20" rows="2">@foreach ($photo->custom_tags as $custom_tag)#{{$custom_tag->name}}@endforeach</textarea></p>
      <p class="custom_tag__error" style="color:red">{{ $errors->first('post.custom_tag') }}</p>
      </div>
      
      <div class="p-2 m-1 border-solid border-2 border-gray-500 px-2 rounded w-4/5"">
          <div style="width:100%; height:450px;">
            <a href='/posts/{{ $photo->id }}'>
              <img style="object-fit:contain; width:100%; height:100%;" src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
            </a>
          </div>
        </div>

      
      
      <div class="geo-options  border-gray-500 w-2/3 border-solid border-2 rounded p-3 m-2">
      <p>県</p>
      <select id="geoapi-prefectures"></select>
        <button class='decide-button' id='prefecture' type='button'>決定</button>
      </div>

      <div class="geo-options border-gray-500 w-2/3 border-solid border-2 rounded p-3 m-2">
        <p>市区町村</p>
        <select id="geoapi-cities" name="geoapi-cities"></select>
        <p>市区町村一文字目(ひらがな)<br>
        <input type="text" name="initial" id="initial-form" class="mr-1">
        <button class='decide-button' id='city' type='button'>決定</button></p>
      </div>

      <div class="geo-options  border-gray-500 w-2/3 border-solid border-2 rounded p-3 m-2">
        <p>町域</p>
        <select id="geoapi-towns">
        </select>
        <button class='decide-button' id='town' type='button'>決定</button>
      </div>

      <!-- 緯度経度入力欄-->
      <div class=" border-gray-500 w-2/3 border-solid border-2 rounded p-3 m-2">
      <p>緯度<br>
      <input type="text" name="post[latitude]" id="latitude_form" value="{{ $photo->latitude }}"></p>
      <p class="latitude__error" style="color:red">{{ $errors->first('post.latitude') }}</p>
      <p>経度<br>
      <input type="text" name="post[longitude]" id="longitude_form" value="{{ $photo->longitude }}"></p>
      <p class="longitude__error" style="color:red">{{ $errors->first('post.longitude') }}</p>
      </div>
      
      <button class='border-solid border-2 border-gray-500 px-2 m-2 rounded' type='button' onclick="getAxis()">Get Current Position</button>
      <button class='border-solid border-2 border-gray-500 px-2 rounded m-1' type='button' onclick="redrawMap()">Redraw Map</button>
      
      <div id="map" style="height:500px; width:70%" class="border-gray-500 border-solid border-2 rounded p-4 m-2"></div>

      
      
      <p><input class='decide-button submit m-2' type="submit" value="保存"></p>
</form>
  </main>

  <script type="text/javascript">
    var lati = {{ $photo->latitude  }};
    var lngi = {{ $photo->longitude  }};
  </script>
  
  <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
  <script src="{{ asset('/js/create.js') }}"></script>
  <script src="{{ asset('/js/geoapi.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}&callback=redrawMap" async defer></script>
</body>
</x-app-layout>

</html>