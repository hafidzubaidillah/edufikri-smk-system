<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

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
          Paginator::useBootstrap();

          if($this->app->environment('production')) {
            URL::forceScheme('https');
            
            // Override storage paths for Vercel (ephemeral filesystem)
            // Vercel only allows writes to /tmp directory
            $this->app->useStoragePath('/tmp/storage');
          }
    }
}
