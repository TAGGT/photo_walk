<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;
use App\Models\Custom_tag_photo;
use App\Models\Custom_tag;
use App\Http\Requests\PhotoRequest;
use Cloudinary;

class PhotoController extends Controller
{
    public function create(Tag $tag)
	{
		$map_api = config('app.map_api');
		
		return view('posts.create')->with(['tags' => $tag->get(), 'map_api' => $map_api]);
	}

	public function shoot(Tag $tag)
	{
		$map_api = config('app.map_api');
		
		return view('posts.shoot')->with(['tags' => $tag->get(), 'map_api' => $map_api]);
	}

    public function home()
	{
		return view('posts.home')->with(['photos' => Auth::user()->photos()->get()]);
	}

  

	/* 
	役割：特定の写真を見る機能を持ち、その画面で削除・編集を行えるボタンが有る
	第一引数：viewにおいて、URLで指定されたidを持つphotos_tableのカラムの一つが入っている
	*/
	public function show(Photo $photo, Tag $tag)
	{
		$map_api = config('app.map_api');

		return view('posts.show')->with(['photo' => $photo, 'map_api' => $map_api, 'tags' => $tag->get()]);
	}

	/*
	役割：投稿編集画面の表示
	第一引数：編集対象のカラム
	返戻値：編集画面
	*/
	public function edit(Photo $photo, Tag $tag)
	{
		$map_api = config('app.map_api');

		return view('posts.edit')->with(['photo' => $photo, 'tags' => $tag->get(), 'map_api' => $map_api]);
	}
	
	public function search(Tag $tag)
	{
		$map_api = config('app.map_api');
		return view('posts.search')->with(['tags' => $tag->get(), 'map_api' => $map_api]);
	}
	
	

	/*
	役割：投稿された写真の検索
	第一引数：編集後の情報が格納されたリクエスト
	第二引数：編集対象のカラム
	返戻値：検索結果の画面
	*/
	public function research(PhotoRequest $request, Photo $photo, Tag $tag, Custom_tag $custom_tag)
	{


		$map_api = config('app.map_api');
		//渡されたカスタムタグ文字列を分解している
    $custom_tags=$request->input('custom_tags');
    $explodedTags = explode('#', $custom_tags);
    $filteredTags = array_filter($explodedTags);
    $uniqueTags = array_unique($filteredTags);

	//custom_tag_ids = $custom_tag->whereIn()

		//リクエストの分解
		$tag_id=$request->input('tag_id');

		$latitude=$request->input('latitude');
		$longitude=$request->input('longitude');
		$distance=$request->input('distance');

		//距離あたりの緯度経度を計算
		$lat_lng=calcLatitudeLongitude($latitude, $longitude, $distance);

		//緯度の下限・上限
		$latitudeLeast=$latitude-$lat_lng['latitude'];
		$latitudeMost=$latitude+$lat_lng['latitude'];
		//経度の下限・上限
		$longitudeLeast=$longitude-$lat_lng['longitude'];
		$longitudeMost=$longitude+$lat_lng['longitude'];
		

		//検索条件の設定
		dd($tag_id);
		$photos = Photo::where('tag_id', $tag_id);
		/*
		$photos = Photo::where('tag_id', $tag_id)
    ->orWhereHas('custom_tags', function ($query) use ($uniqueTags) {
        $query->whereIn('name', $uniqueTags);
    })->get();
		*/

		return view('posts.research')->with(['photos' => $photos, 'tags' => $tag->get(), 'map_api' => $map_api]);
	}

	/*
	役割：入力された距離あたりの緯度経度を計算する
	第一引数：緯度
	第二引数：経度
	第三引数：距離（キロ換算）
	返戻値：緯度経度の連想配列
	*/
	public function calcLatitudeLongitude($latitude, $longitude, $distance)
	{
		$equ_radius = 6378.137;

		$deg_lat = 360 * $distance / $equ_radius;
		$deg_lng = 360 * $distance / ($equ_radius * cos($latitude * pi() / 180));
		
		$lat_lng = ['latitude' => $deg_lat, 'longitude' => $longitude];

		return $lat_lng;	
	}

	/*
	役割：投稿された写真の削除
	第一引数：削除対象のカラム
	 */
	public function delete(Photo $photo)
	{
    $photo->delete();
    return redirect('/posts/home');
	}

	/*
	役割：写真の投稿
	第一引数：投稿情報の格納されたrequestそのもの
	第二引数：編集対象のカラム
	 */
	public function store(PhotoRequest $request, Photo $photo)
  {
    $input = $request['post'];
    
    //渡されたカスタムタグ文字列を分解している
    $custom_tags=$request->input('custom_tags');
    $explodedTags = explode('#', $custom_tags);
    $filteredTags = array_filter($explodedTags);
    $uniqueTags = array_unique($filteredTags);

		//cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
    $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
    $user_id = Auth::user()->id;
    $input += ['photo_pas' => $image_url];
    $input += [ 'user_id' => $user_id];
	  $photo->fill($input)->save();

		foreach ($uniqueTags as $tagName) {
			$tag = Custom_tag::firstOrCreate(['name' => $tagName]);
			// 写真とカスタムタグを中間テーブルに紐付ける
			
			
			DB::table('custom_tag_photos')->insert([
            'photo_id' => $photo->id,
            'custom_tag_id' => $tag->id,
        	]);
		}
    
    
		return redirect('/posts/create');
	}

	/*
	役割：投稿された写真の編集
	第一引数：編集後の情報が格納されたリクエスト
	第二引数：編集対象のカラム
	*/
	public function update(PhotoRequest $request, Photo $photo)
	{
		$input = $request['post'];
		$photo->fill($input)->save();
		return redirect('/posts/' . $photo->id);
	}

}
