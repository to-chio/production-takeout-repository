@extends('layouts.user.user_origin')

@section('contents')
<div class="view_wrap">
    <div class="main_wrap">
        <h2 class="fav_title">Favorite</h2>
        @foreach($favorites as $favorite)
        <div class="posts_wrap">
            <p class="user_name">{{ $favorite -> post -> user -> name }}</p>
            <div class="post_head">
                <p class="shop_name">{{ $favorite -> post -> shop -> shop_name }}</p>
                <form action="{{ route('cancelFavorite') }}" method="post">
                    @csrf
                    <input type="hidden" name="favorite_id" value="{{ $favorite -> id }}">
                    <button type="submit" class="cancel_fab">お気に入り解除</button>
                </form>
            </div>
            <div class="contents_wrap">
                <div class="matter_wrap">
                    <p class="matter">{{ $favorite -> post -> comment }}</p>
                </div>
                @if($favorite -> post -> img_url)
                <div class="img_box"><img src="{{ asset('storage/images/' . $favorite -> post -> img_url) }}" alt=""></div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

@endsection