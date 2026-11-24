<?php

namespace App\Providers;

use App\Models\Castle;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('update-castle', function (User $user, Castle $castle) {
            return $user->is_admin || (int) $user->id === (int) $castle->user_id;
        });

        Gate::define('delete-castle', function (User $user, Castle $castle) {
            return $user->is_admin || (int) $user->id === (int) $castle->user_id;
        });

        Gate::define('restore-castle', function (User $user, Castle $castle) {
            return $user->is_admin;
        });

        Gate::define('force-delete-castle', function (User $user, Castle $castle) {
            return $user->is_admin;
        });
    }
}
