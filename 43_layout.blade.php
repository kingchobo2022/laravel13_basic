<header style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 15px 30px;">
    <div style="max-width: 900px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('posts.index') }}" style="font-weight: bold; font-size: 18px; text-decoration: none; color: #0f172a;">
            내 첫 번째 라라벨 게시판
        </a>

        <nav style="display: flex; align-items: center; gap: 15px;">
            <a href="{{ route('posts.index') }}" style="text-decoration: none; color: #475569;">게시판</a>

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
                <a href="{{ route('login') }}" style="text-decoration: none; color: #2563eb; font-size: 14px;">로그인</a>
                <a href="{{ route('register') }}" class="btn" style="padding: 6px 12px; font-size: 13px;">회원가입</a>
            @endguest
        </nav>
    </div>
</header>
