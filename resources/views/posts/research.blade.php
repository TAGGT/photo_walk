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
      <h1 class="underline text-2xl font-bold">検索された写真</h1>
    </div>
  <div id=search-form>
  <form action="/posts/research" id="search-photo" method="get" enctype="multipart/form-data">
      @csrf
      <!-- 基本タグ入力欄 -->
      <div class="border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
      <div class="tag">
        <h2>基本タグ</h2>
        <select name="tag_id">
            <option value="0">選択なし</option>
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
      </div>

      <!-- 地名、緯度経度入力欄 -->
      <div class="geo-options border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
      <p>県</p>
      <select id="geoapi-prefectures"></select>
        <button class='decide-button' id='prefecture' type='button'>決定</button>
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
        <button class='decide-button' id='town' type='button'>決定</button>
      </div>
      
      <div class="border-gray-400 w-1/3 border-solid border-2 rounded p-3 m-2">
      <!-- 緯度経度入力欄 -->
      <p>緯度<br>
      <input type="text" name="latitude" id="latitude_form"></p>
      <p class="latitude__error" style="color:red">{{ $errors->first('post.latitude') }}</p>
      <p>経度<br>
      <input type="text" name="longitude" id="longitude_form"></p>
      <p class="longitude__error" style="color:red">{{ $errors->first('post.longitude') }}</p>
      <button class='border-solid border-2 border-gray-500 px-2 m-1 rounded' type='button' onclick="getAxis()">Get Current Position</button>
      <button class='border-solid border-2 border-gray-500 px-2 m-1 rounded' type='button' onclick="redrawMap()">Redraw Map</button>

      <!-- 距離入力欄 -->
      <p>距離(km)</p>
      <select id="distance" name="distance">
      <option>選択なし</option>
      <option value="1">1km</option>
      <option value="5">5km</option>
      <option value="10">10km</option>
      <option value="20">20km</option>
      <option value="50">50km</option>
      <option value="100">100km</option>
      </select>
      </div>
      
      <!-- マップ表示　一応 -->
      <div id="map" style="height:500px; width:70%" class="border-gray-400 border-solid border-2 rounded p-4 m-2"></div>
      

      <p><input class='border-solid border-2 border-gray-500 px-2 mx-2 rounded' type="submit" class="submit" value="検索"></p>
  </form>
  </div>

  <div class='my-photo m-1'>
	@foreach($photos as $photo)
  <div class="container-fulid mt-20">
    <div >
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="flex justify-center w-3/4 p-2 m-1 border-solid border-2 border-gray-500 px-2 rounded">
            <a href='/posts/{{ $photo->id }}'>
              <img src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
            </a>
          </div>
          
          @if($photo->likes()->where('user_id', Auth::user()->id)->count() > 0)
            <a href="{{ route('unlike', $photo) }}" class="btn btn-success btn-sm decide-button m-1" >
              いいねを消す
              <span class="badge">{{ $photo->likes->count() }}</span>
            </a>
          @else
          <a href="{{ route('like', $photo) }}" class="btn btn-secondary btn-sm decide-button m-1">
            いいねをつける
            <span class="badge">{{ $photo->likes->count() }}</span>
          </a>
          @endif
          
        </div>
      </div>
    </div>
  </div>
  @endforeach
	    
	 </div>
  
    <div class='paginate flex justify-center'>
            {{ $photos->links() }}
    </div>

  </main>

  <script src="{{ asset('/js/create.js') }}"></script>
  <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
  <script src="{{ asset('/js/geoapi.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}" async defer></script>

</body>
</x-app-layout>
</html>