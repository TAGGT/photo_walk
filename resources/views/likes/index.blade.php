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
  <div class="m-4">
    <h1 class="underline text-2xl font-bold">投稿写真</h1>
  </div>
  <div class="m-1">
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
  </div>
  
  <div class='paginate flex justify-center'>
            {{ $photos->links() }}
  </div>

  </main>

</body>
</x-app-layout>
</html>