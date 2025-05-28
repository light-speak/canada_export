<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\RoleServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RoleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 注册 @cache 指令
        Blade::directive('cache', function ($expression) {
            return "<?php if (! Cache::has({$expression})) : ?>";
        });

        Blade::directive('endcache', function ($expression) {
            return "<?php endif; ?>";
        });
    }
}
