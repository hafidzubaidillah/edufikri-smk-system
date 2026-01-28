<?php
// Minimal Laravel for Vercel - No auto-setup, just run Laravel

// Hide all warnings and errors from output
error_reporting(0);
ini_set('display_errors', '0');

// Basic environment setup
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'false';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr';

// Create minimal directories
@mkdir('/tmp/views', 0755, true);
@mkdir('/tmp/cache', 0755, true);

// Create empty SQLite database
if (!file_exists('/tmp/database.sqlite')) {
    @touch('/tmp/database.sqlite');
    @chmod('/tmp/database.sqlite', 0666);
}

// Set APP_URL
if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https://' : 'http://';
    $_ENV['APP_URL'] = $protocol . $_SERVER['HTTP_HOST'];
}

// Load Laravel
require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../public/index.php';
?>