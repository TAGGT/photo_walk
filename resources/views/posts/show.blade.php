<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  @vite('resources/css/app.css')
  @vite('resources/css/test.css')
</head>
<x-app-layout>
<x-slot name="header">
	Index
</x-slot>
<body>

  <main>
    <div class="m-4">
      <h1 class="underline text-2xl font-bold">写真</h1>
    </div>
	  
    <div class="p-2 m-1 border-solid border-2 border-gray-500 px-2 rounded w-4/5"">
          <div style="width:100%; height:450px;">
              <img style="object-fit:contain; width:100%; height:100%;" src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
          </div>
        </div>
    
    <div class='tags border-gray-500 w-1/3 border-solid border-2 rounded p-3 m-2'>
		    <p>基本タグ:<span class="font-bold">{{ $photo->tag->name }}</span></p>
        <p>カスタムタグ:
          <span class="font-bold">
            @foreach ($photo->custom_tags as $custom_tag)
              {{$custom_tag->name}} 
            @endforeach
          </span>
        </p> 
	  </div>
	  
	  
	  <div id="map" style="height:500px; width:70%" class="border-gray-500 border-solid border-2 rounded p-4 m-2"></div>
    
    <div class="edit-buttons flex">
      @if($photo->user_id == Auth::user()->id)
      <form action="/posts/{{ $photo->id }}" id="form_{{ $photo->id }}" method="post">
          @csrf
          @method('DELETE')
          <button type="button" class="decide-button m-2" onclick="deletePhoto({{ $photo->id }})">delete</button> 
        </form>
        <a  class="decide-button m-2" href="/posts/{{ $photo->id }}/edit">edit</a>
      @endif
   
      
    </div>
    

	  <a  class="decide-button m-2" href='/posts/home'>return</a>
	  
  </main>


  <script>
function deletePhoto(id) {
  	'use strict'
  	if(confirm('投稿の削除を実行しますか？')){
  		document.getElementById(`form_${id}`).submit();
  	}
  }
  </script>

<script type="text/javascript">
  var lati = {{ $photo->latitude  }};
  var lngi = {{ $photo->longitude  }};
</script>
  <script src="{{ asset('/js/create.js') }}"></script>
  
  
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$map_api}}&callback=drawMap" async defer></script>
</body>
</x-app-layout>

</html>