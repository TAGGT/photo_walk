<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <h1 class="underline text-2xl font-bold">投稿した写真</h1>
    </div>
	<div class='my-photo m-1'>
	@foreach($photos as $photo)
  <div class="container-fulid mt-20 p-2 m-1 border-solid border-2 border-gray-500 px-2 rounded w-4/5">
    <div >
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="flex items-center h-96 w-2/3 p-2">
            <a href='/posts/{{ $photo->id }}'>
              <img style="max-height:364px; max-width:820px;" src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
            </a>
          </div>
          
          @if($photo->likes()->where('user_id', Auth::user()->id)->count() > 0)
            <a href="{{ route('unlike', $photo) }}" class="btn btn-success btn-sm border-solid border-2 border-gray-500 px-2 rounded m-1" >
              いいねを消す
              <span class="badge">{{ $photo->likes->count() }}</span>
            </a>
          @else
          <a href="{{ route('like', $photo) }}" class="btn btn-secondary btn-sm border-solid border-2 border-gray-500 px-2 rounded m-1">
            いいねをつける
            <span class="badge">{{ $photo->likes->count() }}</span>
          </a>
          @endif
          
        </div>
      </div>
    </div>
  </div>
  @endforeach
	    <div class='paginate flex justify-center'>
            {{ $photos->links() }}
        </div>
	 </div>


  </main>


  <script>

</body>
</x-app-layout>
</html>