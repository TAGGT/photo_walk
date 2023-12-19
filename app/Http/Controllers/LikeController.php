<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Like;
use App\Models\Tag;
use App\Models\User;


class LikeController extends Controller
{

    //いいねを付ける
    public function like(Photo $photo){
        $like = New Like();
        $like->photo_id = $photo->id;
        $like->user_id = Auth::user()->id;
        $like->save();
        
        return back();
    }

    //いいねを消す
    public function unlike(Photo $photo){
        $user = Auth::user()->id;
        $like = Like::where('photo_id', $photo->id)->where('user_id', $user)->first();
        $like->delete();
        return back();
    }

    // いいねを表示するページ
    public function index(Photo $photo)
    {
        
        $photos = Photo::get();
        $user = Auth::user();
        $like = Like::where('user_id', $user->id)->first();

        return view('likes.index')->with(['photos' => $photos, 'user' => $user, 'like' => $like]);
    }

    // いいねを表示するページ
    public function likes_only()
    {
        $user = Auth::user();
        $likes = $user->likes->pluck('photo_id');;

        // データベースから写真を取得する（photosテーブルを仮定）
        $photos = Photo::whereIn('id', $likes)->get();

        return view('likes.likes')->with(['photos' => $photos]);
    }

    
}
