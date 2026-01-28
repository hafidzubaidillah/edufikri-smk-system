<?php

// Migration endpoint for Vercel deployment
// Visit /migrate to run migrations and seed database

header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html>
<html>
<head>
    <title>Database Migration</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #1e1e1e; color: #d4d4d4; }
        h1 { color: #4ec9b0; }
        h2 { color: #569cd6; margin-top: 30px; }
        .success { color: #4ec9b0; }
        .error { color: #f48771; }
        .warning { color: #dcdcaa; }
        .info { color: #9cdcfe; }
        pre { background: #2d2d30; padding: 10px; border-radius: 4px; overflow-x: auto; margin: 10px 0; }
        .step { margin: 20px 0; padding: 15px; background: #2d2d30; border-left: 3px solid #569cd6; }
    </style>
</head>
<body>';

echo '<h1>🗄️ Database Migration & Setup</h1>';

try {
    // Bootstrap Laravel
    require __DIR__ . '/../vendor/autoload.php';
    $app = require __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo '<div class="step">';
    echo '<h2>Step 1: Laravel Bootstrap</h2>';
    echo '<p class="success">✓ Laravel bootstrapped successfully</p>';
    echo '<p class="info">Version: ' . $app->version() . '</p>';
    echo '</div>';
    
    // Test database connection
    echo '<div class="step">';
    echo '<h2>Step 2: Database Connection</h2>';
    try {
        $pdo = DB::connection()->getPdo();
        echo '<p class="success">✓ Database connected</p>';
        echo '<p class="info">Driver: ' . DB::connection()->getDriverName() . '</p>';
        echo '<p class="info">Database: ' . DB::connection()->getDatabaseName() . '</p>';
    } catch (\Exception $e) {
        echo '<p class="error">✗ Database connection failed</p>';
        echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
        throw $e;
    }
    echo '</div>';
    
    // Run migrations
    echo '<div class="step">';
    echo '<h2>Step 3: Running Migrations</h2>';
    try {
        // Capture output
        ob_start();
        Artisan::call('migrate', ['--force' => true]);
        $output = ob_get_clean();
        
        echo '<p class="success">✓ Migrations executed</p>';
        echo '<pre>' . htmlspecialchars(Artisan::output()) . '</pre>';
    } catch (\Exception $e) {
        ob_end_clean();
        echo '<p class="error">✗ Migration failed</p>';
        echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
        throw $e;
    }
    echo '</div>';
    
    // Check if admin user exists
    echo '<div class="step">';
    echo '<h2>Step 4: Admin User Setup</h2>';
    try {
        $adminEmail = 'admin@smkitihsanulfikri.sch.id';
        $adminExists = DB::table('users')->where('email', $adminEmail)->exists();
        
        if ($adminExists) {
            echo '<p class="info">ℹ Admin user already exists</p>';
            echo '<p>Email: ' . htmlspecialchars($adminEmail) . '</p>';
        } else {
            // Create admin user
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => $adminEmail,
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            echo '<p class="success">✓ Admin user created</p>';
            echo '<p>Email: ' . htmlspecialchars($adminEmail) . '</p>';
            echo '<p class="warning">⚠ Default Password: admin123</p>';
            echo '<p class="warning">⚠ Please change this password immediately!</p>';
        }
    } catch (\Exception $e) {
        echo '<p class="error">✗ Admin user setup failed</p>';
        echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
    }
    echo '</div>';
    
    // Database statistics
    echo '<div class="step">';
    echo '<h2>Step 5: Database Statistics</h2>';
    try {
        $tables = ['users', 'sessions', 'cache', 'jobs'];
        echo '<table style="width: 100%; border-collapse: collapse;">';
        echo '<tr style="background: #3e3e3e;"><th style="padding: 8px; text-align: left;">Table</th><th style="padding: 8px; text-align: left;">Count</th></tr>';
        
        foreach ($tables as $table) {
            try {
                $count = DB::table($table)->count();
                echo '<tr><td style="padding: 8px; border-top: 1px solid #3e3e3e;">' . htmlspecialchars($table) . '</td>';
                echo '<td style="padding: 8px; border-top: 1px solid #3e3e3e;">' . $count . '</td></tr>';
            } catch (\Exception $e) {
                echo '<tr><td style="padding: 8px; border-top: 1px solid #3e3e3e;">' . htmlspecialchars($table) . '</td>';
                echo '<td style="padding: 8px; border-top: 1px solid #3e3e3e; color: #858585;">N/A</td></tr>';
            }
        }
        
        echo '</table>';
    } catch (\Exception $e) {
        echo '<p class="error">✗ Failed to get statistics</p>';
    }
    echo '</div>';
    
    // Success message
    echo '<div class="step" style="border-left-color: #4ec9b0;">';
    echo '<h2>✓ Migration Complete!</h2>';
    echo '<p class="success">Database is ready to use</p>';
    echo '<p>You can now:</p>';
    echo '<ul>';
    echo '<li>Visit <a href="/" style="color: #569cd6;">Homepage</a></li>';
    echo '<li>Login with admin credentials</li>';
    echo '<li>Check <a href="/debug" style="color: #569cd6;">Debug Info</a></li>';
    echo '</ul>';
    echo '</div>';
    
} catch (\Exception $e) {
    echo '<div class="step" style="border-left-color: #f48771;">';
    echo '<h2>✗ Migration Failed</h2>';
    echo '<p class="error">An error occurred during migration</p>';
    echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div>';
}

echo '<hr style="margin: 40px 0; border: 1px solid #3e3e3e;">';
echo '<p style="color: #858585;">Generated at: ' . date('Y-m-d H:i:s T') . '</p>';

echo '</body></html>';