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
	@foreach($photos as $photo)
  <div class="container-fulid mt-20" style="margin-left:-10px;">
    <div >
      <div class="col-md-12">
        <div class="card mb-4">
          <div>
            <a href='/posts/{{ $photo->id }}'>
              <img src="{{ $photo->photo_pas }}" alt="画像が読み込めません。"/>
            </a>
          </div>
          
          @if($photo->likes()->where('user_id', Auth::user()->id)->count() == 1)
            <a href="{{ route('unlike', $photo) }}" class="btn btn-success btn-sm">
              いいねを消す
              <span class="badge">{{ $photo->likes->count() }}</span>
            </a>
          @else
          <a href="{{ route('nice', $photo) }}" class="btn btn-secondary btn-sm">
            いいねをつける
            <span class="badge">{{ $photo->nices->count() }}</span>
          </a>
          @endif

        </div>
      </div>
    </div>
  </div>
  @endforeach

  </main>

</body>
</x-app-layout>
</html>