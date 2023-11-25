<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;//後でバリデーション自分で作る
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

    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        dd($image_url);  //画像のURLを画面に表示

        $input += ['photo_pas' => $image_url];
        $input += [ 'user_id' => Auth::id()];
		$post->fill($input)->save();
		return redirect('/posts/create');
	}

	public function delete(Post $post)
	{
		$post->delete();
		return redirect('/');	
	}    
    //
}
