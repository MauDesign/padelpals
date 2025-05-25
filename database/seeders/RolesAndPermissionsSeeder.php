<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $playerRole = Role::create(['name' => 'player']);
        $guestRole = Role::create(['name' => 'guest']);

        // Create Permissions
        $createChallengePermission = Permission::create(['name' => 'create-challenge']);
        $joinChallengePermission = Permission::create(['name' => 'join-challenge']);
        $manageUsersPermission = Permission::create(['name' => 'manage-users']);
        $viewPublicChallengesPermission = Permission::create(['name' => 'view-public-challenges']);
        $manageOwnProfilePermission = Permission::create(['name' => 'manage-own-profile']);

        // Assign Permissions to Roles
        // Admin gets all permissions
        $adminRole->permissions()->attach([
            $createChallengePermission->id,
            $joinChallengePermission->id,
            $manageUsersPermission->id,
            $viewPublicChallengesPermission->id,
            $manageOwnProfilePermission->id,
        ]);

        // Player permissions
        $playerRole->permissions()->attach([
            $joinChallengePermission->id,
            $viewPublicChallengesPermission->id,
            $manageOwnProfilePermission->id,
        ]);

        // Guest permissions
        $guestRole->permissions()->attach([
            $viewPublicChallengesPermission->id,
        ]);
    }
}
