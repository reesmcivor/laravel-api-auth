<?php

namespace ReesMcIvor\AuthApi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use ReesMcIvor\AuthApi\Http\Middleware\CheckApiKeys;

class ApiAuthPackageServiceProvider extends ServiceProvider
{

    protected $namespace = 'ReesMcIvor\AuthApi\Http\Controllers';

    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
                __DIR__ . '/../publish/tests' => base_path('tests/ApiAiuth'),
            ], 'reesmcivor-api-auth');
        }

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'api-auth');
    }

    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::middleware(['api', CheckApiKeys::class])
            ->namespace($this->namespace)
            ->group($this->modulePath('routes/tenant.php'));
    }

    private function modulePath($path)
    {
        return __DIR__ . '/../../' . $path;
    }
}
