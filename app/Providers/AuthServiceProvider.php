<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->hasRole('admin');
        });
        Gate::define('isUser', function ($user) {
            return $user->hasRole('user');
        });
        Gate::define('isCompany', function ($user) {
            return $user->hasRole('company');
        });
        Gate::define('isTrainer', function ($user) {
            return $user->hasRole('trainer');
        });
        Gate::define('isUserOrTrainerOrAdmin', function ($user) {
            return $user->hasRole('user') || $user->hasRole('trainer') || $user->hasRole('admin');
        });
        Gate::define('isTrainerOrAdmin', function ($user) {
            return $user->hasRole('trainer') || $user->hasRole('admin');
        });

        Passport::routes();

        //
    }
}
