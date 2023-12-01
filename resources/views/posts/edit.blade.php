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
    <!-- ブログの投稿用フォーム -->
    <!-- actionの値の見直し可能性あり -->
    <form action="/posts/{{$photo->id}}" id="post-photo" method="post">
      @csrf
      @method('PUT')
      <p>カスタムタグ<br>
      <textarea name="post[custom_tag]" cols="20" rows="2">{{ $photo->custom_tag }}</textarea></p>
      <p class="custom_tag__error" style="color:red">{{ $errors->first('post.custom_tag') }}</p>

      <div class='my-photo'>
		    <div>
          <img src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
        </div>
	    </div>

      <p>緯度<br>
      <input type="text" name="post[latitude]" value="{{ $photo->latitude }}"></p>
      <p class="latitude__error" style="color:red">{{ $errors->first('post.latitude') }}</p>
      <p>経度<br>
      <input type="text" name="post[longitude]" value="{{ $photo->longitude }}"></p>
      <p class="longitude__error" style="color:red">{{ $errors->first('post.longitude') }}</p>
 

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

  <footer>
    <p>フッター</p>
  </footer>
  
</body>
</x-app-layout>

</html>