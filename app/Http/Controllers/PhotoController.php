<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;//後でバリデーション自分で作る
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;
use Cloudinary;

class PhotoController extends Controller
{
    public function create(Tag $tag)
	{
		return view('posts.create')->with(['tags' => $tag->get()]);
	}

    public function store(Request $request, Photo $photo)
    {
        $input = $request['post'];
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $user_id = Auth::user()->id;
        $input += ['photo_pas' => $image_url];
        $input += [ 'user_id' => $user_id];
        $photo->timestamps = false;
		$photo->fill($input)->save();
		return redirect('/posts/create');
	}

	public function delete(Post $post)
	{
		$post->delete();
		return redirect('/');	
	}    
    //
}
