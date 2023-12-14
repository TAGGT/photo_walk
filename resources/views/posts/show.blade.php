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
    <div class='tags'>
		    <p>{{ $photo->tag->name }}</p>
        <p>
          @foreach ($photo->custom_tags as $custom_tag)
          {{$custom_tag->name}}
          @endforeach
        </p> 
	  </div>
	  <div id="map" style="height:500px"></div>
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