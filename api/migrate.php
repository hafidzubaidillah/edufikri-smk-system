<?php

// Vercel migration endpoint
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Set up environment for Vercel
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';
$_ENV['APP_DEBUG'] = $_ENV['APP_DEBUG'] ?? 'false';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

// Create SQLite database if it doesn't exist
if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
    chmod('/tmp/database.sqlite', 0666);
}

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    // Run migrations
    $kernel->call('migrate', ['--force' => true]);
    
    // Run seeders if needed
    if (isset($_GET['seed']) && $_GET['seed'] === 'true') {
        $kernel->call('db:seed', ['--force' => true]);
    }
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Migrations completed successfully'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}