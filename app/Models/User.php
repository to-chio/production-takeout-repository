<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    // use HasFactory;

    public function posts() {
        
        return $this -> hasMany('App\Models\Post');
    }

    public function favorites() {

        return $this -> hasMany('App\Models\Favorite');
    }

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public $timestamps = false;

    /**
     * ログイン認証
     * 
     * @param $credentials
     * @return bool|string
     */
    public function loginProcess(array $credentials) {

        //
        if(!Auth::attempt($credentials)) {
            return 'メールアドレスかパスワードが間違っています。';
        }

        return true; //認証成功
    }

    /**
     * パスワードの変更
     * 
     * @param string $current_password
     * @param string $new_password
     * @return bool|string
     */
    public function updatePass(string $current_password, string $new_password) {

        //現在のパスワードと照合
        if(!Hash::check($current_password, $this -> password)) {
            return '現在のパスワードが間違っています';
        }

        //現在のパスワードと新しいパスワードが同じでないか確認
        if(Hash::check($new_password, $this -> password)) {
            return '新しいパスワードが現在のパスワードと同じです';
        }

        //パスワードを変更して保存
        $this -> password = Hash::make($new_password);
        $this -> save();

        return true;
    }

}
