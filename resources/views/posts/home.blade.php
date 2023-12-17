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
        
          @if($photo->likes()->where('user_id', Auth::user()->id)->count() > 0)
            <a href="{{ route('unlike', $photo) }}" class="btn btn-success btn-sm">
              いいねを消す
              <span class="badge">{{ $photo->likes->count() }}</span>
            </a>
          @else
          <a href="{{ route('like', $photo) }}" class="btn btn-secondary btn-sm">
            いいねをつける
            <span class="badge">{{ $photo->likes->count() }}</span>
          </a>
          @endif
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