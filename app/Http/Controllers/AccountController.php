<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    /////////////guest//////////////////
    
    /**
     * 新規登録画面の表示
     * 
     * @return view
     */
    public function entry() {

        return view('no_user.entry');
    }

    /**
     * 新規登録処理
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function signUp(Request $request) {

        $validated = $request -> validate([
            'name' => 'required',
            'email' => 'required | max:255',
            'password' => 'required | max:255'
        ]);

        if($validated) {

            $password = $request -> input('password');
            $hashed_password = Hash::make($password);
    
            $user = new User;
            $user -> name = $request -> input('name');
            $user -> email = $request -> input('email');
            $user -> password = $hashed_password;
            $user -> save();
    
            return redirect('login');
        }

        return back()->withErrors([
            'entry_error' => 'メールアドレスとパスワードは最大で255文字までです。',
        ]);
    }

    /**
     * ログイン画面
     * 
     * @return view
     */
    public function login() {

        return view('no_user.login');
    }

    /**
     * ログイン処理
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginProcess(Request $request) {

        $user = new User;

        $credentials = $request -> only('email', 'password');

        // Userモデルの loginProcess メソッドの呼び出し
        $result = $user -> loginProcess($credentials);

        if($result !== true) {
            return back() -> withErrors([
                'login_error' => $result,
            ]);
        }

        //セッション生成
        $request -> session() -> regenerate();

        return redirect('home');
    }

    //////////////////Auth::user/////////////////////
    /**
     * パスワード変更画面
     * 
     * @return view
     */
    public function changePass() {

        return view('user.change_pass');
    }

    /**
     * パスワード変更処理
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePass(Request $request) {

        $validated_date = $request -> validate([
        'current_password' => 'required',
        'new_password' => 'required|string|confirmed',
        ]);

        $user = Auth::user();

        //Userモデル updatePass メソッドの呼び出し
        $result = $user -> updatePass(
            $request -> input('current_password'),
            $request -> input('new_password')
        );

        if($result !== true) {
            return redirect() -> route('change_pass') -> with('flash_message', $result);
        }

        return redirect() -> route('home') -> with('flash_message', 'パスワードを変更しました');
    }

    /**
     * ログアウト処理
     * 
     **@param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
