<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * 1. 로그인 폼 화면 출력
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * 2. 로그인 처리 (인증 시도 및 세션 생성)
     */
    public function store(Request $request)
    {
        // 1) 기본 형식 검증
        $credentials = $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => '이메일을 입력해 주세요.',
            'email.email'       => '올바른 이메일 형식을 입력해 주세요.',
            'password.required' => '비밀번호를 입력해 주세요.',
        ]);

        // 2) '로그인 상태 유지' 체크박스 확인 (boolean)
        $remember = $request->boolean('remember');

        // 3) Auth::attempt()로 인증 시도
        // 평문 비밀번호를 DB의 해시 암호와 자동으로 대조 검증합니다.
        if (! Auth::attempt($credentials, $remember)) {
            // 실패 시 이메일 입력창에 에러 메시지를 띄우며 되돌아감
            throw ValidationException::withMessages([
                'email' => '입력하신 이메일 또는 비밀번호가 일치하지 않습니다.',
            ]);
        }

        // 4) [보안 필수] 세션 고정 공격 방지를 위한 세션 ID 재생성
        $request->session()->regenerate();

        // 5) 로그인 전 원래 가려던 페이지가 있다면 그곳으로, 없으면 게시판 목록으로 이동
        return redirect()->intended(route('posts.index'))
            ->with('success', '성공적으로 로그인되었습니다.');
    }

    /**
     * 3. 로그아웃 처리
     */
    public function destroy(Request $request)
    {
        // 1) Auth 가드에서 로그아웃
        Auth::logout();

        // 2) 현재 세션 완전 파기
        $request->session()->invalidate();

        // 3) CSRF 토큰 재생성 (새 폼 요청을 대비)
        $request->session()->regenerateToken();

        return redirect()
            ->route('posts.index')
            ->with('success', '안전하게 로그아웃되었습니다.');
    }
}
