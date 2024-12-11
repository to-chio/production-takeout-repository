<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // use HasFactory;

    public function user() {

        return $this -> belongsTo('App\Models\User');
    }

    public function post() {

        return $this -> belongsTo('App\Models\Post');
    }

    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public $timestamps = false;

    /**
     * すでにお気に入りされているか確認
     * 
     * @param $user_id
     * @param $post_id
     */
    public static function isFavorite($user_id, $post_id) {

        return self::where('user_id', $user_id) -> where('post_id', $post_id) -> exists();
    }

    /**
     * お気に入り登録
     * 
     * @param $user_id
     * @param $post_id
     */
    public static function addFavorite($user_id, $post_id) {

        return self::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
        ]);
    }

    /**
     * homeからのお気に入り解除処理
     * 
     * @param $user_id
     * @param $post_id
     */
    public static function cancelFavoriteFromHome($user_id, $post_id) {

        return self::where('user_id', $user_id) -> where('post_id', $post_id) -> delete();
    }

    /**
     * favoriteからのお気に入り解除
     * 
     * @param $id
     */
    public static function cancelFavoriteFromFavorite($id) {

        return self::where('id', $id) -> delete();
    }

    /**
     * 取得したidと一致するpost_idの投稿を削除
     * 
     * @param $id
     */
    public function postDelete($id) {

        return self::where('post_id', $id) -> delete();
    }
}
