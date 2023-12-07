<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $role_super_admin = Role::create(['name' => 'Super Admin', 'description' => 'Le super admin tout puissant']);

        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'email_verified_at' => Carbon::now(),
            'password' => 'Azerty123',
            'created_at' => Carbon::now()
        ]);

        $super_admin->assignRole($role_super_admin);

    }
}
