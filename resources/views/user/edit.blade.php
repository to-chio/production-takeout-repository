@extends('layouts.user.user_origin')

@section('contents')
<div class="view_wrap">
    <div class="main_wrap">
        <form action="{{ route('update') }}" class="post_form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $post -> id }}">
            @csrf
            <h2>投稿する</h2>
            <div class="post_wrap">
                <dl>
                    <dt><label for="shop">店名<span>*</span></label></dt>
                    <dd><input type="text" name="shop" required="required" value="{{ $post -> shop -> shop_name }}"></dd>
                    <dt><label for="img">写真</label></dt>
                    <dd><input type="file" name="img"></dd>
                    <dt><label for="comment">コメント<span>*</span></label></dt>
                    <dd><textarea name="comment" required="required">{{ $post -> comment }}</textarea></dd>
                </dl>
                <input type="submit" value="投稿する" class="submit" onclick="return confirm('投稿しますか？')">
            </div>
        </form>
    </div>

@endsection