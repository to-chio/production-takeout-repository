<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // use HasFactory;

    public function user() {

        return $this -> belongsTo('App\Models\User');
    }

    public function shop() {

        return $this -> belongsTo('App\Models\Shop');
    }

    public function favorites() {

        return $this -> hasMany('App\Models\Favorite');
    }


    protected $fillable = [
        'user_id',
        'shop_id',
        'img_url',
        'comment'
    ];

    public $timestamps = false;

    /**
     * 投稿を登録
     * 
     * @param $user_id
     * @param $shop_id
     * @param $request
     */
    public static function storePost($user_id, $shop_id, $request) {

        $post = self::create([
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'comment' => $request -> input('comment'),
        ]);

        return $post -> id;
    }

    /**
     * 画像の保存
     * 
     * @param $request
     */
    public function storeImage($request) {

        if($request -> hasFile('img')) {
            $original = request() -> file('img') -> getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            $file = request() ->file('img') -> move('storage/images', $name);
            $this -> img_url = $name;
            $this -> save();
        }
    }

    /**
     * 既存の画像があれば削除
     * 
     * @param $request
     */
    public function checkImage($request) {

        if($request -> hasFile('img')) {
            if($this -> img_url) {
                \Storage::disk('public') -> delete('images/' . $this -> img_url);
            }    
        }
    }

    /**
     * 投稿内容の更新
     * 
     * @param $request
     */
    public function updatePost($request) {

        $this -> comment = $request -> input('comment');
        $this -> save();
    }

    /**
     * 取得したidの投稿を削除
     * 
     * @param $id
     */
    public function postDelete($id) {

        return self::where('id', $id) -> delete();
    }
}
