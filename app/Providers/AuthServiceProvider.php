<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Comment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Payment' => 'App\Policies\CheckUserAuthorize',
		'App\User' => 'App\Policies\UserAuthorize',
		'App\Admin' => 'App\Policies\AdminAuthorize',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
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
       	return $comment->commented_id == $user->id;
       });
    }
}