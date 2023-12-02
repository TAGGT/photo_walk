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
	@foreach($posts as $post)
  <div class="container-fulid mt-20" style="margin-left:-10px;">
    <div >
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">
            <div class="media flex-wrap w-100 align-items-center">
              <div class="media-body ml-3">{{$post->title}}</div>
            </div>
          </div>
          <div class="card-body">
            <p>{{$post->body}}</p>
          </div>
          <a href="{{ route('nice', $post) }}" class="btn btn-secondary btn-sm">
            いいねをつける
            <span class="badge">{{ $post->nices->count() }}</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  </main>
  
</body>
</x-app-layout>
</html>