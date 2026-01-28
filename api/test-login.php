<?php

// Test login endpoint untuk debugging
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

try {
    echo "<!DOCTYPE html><html><head><title>Login Test</title>";
    echo "<style>body { font-family: monospace; padding: 20px; background: #1e1e1e; color: #d4d4d4; }";
    echo "h1 { color: #4ec9b0; } .success { color: #4fc1ff; } .error { color: #f44747; }";
    echo ".info { color: #ffcc02; } a { color: #569cd6; }</style></head><body>";
    
    echo "<h1>🔐 Login Test</h1>";
    
    // Check database connection
    echo "<div class='info'>Database Connection: " . config('database.default') . "</div>";
    echo "<div class='info'>Database Path: " . config('database.connections.sqlite.database') . "</div>";
    
    // Check if users table exists
    $users = \App\Models\User::count();
    echo "<div class='success'>✅ Users table accessible, found {$users} users</div><br>";
    
    // Try to find admin user
    $admin = \App\Models\User::where('email', 'admin@smkitihsanulfikri.sch.id')->first();
    
    if ($admin) {
        echo "<div class='success'>✅ Admin user found!</div>";
        echo "<div class='info'>📧 Email: {$admin->email}</div>";
        echo "<div class='info'>👤 Name: {$admin->name}</div>";
        echo "<div class='info'>🔑 Password Hash: " . substr($admin->password, 0, 20) . "...</div>";
        
        // Test password verification
        if (password_verify('admin123', $admin->password)) {
            echo "<div class='success'>✅ Password verification successful!</div>";
        } else {
            echo "<div class='error'>❌ Password verification failed!</div>";
        }
        
    } else {
        echo "<div class='error'>❌ Admin user not found!</div>";
        echo "<div class='info'>Creating admin user...</div>";
        
        $admin = \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@smkitihsanulfikri.sch.id',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'plain_password' => 'admin123'
        ]);
        
        echo "<div class='success'>✅ Admin user created!</div>";
    }
    
    echo "<br><h2>🎯 Login Credentials:</h2>";
    echo "<div class='info'>📧 Email: admin@smkitihsanulfikri.sch.id</div>";
    echo "<div class='info'>🔑 Password: admin123</div>";
    echo "<br><p><a href='/login'>🔗 Go to Login Page</a></p>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
    echo "<div class='error'>File: " . $e->getFile() . "</div>";
    echo "<div class='error'>Line: " . $e->getLine() . "</div>";
}

echo "</body></html>";