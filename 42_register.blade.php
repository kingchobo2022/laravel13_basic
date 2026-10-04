<x-layout title="회원가입">
    <div style="max-width: 450px; margin: 40px auto;">
        <h1 style="text-align: center; margin-bottom: 25px;">회원가입</h1>

        <div class="card">
            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <!-- 이름 입력란 -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">이름</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="홍길동"
                           style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#cbd5e1' }}; border-radius: 6px;">
                    @error('name')
                        <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 이메일 입력란 -->
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">이메일 주소</label>
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
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">비밀번호 (8자 이상)</label>
                    <input type="password" 
                           name="password" 
                           placeholder="••••••••"
                           style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid {{ $errors->has('password') ? '#ef4444' : '#cbd5e1' }}; border-radius: 6px;">
                    @error('password')
                        <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 비밀번호 확인 입력란 (name="password_confirmation" 규칙 필수) -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">비밀번호 확인</label>
                    <input type="password" 
                           name="password_confirmation" 
                           placeholder="••••••••"
                           style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>

                <button type="submit" class="btn" style="width: 100%; padding: 12px; font-size: 16px;">
                    회원가입 완료
                </button>
            </form>
        </div>
    </div>
</x-layout>

        

