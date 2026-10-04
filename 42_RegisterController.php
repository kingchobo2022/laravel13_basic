<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'=> ['required', 'string', 'confirmed', Password::min(8)],
        ], [
            'name.required' => '이름을 입력해 주세요',
            'email.required' => '이메일을 입력해 주세요',
            'email.email' => '올바른 이메일 형식이 아닙니다.',
            'email.unique' => '이미 사용 중인 이메일 주소입니다.',
            'password.required' => '비밀번호를 입력해 주세요.',
            'password.confirmed' => '비밀번호 확인이 일치하지 않습니다.',
            'password.min' => '비밀번호는 최소 8자 이상이어야 합니다.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email'=> $validated['email'],
            'password' => $validated['password'],
        ]);

        Auth::login($user);

        return redirect()
            ->route('posts.index')
            ->with('success', "{$user->name}님, 회원가입이 완료되었습니다.");
    }
}
