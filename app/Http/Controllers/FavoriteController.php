<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //
    //////////////////user/////////////////////

    /**
     * お気に入り画面表示
     * 
     * @return view
     */
    public function favorite() {

        $user_id = auth() -> user() ->id;
        $favorites = Favorite::where('user_id', $user_id) -> orderBy('id', 'desc') -> get();

        return view('user.favorite', compact('favorites'));
    }

    /**
     * お気に入り登録処理
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function addFavorite(Request $request) {

        $user_id = auth() -> user() -> id;
        $post_id = $request -> input('post_id');

        if(!Favorite::isFavorite($user_id, $post_id)) {
            Favorite::addFavorite($user_id, $post_id);
        }

        return redirect('home');
    }

    /**
     * お気に入り解除処理
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function cancelFavorite(Request $request) {

        if($request -> input('post_id')) {

            //home.blade.phpからの解除
            $user_id = auth() -> user() -> id;
            $post_id = $request -> input('post_id');

            Favorite::cancelFavoriteFromHome($user_id, $post_id);
    
            return redirect('home');
        } else {

            //favorite.blade.phpからの解除
            $id = $request -> input('favorite_id');

            Favorite::cancelFavoriteFromFavorite($id);

            return redirect('favorite');
        }
    }
}
