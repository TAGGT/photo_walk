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
    <form action="/posts" id="post-photo" method="post">
      @csrf
      <p>基本タグ<br>
      <input type="text" name="post[tag_id]"></p>
      <!-- <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p> -->
      <p>カスタムタグ<br>
      <textarea name="post[custom_tag]" cols="1" rows="20"></textarea></p>
      <!-- <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p> -->
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