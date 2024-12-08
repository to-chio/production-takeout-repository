<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\TakeoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 
Route::group(['middleware' => ['guest']], function(){
    Route::get('/','PostController@index');
    Route::get('/index', 'PostController@index') -> name('index');

    //新規登録route
    Route::get('/entry', 'AccountController@entry') -> name('entry');
    Route::post('/signUp', 'AccountController@signUp') -> name('signUp');

    //ログインroute
    Route::get('/login', 'AccountController@login') -> name('login');
    Route::post('/loginProcess', 'AccountController@loginProcess') -> name('loginProcess');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'PostController@home') -> name('home');

    //投稿route
    Route::get('/post', 'PostController@post') -> name('post');
    Route::post('/postStore', 'PostController@postStore') -> name('postStore');

    //マイページroute
    Route::get('/myPage', 'PostController@myPage') -> name('myPage');
    Route::post('/edit', 'PostController@edit') -> name('edit');
    Route::post('/update', 'PostController@update') -> name('update');

    //お気に入りroute
    Route::get('/favorite', 'FavoriteController@favorite') -> name('favorite');
    Route::post('/addFavorite', 'FavoriteController@addFavorite') -> name('addFavorite');
    Route::post('/cancelFavorite', 'FavoriteController@cancelFavorite') -> name('cancelFavorite');

    ///パスワード変更route
    Route::get('/changePass', 'AccountController@changePass') -> name('changePass');
    Route::post('/updatePass', 'AccountController@updatePass') -> name('updatePass');

    //ログアウトroute
    Route::post('/logout', 'AccountController@logout') -> name('logout');
});




