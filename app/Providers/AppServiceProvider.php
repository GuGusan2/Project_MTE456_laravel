<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;   // 👈 เพิ่มบรรทัดนี้

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
        // ✅ บังคับ pagination ใช้ Bootstrap 5
        Paginator::useBootstrapFive();
    }
}
