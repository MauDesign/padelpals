<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Challenge;
use App\Models\Permission; // Assuming Permission model exists

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
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate for creating challenges
        Gate::define('create-challenge', function (User $user) {
            // Check if user has 'admin' role OR 'create-challenge' permission
            if ($user->roles()->where('name', 'admin')->exists()) {
                return true;
            }
            $createChallengePermission = Permission::where('name', 'create-challenge')->first();
            return $createChallengePermission && $user->hasPermission($createChallengePermission);
        });

        // Gate for viewing a challenge
        Gate::define('view-challenge', function (User $user, Challenge $challenge) {
            if ($challenge->is_public) {
                return true;
            }
            // If private, user must be challenge creator OR have 'admin' role
            return $user->id === $challenge->user_id || $user->roles()->where('name', 'admin')->exists();
        });

        // Gate for updating a challenge
        Gate::define('update-challenge', function (User $user, Challenge $challenge) {
            // User is challenge creator OR has 'admin' role
            return $user->id === $challenge->user_id || $user->roles()->where('name', 'admin')->exists();
        });

        // Gate for deleting a challenge
        Gate::define('delete-challenge', function (User $user, Challenge $challenge) {
            // User is challenge creator OR has 'admin' role
            return $user->id === $challenge->user_id || $user->roles()->where('name', 'admin')->exists();
        });

        // Gate for managing challenge players
        Gate::define('manage-challenge-players', function (User $user, Challenge $challenge) {
            // User is challenge creator OR has 'admin' role
            return $user->id === $challenge->user_id || $user->roles()->where('name', 'admin')->exists();
        });

        // Gate for creating a match for a challenge
        Gate::define('create-challenge-match', function (User $user, Challenge $challenge) {
            // User is challenge creator OR has 'admin' role
            return $user->id === $challenge->user_id || $user->roles()->where('name', 'admin')->exists();
        });
    }
}
