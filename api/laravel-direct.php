<?php
// Direct Laravel execution without auto-setup

// Set up environment
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED); // Hide deprecation warnings
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'false';
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

// Set APP_URL dynamically
if (isset($_SERVER['HTTP_HOST'])) {
    $isHttps = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
        
    $protocol = $isHttps ? 'https://' : 'http://';
    $_ENV['APP_URL'] = $protocol . $_SERVER['HTTP_HOST'];
    $_ENV['ASSET_URL'] = $_ENV['APP_URL'];
}

// Load Laravel
require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../public/index.php';
?>