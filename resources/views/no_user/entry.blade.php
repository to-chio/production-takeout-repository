@extends('layouts.no_user.origin')

@section('contents')
<div class="view_wrap center">
    <div class="main_wrap">
        <form action="{{ route('signUp') }}" method="post" class="entry">
            @csrf
            <h2>新規登録</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
            <dl>
                <dt><label for="name">名前</label></dt>
                <dd><input type="text" name="name" required="required"></dd>
            </dl>
            <dl>
                <dt><label for="email">メールアドレス</label></dt>
                <dd><input type="email" name="email" required="required"></dd>
            </dl>
            <dl>
                <dt><label for="password">パスワード</label></dt>
                <dd><input type="password" name="password" required="required"></dd>
            </dl>
            <p><input type="submit" class="submit" value="新規登録" onclick="return confirm('新規登録しますか？')"></p>
        </form>
    </div>

    @endsection