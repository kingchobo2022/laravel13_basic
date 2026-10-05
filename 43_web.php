use App\Http\Controllers\Auth\LoginController;

// 1. 게스트 전용 (로그인 화면 & 로그인 처리)
Route::middleware('guest')->group(function () {
    // 42강 회원가입 라우트들...
    
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

// 2. 인증된 사용자 전용 (로그아웃 처리)
// 로그아웃은 GET이 아닌 POST로 처리해야 CSRF 및 악의적 링크 클릭 공격을 방지합니다.
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
