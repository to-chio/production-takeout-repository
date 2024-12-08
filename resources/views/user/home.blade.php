@extends('layouts.user.user_origin')

@section('contents')
<div class="view_wrap">
    <div class="main_wrap">
        @foreach($posts as $post)
        <div class="posts_wrap">
            <p class="user_name">{{ $post -> user -> name }}</p>
            <div class="post_head">
                <p class="shop_name">{{ $post -> shop -> shop_name }}</p>
                @if($favorites -> contains('post_id', $post -> id))
                <form action="{{ route('cancelFavorite') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post -> id }}">
                    <button type="submit" class="cancel_fab">お気に入り解除</button>
                </form>
                @else
                <form action="{{ route('addFavorite') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post -> id }}">
                    <button type="submit" class="button_fab">お気に入り</button>
                </form>
                @endif
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