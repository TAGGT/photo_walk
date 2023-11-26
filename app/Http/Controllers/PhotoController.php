<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;
use App\Http\Requests\PhotoRequest;
use Cloudinary;

class PhotoController extends Controller
{
    public function create(Tag $tag)
	{
		return view('posts.create')->with(['tags' => $tag->get()]);
	}

    public function home()
	{
		return view('posts.create')->with(['photos' => $tag->get()]);
	}

    public function store(PhotoRequest $request, Photo $photo)
    {
        $input = $request['post'];
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        dd(Auth::user());
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $user_id = Auth::user()->id;
        $input += ['photo_pas' => $image_url];
        $input += [ 'user_id' => $user_id];
        $photo->timestamps = false;
		$photo->fill($input)->save();
		return redirect('/posts/create');
	}

	public function delete(Photo $photo)
	{
		$post->delete();
		return redirect('/');	
	}    
    //
}
