@extends('layouts.user.user_origin')

@section('contents')
<div class="view_wrap center">
    <div class="main_wrap">
        <form action="{{ route('updatePass') }}" method="post" class="entry">
            @csrf
            <h2>パスワード変更</h2>
            <dl>
                <dt><label for="name">現在のパスワード</label></dt>
                <dd><input type="password" name="current_password" required="required"></dd>
            </dl>
            <dl>
                <dt><label for="email">新しいパスワード</label></dt>
                <dd><input type="password" name="new_password" required="required"></dd>
            </dl>
            <dl>
                <dt><label for="password">新しいパスワード（確認用）</label></dt>
                <dd><input type="password" name="new_password_confirmation" required="required"></dd>
            </dl>
            <p><input type="submit" class="submit" value="パスワード変更" onclick="return confirm('パスワード変更しますか？')"></p>
        </form>
    </div>

    @endsection