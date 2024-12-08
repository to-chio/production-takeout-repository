        <div class="sub_wrap">
            <a href="{{ route('home') }}" class="sub home">home</a>
            <a href="{{ route('favorite') }}" class="sub">favorite</a>
            <a href="{{ route('post') }}" class="sub phone_none">投稿</a>
            <a href="{{ route('myPage') }}" class="sub phone_none">マイページ</a>
            <a href="{{ route('changePass') }}" class="sub phone_none">パスワード変更</a>
            <form action="{{ route('logout') }}" method="post" class="logout_form">
                @csrf
                <button class="sub phone_none" onclick="return confirm('ログアウトしますか？')">ログアウト</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>