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
	  <div class='my-photo'>
		    <div>
          <img src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
        </div>
	  </div>
    <div class='tags'>
		    <p>{{ $photo->tag->name }}</p>
        <p>{{ $photo->custom_tag }}</p>
	  </div>

	  <a href='/posts/home'>return</a>
	  


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