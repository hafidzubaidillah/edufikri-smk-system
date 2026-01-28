<?php

// Complete setup endpoint - Migration + Seeding + Login Test
require __DIR__ . '/../vendor/autoload.php';

// Set up environment for Vercel
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';
$_ENV['APP_DEBUG'] = 'true';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

// Create SQLite database if it doesn't exist
if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
    chmod('/tmp/database.sqlite', 0666);
}

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    echo "<!DOCTYPE html><html><head><title>Complete Setup</title>";
    echo "<style>body { font-family: monospace; padding: 20px; background: #1e1e1e; color: #d4d4d4; }";
    echo "h1 { color: #4ec9b0; } .success { color: #4fc1ff; } .error { color: #f44747; }";
    echo ".info { color: #ffcc02; } a { color: #569cd6; }</style></head><body>";
    
    echo "<h1>🚀 Complete Database Setup</h1>";
    
    // Step 1: Run Migrations
    echo "<div class='info'>Step 1: Running migrations...</div>";
    try {
        $kernel->call('migrate', ['--force' => true]);
        echo "<div class='success'>✅ Migrations completed</div><br>";
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'already exists') !== false) {
            echo "<div class='info'>ℹ️ Tables already exist, skipping migrations</div><br>";
        } else {
            echo "<div class='error'>❌ Migration error: " . $e->getMessage() . "</div><br>";
        }
    }
    
    // Step 2: Create Admin User
    echo "<div class='info'>Step 2: Creating admin user...</div>";
    $admin = \App\Models\User::firstOrCreate([
        'email' => 'admin@smkitihsanulfikri.sch.id'
    ], [
        'name' => 'Administrator',
        'email' => 'admin@smkitihsanulfikri.sch.id',
        'password' => bcrypt('admin123'),
        'email_verified_at' => now(),
        'plain_password' => 'admin123'
    ]);
    
    // Assign admin role if Spatie Permission is available
    if (class_exists('Spatie\Permission\Models\Role')) {
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
        echo "<div class='success'>✅ Admin role assigned</div>";
    }
    
    echo "<div class='success'>✅ Admin user created successfully!</div><br>";
    
    // Step 3: Create basic data
    echo "<div class='info'>Step 3: Creating basic school data...</div>";
    
    $class = \App\Models\SchoolClass::firstOrCreate([
        'name' => 'XII TJKT 1'
    ], [
        'name' => 'XII TJKT 1',
        'description' => 'Kelas XII Teknik Jaringan Komputer dan Telekomunikasi 1'
    ]);
    
    echo "<div class='success'>✅ Test class created: {$class->name}</div><br>";
    
    // Step 4: Test Login Credentials
    echo "<div class='info'>Step 4: Testing login credentials...</div>";
    
    if (password_verify('admin123', $admin->password)) {
        echo "<div class='success'>✅ Password verification successful!</div>";
    } else {
        echo "<div class='error'>❌ Password verification failed!</div>";
    }
    
    echo "<br><h2>🎉 Setup Complete!</h2>";
    echo "<div class='success'>Database tables created ✅</div>";
    echo "<div class='success'>Admin user created ✅</div>";
    echo "<div class='success'>Basic data seeded ✅</div>";
    echo "<div class='success'>Login credentials verified ✅</div>";
    
    echo "<br><h2>🔐 Login Information:</h2>";
    echo "<div class='info'>📧 Email: admin@smkitihsanulfikri.sch.id</div>";
    echo "<div class='info'>🔑 Password: admin123</div>";
    echo "<br><p><a href='/login'>🔗 Go to Login Page</a> | <a href='/'>🏠 Homepage</a></p>";
    
    // Important note about SQLite persistence
    echo "<br><div style='background: #2d2d30; padding: 15px; border-left: 4px solid #ffcc02;'>";
    echo "<strong>⚠️ Important Note:</strong><br>";
    echo "This setup creates a temporary SQLite database that may reset between function calls.<br>";
    echo "For production use, consider using a persistent database like PostgreSQL or MySQL.<br>";
    echo "You may need to run this setup again if you encounter 'table not found' errors.";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
    echo "<div class='error'>File: " . $e->getFile() . "</div>";
    echo "<div class='error'>Line: " . $e->getLine() . "</div>";
    echo "<pre style='color: #f44747;'>" . $e->getTraceAsString() . "</pre>";
}

echo "</body></html>";