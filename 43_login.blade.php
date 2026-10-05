<x-layout title="로그인">
    <div style="max-width: 420px; margin: 40px auto;">
        <h1 style="text-align: center; margin-bottom: 25px;">로그인</h1>

        <div class="card">
            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <!-- 이메일 입력란 -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">이메일</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="user@example.com"
                           style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid {{ $errors->has('email') ? '#ef4444' : '#cbd5e1' }}; border-radius: 6px;">
                    @error('email')
                        <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 비밀번호 입력란 -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">비밀번호</label>
                    <input type="password" 
                           name="password" 
                           placeholder="••••••••"
                           style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid {{ $errors->has('password') ? '#ef4444' : '#cbd5e1' }}; border-radius: 6px;">
                    @error('password')
                        <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 로그인 상태 유지 체크박스 -->
                <div style="margin-bottom: 20px;">
                    <label style="display: inline-flex; align-items: center; font-size: 14px; cursor: pointer; color: #475569;">
                        <input type="checkbox" name="remember" style="margin-right: 8px;">
                        로그인 상태 유지
                    </label>
                </div>

                <button type="submit" class="btn" style="width: 100%; padding: 12px; font-size: 16px;">
                    로그인
                </button>
            </form>

            <div style="text-align: center; margin-top: 15px; font-size: 13px; color: #64748b;">
                계정이 없으신가요? <a href="{{ route('register') }}" style="color: #2563eb; text-decoration: none;">회원가입</a>
            </div>
        </div>
    </div>
</x-layout>
