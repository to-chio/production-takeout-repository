@extends('layouts.no_user.origin')

@section('contents')
<div class="view_wrap">
    <div class="main_wrap">
        @foreach($posts as $post)
        <div class="posts_wrap">
            <p class="user_name">{{ $post -> user -> name }}</p>
            <p class="shop_name">{{ $post -> shop -> shop_name }}</p>
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