<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // For production, only run essential seeders
        if (app()->environment('production')) {
            $this->call(ProductionSeeder::class);
        } else {
            // Development seeders
            // Create roles
            Role::create(['name' => 'admin', 'guard_name' => 'web']);
            Role::create(['name' => 'employee', 'guard_name' => 'web']);
            Role::create(['name' => 'learner', 'guard_name' => 'web']);

            // User::factory(10)->create();

            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
            
            // Assign admin role
            $user->assignRole('admin');
        }
    }
}
