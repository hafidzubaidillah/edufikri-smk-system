<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds for production.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting production seeding...');

        // Create roles first
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);
        $learnerRole = Role::firstOrCreate(['name' => 'learner', 'guard_name' => 'web']);

        $this->command->info('✅ Roles created');

        // Create admin user
        $admin = User::firstOrCreate([
            'email' => 'admin@smkitihsanulfikri.sch.id'
        ], [
            'name' => 'Administrator',
            'email' => 'admin@smkitihsanulfikri.sch.id',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'plain_password' => 'admin123'
        ]);

        // Assign admin role
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        $this->command->info('✅ Admin user created: admin@smkitihsanulfikri.sch.id / admin123');
        $this->command->info('🎉 Production seeding completed!');
    }
}