<?php

// Seeder endpoint untuk Vercel
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Set up environment for Vercel
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';
$_ENV['APP_DEBUG'] = $_ENV['APP_DEBUG'] ?? 'true';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

// Create SQLite database if it doesn't exist
if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
    chmod('/tmp/database.sqlite', 0666);
}

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    echo "<!DOCTYPE html><html><head><title>Database Seeder</title>";
    echo "<style>body { font-family: monospace; padding: 20px; background: #1e1e1e; color: #d4d4d4; }";
    echo "h1 { color: #4ec9b0; } .success { color: #4fc1ff; } .error { color: #f44747; }";
    echo ".info { color: #ffcc02; } a { color: #569cd6; }</style></head><body>";
    
    echo "<h1>🌱 Database Seeder</h1>";
    
    // Run basic seeders
    echo "<div class='info'>Running database seeders...</div><br>";
    
    // Create admin user manually
    $user = \App\Models\User::firstOrCreate([
        'email' => 'admin@smkitihsanulfikri.sch.id'
    ], [
        'name' => 'Administrator',
        'email' => 'admin@smkitihsanulfikri.sch.id',
        'password' => bcrypt('admin123'),
        'email_verified_at' => now(),
        'plain_password' => 'admin123'
    ]);
    
    // Assign admin role
    if (class_exists('Spatie\Permission\Models\Role')) {
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole('admin');
        echo "<div class='success'>✅ Admin role assigned</div><br>";
    }
    
    echo "<div class='success'>✅ Admin user created successfully!</div><br>";
    echo "<div class='info'>📧 Email: admin@smkitihsanulfikri.sch.id</div>";
    echo "<div class='info'>🔑 Password: admin123</div><br>";
    
    // Create some basic data
    echo "<div class='info'>Creating basic school data...</div><br>";
    
    // Create a test class
    $class = \App\Models\SchoolClass::firstOrCreate([
        'name' => 'XII TJKT 1'
    ], [
        'name' => 'XII TJKT 1',
        'description' => 'Kelas XII Teknik Jaringan Komputer dan Telekomunikasi 1'
    ]);
    
    echo "<div class='success'>✅ Test class created: {$class->name}</div><br>";
    
    echo "<h2>🎉 Seeding completed successfully!</h2>";
    echo "<p><a href='/'>← Back to Homepage</a> | <a href='/debug'>Debug Info</a></p>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
    echo "<div class='error'>File: " . $e->getFile() . "</div>";
    echo "<div class='error'>Line: " . $e->getLine() . "</div>";
}

echo "</body></html>";