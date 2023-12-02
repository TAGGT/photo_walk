<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Like;
use App\Models\Tag;

class LikeController extends Controller
{
    public function like(Photo $photo){
        $like = New Like();
        $like->photo_id = $photo->id;
        $like->user_id = Auth::user()->id;
        $like->save();
        
        return back();
    }

    // いいねを表示するページ
    public function index(Photo $photo)
    {
        $photos = Photo::all();
        $user = Auth::user();
        $like = Like::where('photo_id', $photo->id)->where('user_id', $user)->first();
        return view('likes.index')->with(['photos' => $photos, 'user' => $user, 'like' => $like]);
    }
}
