<?php

namespace App\Providers;

use App\Models\Passenger;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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


        // Gate::define('create-notice', [NoticePolicy::class, 'create']);

        Gate::define('Admin', function (User $user) {

            if ($user->role_id == 1) {
                return true;
            }

            return false;
        });

        Gate::define('Driver', function (User $user) {

            if ($user->role_id == 2) {
                return true;
            }
            return false;
        });

        Gate::define('passenger', function (User $user) {

            if ($user->role_id == 3) {
                return true;
            }

            return false;
        });


        Gate::define('Guest', function (User $user) {

            if ($user->role_id == 4) {
                return true;
            }

            return false;
        });



        Gate::define('create-passenger', function (User $user) {
            if ($user->role_id == 3 && Auth::user()->id == $user->id) {
                return true;
            }
            return false;
        });

        Gate::define('create-driver', function (User $user) {
            if ($user->role_id == 1 && Auth::user()->id == $user->id) {
                return true;
            }
            return false;
        });
    }
}
