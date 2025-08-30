<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. İzinleri oluştur
        $permissions = [
            'admin.dashboard',
            'admin.users.view',
            'admin.users.create',
            'admin.users.edit',
            'admin.users.delete',
            'admin.roles.view',
            'admin.roles.create',
            'admin.system.view',
            'admin.system.backup',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);


        $adminRole->givePermissionTo($permissions);


        $admin = User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        $admin->assignRole('admin');


        $testUser = User::firstOrCreate([
            'email' => 'user@example.com'
        ], [
            'name' => 'Test User',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'status' => 'active',
        ]);

        $testUser->assignRole('user');

        echo "✅ Admin: admin@example.com / 123456\n";
        echo "✅ User: user@example.com / 123456\n";
    }
}