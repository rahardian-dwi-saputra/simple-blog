<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\Post;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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
    public function boot(){
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return $user->is_admin ? Response::allow() : Response::deny('You must be an administrator.');
        });

        Gate::define('SuperUser', function($user) { 
            return $user->is_admin && (!$user->can_delete);
        });

        Gate::define('access-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
    }
}
