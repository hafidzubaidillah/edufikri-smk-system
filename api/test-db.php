<?php
// Test database connection
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED); // Hide deprecation warnings
require_once __DIR__ . '/../vendor/autoload.php';

// Set up environment
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'true';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr';

// Create directories
@mkdir('/tmp/storage/framework/views', 0755, true);
@mkdir('/tmp/storage/framework/cache/data', 0755, true);
@mkdir('/tmp/storage/logs', 0755, true);

// Create SQLite database
if (!file_exists('/tmp/database.sqlite')) {
    @touch('/tmp/database.sqlite');
    @chmod('/tmp/database.sqlite', 0666);
}

echo "<!DOCTYPE html><html><head><title>Database Test</title></head><body>";
echo "<h1>🗄️ Database Test</h1>";

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "<p style='color: green;'>✅ Laravel app loaded</p>";
    
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap(); // Bootstrap Laravel properly
    echo "<p style='color: green;'>✅ Kernel bootstrapped</p>";
    
    // Test database connection
    $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "<p style='color: green;'>✅ Database connected</p>";
    echo "<p>Driver: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "</p>";
    
    // Run migrations
    echo "<h3>Running Migrations...</h3>";
    $kernel->call('migrate', ['--force' => true]);
    echo "<p style='color: green;'>✅ Migrations completed</p>";
    
    // Create admin user
    echo "<h3>Creating Admin User...</h3>";
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
        echo "<p style='color: green;'>✅ Admin user created</p>";
    } else {
        echo "<p style='color: blue;'>ℹ️ Admin user already exists</p>";
    }
    
    // Test password
    if (password_verify('admin123', $admin->password)) {
        echo "<p style='color: green;'>✅ Password verification successful</p>";
    } else {
        echo "<p style='color: red;'>❌ Password verification failed</p>";
    }
    
    // Show user count
    $userCount = \App\Models\User::count();
    echo "<p>Total users: {$userCount}</p>";
    
    echo "<h2 style='color: green;'>🎉 Database Setup Complete!</h2>";
    echo "<p><strong>Login Credentials:</strong></p>";
    echo "<ul>";
    echo "<li>Email: admin@smkitihsanulfikri.sch.id</li>";
    echo "<li>Password: admin123</li>";
    echo "</ul>";
    echo "<p><a href='/login'>Go to Login Page</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "</body></html>";
?>