<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    protected $namespace = 'App\Http\Controllers';
    public function boot()
    {
        $this->configureRateLimiting();
        $this->mapRoute();
        $this->mapApi();
        $this->map();
    }
    protected function mapApi()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
    protected function mapRoute()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
    public function map()
    {
        $this->mapAdminProductRoutes();
    }
    protected function mapAdminProductRoutes()
    {
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/product.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/rating.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/category.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/menu.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/permission.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/role.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/slider.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/setting.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/user.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin/order.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/user/cart/productCart.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/user/cart/checkout.php'));
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/user/user.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
