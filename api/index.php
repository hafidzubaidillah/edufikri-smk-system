<?php

// Set up SQLite database for Vercel
if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
    
    // Set environment for SQLite
    $_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
    putenv('DB_DATABASE=/tmp/database.sqlite');
}

// Forward Vercel requests to Laravel
require __DIR__ . '/../public/index.php';