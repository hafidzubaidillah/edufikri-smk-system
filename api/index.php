<?php

// Vercel Serverless Function for Laravel
// Enhanced with error handling and Vercel Postgres support

// Error reporting for debugging (will be logged to Vercel)
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

try {
    // Set up environment for Vercel
    $_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';
    $_ENV['APP_DEBUG'] = $_ENV['APP_DEBUG'] ?? 'false';
    
    // Database Configuration - FORCE SQLite for Vercel
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
    $_ENV['DB_HOST'] = '';
    $_ENV['DB_PORT'] = '';
    $_ENV['DB_USERNAME'] = '';
    $_ENV['DB_PASSWORD'] = '';
    
    // Also set via putenv for compatibility
    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=/tmp/database.sqlite');
    putenv('DB_HOST=');
    putenv('DB_PORT=');
    putenv('DB_USERNAME=');
    putenv('DB_PASSWORD=');
    
    // Create SQLite database if it doesn't exist
    if (!file_exists('/tmp/database.sqlite')) {
        @touch('/tmp/database.sqlite');
        @chmod('/tmp/database.sqlite', 0666);
        
        // Auto-setup database on first access
        try {
            $app = require_once __DIR__ . '/../bootstrap/app.php';
            $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
            
            // Run migrations
            $kernel->call('migrate', ['--force' => true]);
            
            // Create admin user
            $admin = \App\Models\User::firstOrCreate([
                'email' => 'admin@smkitihsanulfikri.sch.id'
            ], [
                'name' => 'Administrator',
                'email' => 'admin@smkitihsanulfikri.sch.id',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
                'plain_password' => 'admin123'
            ]);
            
            error_log('Auto-setup completed: Database and admin user created');
        } catch (Exception $e) {
            error_log('Auto-setup failed: ' . $e->getMessage());
        }
    }
    
    // Ensure storage directories exist in /tmp (ephemeral filesystem)
    $storagePaths = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
        '/tmp/storage/app/public',
    ];
    
    foreach ($storagePaths as $path) {
        if (!is_dir($path)) {
            @mkdir($path, 0755, true);
        }
    }
    
    // Set environment variables for Laravel
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
    $_ENV['SESSION_DRIVER'] = 'cookie'; // Cookie-based sessions for serverless
    $_ENV['CACHE_STORE'] = 'array'; // Array cache (ephemeral, per-request)
    $_ENV['LOG_CHANNEL'] = 'stderr'; // Log to stderr for Vercel function logs
    $_ENV['QUEUE_CONNECTION'] = 'sync'; // Synchronous queue processing
    
    // Set APP_URL dynamically based on the request
    if (isset($_SERVER['HTTP_HOST'])) {
        $isHttps = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
            
        $protocol = $isHttps ? 'https://' : 'http://';
        $_ENV['APP_URL'] = $protocol . $_SERVER['HTTP_HOST'];
        $_ENV['ASSET_URL'] = $_ENV['APP_URL'];
    }
    
    // Security headers for production
    if ($_ENV['APP_ENV'] === 'production') {
        header('X-Frame-Options: SAMEORIGIN');
        header('X-Content-Type-Options: nosniff');
        header('X-XSS-Protection: 1; mode=block');
    }
    
    // Forward request to Laravel
    require __DIR__ . '/../public/index.php';
    
} catch (\Throwable $e) {
    // Catch any fatal errors and display user-friendly message
    http_response_code(500);
    
    if ($_ENV['APP_DEBUG'] === 'true') {
        // Show detailed error in debug mode
        echo '<h1>Server Error</h1>';
        echo '<p><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ':' . $e->getLine() . '</p>';
        echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    } else {
        // Production error message
        echo '<h1>500 - Server Error</h1>';
        echo '<p>An error occurred. Please try again later.</p>';
    }
    
    // Log error to stderr (visible in Vercel logs)
    error_log('FATAL ERROR: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    error_log($e->getTraceAsString());
}