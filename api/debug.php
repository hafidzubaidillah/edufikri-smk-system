<?php

// Debug endpoint for Vercel deployment
// Visit /debug to see environment information

header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html>
<html>
<head>
    <title>Vercel Debug Info</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #1e1e1e; color: #d4d4d4; }
        h1 { color: #4ec9b0; }
        h2 { color: #569cd6; margin-top: 30px; }
        .success { color: #4ec9b0; }
        .error { color: #f48771; }
        .warning { color: #dcdcaa; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        th, td { border: 1px solid #3e3e3e; padding: 8px; text-align: left; }
        th { background: #2d2d30; color: #4ec9b0; }
        pre { background: #2d2d30; padding: 10px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>';

echo '<h1>🔍 Vercel Deployment Debug Info</h1>';

// PHP Information
echo '<h2>📋 PHP Environment</h2>';
echo '<table>';
echo '<tr><th>Setting</th><th>Value</th></tr>';
echo '<tr><td>PHP Version</td><td>' . phpversion() . '</td></tr>';
echo '<tr><td>Server Software</td><td>' . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . '</td></tr>';
echo '<tr><td>Document Root</td><td>' . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . '</td></tr>';
echo '<tr><td>Script Filename</td><td>' . __FILE__ . '</td></tr>';
echo '</table>';

// PHP Extensions
echo '<h2>🔌 PHP Extensions</h2>';
$extensions = get_loaded_extensions();
sort($extensions);
echo '<pre>' . implode(', ', $extensions) . '</pre>';

// Database Check
echo '<h2>💾 Database Configuration</h2>';
echo '<table>';
echo '<tr><th>Setting</th><th>Value</th></tr>';

$dbConnection = $_ENV['DB_CONNECTION'] ?? getenv('DB_CONNECTION') ?? 'not set';
echo '<tr><td>DB_CONNECTION</td><td>' . htmlspecialchars($dbConnection) . '</td></tr>';

if (isset($_ENV['POSTGRES_URL']) || getenv('POSTGRES_URL')) {
    echo '<tr><td>Vercel Postgres</td><td class="success">✓ Detected</td></tr>';
    $postgresUrl = $_ENV['POSTGRES_URL'] ?? getenv('POSTGRES_URL');
    // Parse and display (hide password)
    $parsed = parse_url($postgresUrl);
    echo '<tr><td>Host</td><td>' . ($parsed['host'] ?? 'N/A') . '</td></tr>';
    echo '<tr><td>Port</td><td>' . ($parsed['port'] ?? 'N/A') . '</td></tr>';
    echo '<tr><td>Database</td><td>' . ltrim($parsed['path'] ?? 'N/A', '/') . '</td></tr>';
    echo '<tr><td>User</td><td>' . ($parsed['user'] ?? 'N/A') . '</td></tr>';
} else {
    echo '<tr><td>Vercel Postgres</td><td class="warning">⚠ Not configured</td></tr>';
}

if ($dbConnection === 'sqlite') {
    $dbPath = $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE') ?? 'not set';
    echo '<tr><td>SQLite Path</td><td>' . htmlspecialchars($dbPath) . '</td></tr>';
    echo '<tr><td>SQLite Exists</td><td>' . (file_exists($dbPath) ? '<span class="success">✓ Yes</span>' : '<span class="error">✗ No</span>') . '</td></tr>';
    if (file_exists($dbPath)) {
        echo '<tr><td>SQLite Writable</td><td>' . (is_writable($dbPath) ? '<span class="success">✓ Yes</span>' : '<span class="error">✗ No</span>') . '</td></tr>';
        echo '<tr><td>SQLite Size</td><td>' . filesize($dbPath) . ' bytes</td></tr>';
    }
}

echo '</table>';

// PDO Drivers
echo '<h2>🗄️ PDO Drivers</h2>';
if (extension_loaded('pdo')) {
    echo '<pre>' . implode(', ', PDO::getAvailableDrivers()) . '</pre>';
} else {
    echo '<p class="error">PDO extension not loaded</p>';
}

// Storage Paths
echo '<h2>📁 Storage Paths</h2>';
echo '<table>';
echo '<tr><th>Path</th><th>Exists</th><th>Writable</th></tr>';

$checkPaths = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($checkPaths as $path) {
    $exists = is_dir($path);
    $writable = $exists && is_writable($path);
    echo '<tr>';
    echo '<td>' . htmlspecialchars($path) . '</td>';
    echo '<td>' . ($exists ? '<span class="success">✓</span>' : '<span class="error">✗</span>') . '</td>';
    echo '<td>' . ($writable ? '<span class="success">✓</span>' : '<span class="error">✗</span>') . '</td>';
    echo '</tr>';
}

echo '</table>';

// Environment Variables (sanitized)
echo '<h2>🔐 Environment Variables (Sanitized)</h2>';
echo '<table>';
echo '<tr><th>Variable</th><th>Value</th></tr>';

$envVars = [
    'APP_NAME', 'APP_ENV', 'APP_DEBUG', 'APP_URL',
    'DB_CONNECTION', 'SESSION_DRIVER', 'CACHE_STORE',
    'LOG_CHANNEL', 'QUEUE_CONNECTION', 'VIEW_COMPILED_PATH'
];

foreach ($envVars as $var) {
    $value = $_ENV[$var] ?? getenv($var) ?? 'not set';
    echo '<tr><td>' . htmlspecialchars($var) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
}

echo '</table>';

// Laravel Connection Test
echo '<h2>🚀 Laravel Bootstrap Test</h2>';
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require __DIR__ . '/../bootstrap/app.php';
    echo '<p class="success">✓ Laravel bootstrap successful</p>';
    
    // Try to get Laravel version
    echo '<p>Laravel Version: ' . $app->version() . '</p>';
    
    // Test database connection
    try {
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        
        $pdo = DB::connection()->getPdo();
        echo '<p class="success">✓ Database connection successful</p>';
        echo '<p>Database Driver: ' . DB::connection()->getDriverName() . '</p>';
        
        // Try to count users
        try {
            $userCount = DB::table('users')->count();
            echo '<p class="success">✓ Users table accessible (count: ' . $userCount . ')</p>';
        } catch (\Exception $e) {
            echo '<p class="warning">⚠ Users table not accessible: ' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<p class="warning">Run /migrate to setup database</p>';
        }
        
    } catch (\Exception $e) {
        echo '<p class="error">✗ Database connection failed: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    
} catch (\Exception $e) {
    echo '<p class="error">✗ Laravel bootstrap failed: ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
}

echo '<hr style="margin: 40px 0; border: 1px solid #3e3e3e;">';
echo '<p style="color: #858585;">Generated at: ' . date('Y-m-d H:i:s T') . '</p>';

echo '</body></html>';