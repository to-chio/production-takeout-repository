<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    /////////////guest//////////////////

    /**
     * guest用topページの表示
     * 
     * @return view
     */
    public function index() {

        $posts = Post::orderBy('update_at', 'desc')->get();
        $shops = Shop::all();

        return view('no_user.index', compact('posts', 'shops'));
    }

    //////////////////user/////////////////////

    /**
     * user用topページの表示
     * 
     * @return view
     */
    public function home() {

        $posts = Post::orderBy('update_at', 'desc') -> get();
        $shops = Shop::all();
        $user = auth() -> user();
        $favorites = Favorite::where('user_id', $user -> id) -> get();

        return view('user.home', compact('posts', 'shops', 'user', 'favorites'));
    }

    /**
     * 投稿画面
     * 
     * @return view
     */
    public function post() {

        return view('user.post');
    }

    /**
     * 投稿処理
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function postStore(Request $request) {

        $shop_id = Shop::storeShop($request -> input('shop'));

        $user_id = auth() -> user() -> id;

        $post_id = Post::storePost($user_id, $shop_id, $request);
        $post = Post::find($post_id);
        $post -> storeImage($request);

        return redirect('home');
    }

    /**
     * マイページ表示
     * 
     * @return view
     */
    public function myPage() {

        $user = auth() -> user();
        $posts = Post::where('user_id', auth() -> user() -> id) -> orderBy('update_at', 'desc') -> get();
        $shops = Shop::all();

        return view('user.my_page', compact('user', 'posts', 'shops'));
    }

    /**
     * 編集画面表示
     * 
     * @param Request $request
     * @return view
     */
    public function edit(Request $request) {

        $post = Post::where('id', $request -> input('edit')) -> first();

        return view('user.edit', compact('post'));
    }

    /**
     * 編集処理
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) {

        $post = Post::find($request -> input('id'));

        $shop = Shop::find($post -> shop_id);
        $shop -> updateShopName($request -> input('shop'));

        $post -> checkImage($request);
        $post -> storeImage($request);
        $post -> updatePost($request);
        
        return redirect('myPage');
    }

    /**
     * 投稿削除処理
     * 
     * @param Request $request
     * @return view
     */
    public function postDelete(Request $request) {

        $id = $request -> input('id');

        Post::postDelete($id);
        Favorite::postDelete($id);

        return view('myPage');
    }
}
