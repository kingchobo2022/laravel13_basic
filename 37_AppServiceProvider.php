<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('siteVersion',  'v1.0.0');
        Paginator::useTailwind();

        // 로컬 개발 환경 (!app()->isProduction()) 일 때만 지연 로딩을 엄격하게 금지
        // 지연 로딩 (N+1 위험 코드) 발생 시에 즉시 예외(Exception)를 띄워서 개발자에게 경고합니다.
        Model::prventLazyLoading(! app()->isProduction());
    }
}
