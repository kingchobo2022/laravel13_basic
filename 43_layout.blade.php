<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '나의 라라벨 사이트' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <header>
        <h2>My Laravel App (Component Base)</h2>
        <nav>
            <a href="/">홈</a>
            <a href="/posts">게시판</a>
            <a href="/about">소개</a>

<!-- [로그인 상태일 때] -->
            @auth
                <span style="font-size: 14px; color: #334155;">
                    <strong>{{ auth()->user()->name }}</strong>님
                </span>
                
                <!-- 로그아웃은 반드시 POST 전송 -->
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: 1px solid #cbd5e1; padding: 6px 12px; border-radius: 4px; cursor: pointer; color: #64748b; font-size: 13px;">
                        로그아웃
                    </button>
                </form>
            @endauth

            <!-- [비로그인(게스트) 상태일 때] -->
            @guest
                <a href="{{ route('login') }}" class="btn" style="text-decoration: none; color: #fff; font-size: 14px;">로그인</a>
                <a href="{{ route('register') }}" class="btn" style="padding: 6px 12px; font-size: 13px;">회원가입</a>
            @endguest            
            
        </nav>
    </header>
    
    <main>
        {{ $slot }}
    </main>
</body>
</html>
