<?php

// Vercel serverless function for Laravel
use Illuminate\Http\Request;

// Set up environment for Vercel
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';
$_ENV['APP_DEBUG'] = $_ENV['APP_DEBUG'] ?? 'false';

// Set up SQLite database path for Vercel
if (!isset($_ENV['DB_DATABASE']) || $_ENV['DB_CONNECTION'] === 'sqlite') {
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
    
    // Create SQLite database if it doesn't exist
    if (!file_exists('/tmp/database.sqlite')) {
        touch('/tmp/database.sqlite');
        chmod('/tmp/database.sqlite', 0666);
    }
}

// Forward Vercel requests to Laravel
require __DIR__ . '/../public/index.php';