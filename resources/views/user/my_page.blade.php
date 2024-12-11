@extends('layouts.user.user_origin')

@section('contents')
<div class="view_wrap">
    <div class="main_wrap">
        <h2 class="fav_title">自分の投稿</h2>
        @foreach($posts as $post)
        <div class="posts_wrap">
            <p class="user_name">{{ $post -> user -> name }}</p>
            <div class="post_head">
                <p class="shop_name">{{ $post -> shop -> shop_name }}</p>
                <div class="operation">
                    <form action="{{ route('edit') }}" method="post">
                        @csrf
                        <input type="hidden" name="edit" value="{{ $post -> id }}">
                        <button type="submit">編集</button>
                    </form>
                    <form action="{{ route('postDelete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $post -> id }}">
                        <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
                    </form>
                </div>
            </div>
            <div class="contents_wrap">
                <div class="matter_wrap">
                    <p class="matter">{{ $post -> comment }}</p>
                </div>
                @if($post -> img_url)
                <div class="img_box"><img src="{{ asset('storage/images/' . $post -> img_url) }}" alt=""></div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

@endsection