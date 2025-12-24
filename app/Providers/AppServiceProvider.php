<?php

namespace App\Providers;

use App\Models\Inmate;
use App\Models\Assessment;
use App\Policies\InmatePolicy;
use App\Policies\AssessmentPolicy;
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
        Gate::policy(Inmate::class, InmatePolicy::class);
        Gate::policy(Assessment::class, AssessmentPolicy::class);

    }
}
