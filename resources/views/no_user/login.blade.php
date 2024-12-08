@extends('layouts.no_user.origin')

@section('contents')
<div class="view_wrap center">
    <div class="main_wrap">
        <form action="{{ route('loginProcess') }}" method="post" class="login">
            @csrf
            <h2>ログイン</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
            <dl>
                <dt><label for="email">メールアドレス</label></dt>
                <dd><input type="email" name="email" required="required"></dd>
            </dl>
            <dl>
                <dt><label for="password">パスワード</label></dt>
                <dd><input type="password" name="password" required="required"></dd>
            </dl>
            <p><input type="submit" class="submit" value="ログイン"></p>
            <p class="entry_btn"><a href="./entry">新規登録</a></p>
        </form>
    </div>

@endsection