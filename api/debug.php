<?php

// Debug endpoint untuk Vercel
require __DIR__ . '/../vendor/autoload.php';

// Set up environment for Vercel
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';
$_ENV['APP_DEBUG'] = 'true'; // Enable debug untuk melihat error
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

// Create SQLite database if it doesn't exist
if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
    chmod('/tmp/database.sqlite', 0666);
}

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    $request = Illuminate\Http\Request::capture();
    $response = $kernel->handle($request);
    
    echo "Debug Info:\n";
    echo "PHP Version: " . PHP_VERSION . "\n";
    echo "Laravel Version: " . app()->version() . "\n";
    echo "Environment: " . app()->environment() . "\n";
    echo "Database: " . config('database.default') . "\n";
    echo "Database Path: " . config('database.connections.sqlite.database') . "\n";
    echo "SQLite exists: " . (file_exists('/tmp/database.sqlite') ? 'Yes' : 'No') . "\n";
    echo "SQLite writable: " . (is_writable('/tmp/database.sqlite') ? 'Yes' : 'No') . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}