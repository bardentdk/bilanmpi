<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use App\Models\BilanMPI;
use App\Policies\BilanMPIPolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::policy(BilanMPI::class, BilanMPIPolicy::class);
        Vite::prefetch(concurrency: 3);
    }
}
