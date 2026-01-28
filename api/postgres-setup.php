<?php
// PostgreSQL Database Setup - Khusus untuk Neon
require __DIR__ . '/../vendor/autoload.php';

// Set up environment for Vercel serverless
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'true';
$_ENV['DB_CONNECTION'] = 'pgsql';

// Set up storage paths for serverless
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr';

// Create necessary directories
$storagePaths = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
];

foreach ($storagePaths as $path) {
    if (!is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap(); // Bootstrap Laravel properly
    
    echo "<!DOCTYPE html><html><head><title>PostgreSQL Setup</title>";
    echo "<style>body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }";
    echo ".success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo ".error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo ".info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo ".warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 10px; margin: 10px 0; border-radius: 4px; }";
    echo "</style></head><body>";
    
    echo "<h1>🐘 PostgreSQL Database Setup</h1>";
    
    // Show current config
    echo "<div class='info'>";
    echo "<h3>📊 Current Configuration</h3>";
    echo "<ul>";
    echo "<li><strong>DB_CONNECTION:</strong> " . ($_ENV['DB_CONNECTION'] ?? 'not set') . "</li>";
    echo "<li><strong>DATABASE_URL:</strong> " . (isset($_ENV['DATABASE_URL']) ? 'set' : 'not set') . "</li>";
    echo "</ul>";
    echo "</div>";
    
    // Test database connection
    echo "<h3>🔗 Testing Database Connection...</h3>";
    try {
        $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
        echo "<div class='success'>✅ PostgreSQL connection successful!</div>";
        echo "<div class='info'>Driver: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "</div>";
        
        // Get database info
        $dbName = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
        echo "<div class='info'>Database: {$dbName}</div>";
        
    } catch (Exception $e) {
        echo "<div class='error'>❌ Database connection failed!</div>";
        echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
        
        if (strpos($e->getMessage(), 'Endpoint ID') !== false) {
            echo "<div class='warning'>";
            echo "<strong>💡 Fix Suggestion:</strong><br>";
            echo "This is a Neon-specific error. The connection string needs endpoint ID parameter.<br>";
            echo "Current DATABASE_URL might be missing the endpoint parameter.";
            echo "</div>";
        }
        
        echo "</body></html>";
        exit;
    }
    
    // Run migrations
    echo "<h3>📊 Running Database Migrations...</h3>";
    try {
        $kernel->call('migrate', ['--force' => true]);
        echo "<div class='success'>✅ Database migrations completed!</div>";
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'already exists') !== false || 
            strpos($e->getMessage(), 'relation') !== false) {
            echo "<div class='info'>ℹ️ Database tables already exist</div>";
        } else {
            echo "<div class='error'>❌ Migration error: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }
    
    // Create admin user
    echo "<h3>👤 Creating Admin User...</h3>";
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
    
    // Show statistics
    echo "<h3>📈 Database Statistics</h3>";
    try {
        $userCount = \App\Models\User::count();
        echo "<div class='info'>👥 Total Users: {$userCount}</div>";
        
        // Test query
        $tables = \Illuminate\Support\Facades\DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        echo "<div class='info'>📊 Tables found: " . count($tables) . "</div>";
        
    } catch (Exception $e) {
        echo "<div class='error'>❌ Could not get statistics: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    
    echo "<div class='success'>";
    echo "<h2>🎉 PostgreSQL Setup Complete!</h2>";
    echo "<p><strong>You can now login with:</strong></p>";
    echo "<ul>";
    echo "<li><strong>Email:</strong> admin@smkitihsanulfikri.sch.id</li>";
    echo "<li><strong>Password:</strong> admin123</li>";
    echo "</ul>";
    echo "<p><a href='/login' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;'>Go to Login</a></p>";
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