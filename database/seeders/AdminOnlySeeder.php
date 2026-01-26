<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminOnlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates only admin user for manual system setup
     */
    public function run(): void
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $learnerRole = Role::firstOrCreate(['name' => 'learner']);

        // Create basic permissions
        $permissions = [
            'manage users',
            'manage classes',
            'manage subjects',
            'manage attendance',
            'send announcements',
            'view reports'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to admin role
        $adminRole->syncPermissions(Permission::all());

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@edufikri.com'],
            [
                'name' => 'Administrator EDUFIKRI',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign admin role
        $admin->assignRole('admin');

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('📧 Email: admin@edufikri.com');
        $this->command->info('🔑 Password: admin123');
        $this->command->info('');
        $this->command->info('🎯 System is now ready for manual data entry:');
        $this->command->info('   - Add your own classes via Admin Dashboard');
        $this->command->info('   - Add your own subjects');
        $this->command->info('   - Add your own teachers');
        $this->command->info('   - Add your own students');
    }
}