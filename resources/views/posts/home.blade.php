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
    <div class='user-name'>
      {{Auth::user()->name}}
    </div>
	  <div class='my-photo'>
	    @foreach ($photos as $photo)
		    <div>
          <a href='/posts/{{ $photo->id }}'>
            <img src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
          </a>
        </div>
        <a href="/like/{{$photo->id}}" class="btn btn-secondary btn-sm">
          いいねをつける
          <span class="badge">{{ $post->nices->count() }}</span>
        </a>
	    @endforeach
	  </div>
	  <a href='/posts/create'>create</a>

  </main>


  <script>
  
  function deletePost(id) {
  	'use strict'
  	if(confirm('投稿の削除を実行しますか？')){
  		document.getElementById(`form_${id}`).submit();
  	}
  }
  </script>
</body>
</x-app-layout>
</html>