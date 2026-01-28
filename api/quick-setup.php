<?php
// Quick setup for immediate testing - creates SQLite database and admin user
require __DIR__ . '/../vendor/autoload.php';

// Force SQLite for immediate testing
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'true';

// Create SQLite database
if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
    chmod('/tmp/database.sqlite', 0666);
}

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    echo "<!DOCTYPE html><html><head><title>Quick Setup</title>";
    echo "<style>body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }";
    echo ".success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo ".error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo ".info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo ".warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo "</style></head><body>";
    
    echo "<h1>🚀 Quick Setup (Temporary SQLite)</h1>";
    
    echo "<div class='warning'>";
    echo "<strong>⚠️ Important:</strong> This is a temporary setup using SQLite. ";
    echo "Data will be lost between deployments. For production, set up Neon PostgreSQL.";
    echo "</div>";
    
    // Run migrations
    echo "<h3>Running Migrations...</h3>";
    try {
        $kernel->call('migrate', ['--force' => true]);
        echo "<div class='success'>✅ Database tables created successfully!</div>";
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'already exists') !== false) {
            echo "<div class='info'>ℹ️ Database tables already exist</div>";
        } else {
            echo "<div class='error'>❌ Migration error: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }
    
    // Create admin user
    echo "<h3>Creating Admin User...</h3>";
    try {
        $admin = \App\Models\User::firstOrCreate([
            'email' => 'admin@smkitihsanulfikri.sch.id'
        ], [
            'name' => 'Administrator',
            'email' => 'admin@smkitihsanulfikri.sch.id',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'plain_password' => 'admin123'
        ]);
        
        if ($admin->wasRecentlyCreated) {
            echo "<div class='success'>✅ Admin user created successfully!</div>";
        } else {
            echo "<div class='info'>ℹ️ Admin user already exists</div>";
        }
        
        // Test password
        if (password_verify('admin123', $admin->password)) {
            echo "<div class='success'>✅ Password verification successful!</div>";
        } else {
            echo "<div class='error'>❌ Password verification failed!</div>";
        }
        
    } catch (Exception $e) {
        echo "<div class='error'>❌ Error creating admin user: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    
    // Create basic data
    echo "<h3>Creating Basic Data...</h3>";
    try {
        $class = \App\Models\SchoolClass::firstOrCreate([
            'name' => 'XII TJKT 1'
        ], [
            'name' => 'XII TJKT 1',
            'description' => 'Kelas XII Teknik Jaringan Komputer dan Telekomunikasi 1'
        ]);
        
        echo "<div class='success'>✅ Test class created: {$class->name}</div>";
    } catch (Exception $e) {
        echo "<div class='info'>ℹ️ Basic data setup skipped: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    
    // Show statistics
    echo "<h3>Database Statistics</h3>";
    try {
        $userCount = \App\Models\User::count();
        echo "<div class='info'>👥 Users: {$userCount}</div>";
    } catch (Exception $e) {
        echo "<div class='error'>❌ Could not get statistics</div>";
    }
    
    echo "<div class='success'>";
    echo "<h2>🎉 Quick Setup Complete!</h2>";
    echo "<p><strong>You can now login with:</strong></p>";
    echo "<ul>";
    echo "<li><strong>Email:</strong> admin@smkitihsanulfikri.sch.id</li>";
    echo "<li><strong>Password:</strong> admin123</li>";
    echo "</ul>";
    echo "<p><a href='/login' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;'>Go to Login</a></p>";
    echo "</div>";
    
    echo "<div class='warning'>";
    echo "<h3>🔄 For Permanent Solution:</h3>";
    echo "<ol>";
    echo "<li>Create Neon database at <a href='https://neon.tech' target='_blank'>https://neon.tech</a></li>";
    echo "<li>Set environment variables using Vercel CLI</li>";
    echo "<li>Redeploy the application</li>";
    echo "</ol>";
    echo "<p><a href='/neon-setup'>View Neon Setup Guide</a></p>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>";
    echo "<h2>❌ Setup Failed</h2>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
}

echo "</body></html>";
?>