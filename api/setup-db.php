<?php
// Database setup endpoint - run this ONCE to setup database
error_reporting(0);

$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'false';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'array';

@mkdir('/tmp/views', 0755, true);

if (!file_exists('/tmp/database.sqlite')) {
    @touch('/tmp/database.sqlite');
    @chmod('/tmp/database.sqlite', 0666);
}

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Run migrations
    $kernel->call('migrate', ['--force' => true]);
    
    // Create admin user
    \App\Models\User::firstOrCreate([
        'email' => 'admin@smkitihsanulfikri.sch.id'
    ], [
        'name' => 'Administrator',
        'email' => 'admin@smkitihsanulfikri.sch.id',
        'password' => bcrypt('admin123'),
        'email_verified_at' => now(),
        'plain_password' => 'admin123'
    ]);
    
    echo "SUCCESS: Database setup complete!<br>";
    echo "Login: admin@smkitihsanulfikri.sch.id / admin123<br>";
    echo "<a href='/login'>Go to Login</a>";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
?>