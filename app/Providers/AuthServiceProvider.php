<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPermissions;
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
        Idea::class => IdeaPermissions::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate => Permission | Simple role

        // Role
        Gate::define('admin', function (User $user) : bool {
            return (bool) $user->is_admin;
        });

        // Permission: Switch to use by policy
        // Gate::define('idea.edit', function (User $user, Idea $idea) : bool {
        //     return ((bool) $user->is_admin || $user->id === $idea->user_id);
        // });

        // Gate::define('idea.delete', function (User $user, Idea $idea) : bool {
        //     return ((bool) $user->is_admin || $user->id === $idea->user_id);
        // });
    }
}
