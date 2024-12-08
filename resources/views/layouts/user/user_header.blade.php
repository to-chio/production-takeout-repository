<body>
    <div class="header_wrap">
        <h1 class="title">TAKEOUT</h1>
        <a href="{{ route('myPage') }}" class="login_name">{{ Auth::user() -> name }}</a>
        <div class="icon_box">
            <div class="post_box menu"><a href="{{ route('post') }}" class="post">投稿</a></div>
            <div class="post_box menu"><a href="{{ route('changePass') }}" class="change">パスワード変更</a></div>
            <form action="{{ route('logout') }}" method="post" class="logout_form login_box menu">
                @csrf
                <button class="login_btn logout_btn" onclick="return confirm('ログアウトしますか？')">ログアウト</button>
            </form>
        </div>
        <div class="open_btn"><span></span><span></span><span></span></div>
    </div>
    <div class="burger_bg">
        <div class="burger_menu">
            <div class="burger_content"></div>
        </div>
    </div>

