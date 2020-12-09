<?php

namespace App\Providers;

use App\Models\Comment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Payment' => 'App\Policies\CheckUserAuthorize',
        'App\Models\User' => 'App\Policies\UserAuthorize',
        'App\Models\Admin' => 'App\Policies\AdminAuthorize',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isAdmin', function ($admin) {
            return $admin->isAdmin;
        });

        // comment authorization
        Gate::define('isAction', function ($user, $id) {
            $comment = Comment::find($id);
            //dd($user);
            return $comment->commented_id == $user->id && 'App\Models\User' == $comment->commented_type;
        });
    }
}
