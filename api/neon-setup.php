<?php
// Neon Database Setup Endpoint
// This endpoint helps set up the database connection and run initial migrations

header('Content-Type: application/json');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

try {
    // Check if we have database configuration
    $dbConfig = [
        'connection' => $_ENV['DB_CONNECTION'] ?? 'pgsql',
        'host' => $_ENV['DB_HOST'] ?? null,
        'database' => $_ENV['DB_DATABASE'] ?? null,
        'username' => $_ENV['DB_USERNAME'] ?? null,
        'password' => $_ENV['DB_PASSWORD'] ?? null,
        'port' => $_ENV['DB_PORT'] ?? '5432'
    ];
    
    if (empty($dbConfig['host'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database configuration not found. Please set up Neon database environment variables.',
            'instructions' => [
                '1. Create a Neon account at https://neon.tech',
                '2. Create a new project and database',
                '3. Set environment variables in Vercel:',
                '   - DB_CONNECTION=pgsql',
                '   - DB_HOST=your-neon-hostname',
                '   - DB_PORT=5432',
                '   - DB_DATABASE=your-database-name',
                '   - DB_USERNAME=your-username',
                '   - DB_PASSWORD=your-password'
            ]
        ]);
        exit;
    }
    
    // Bootstrap Laravel
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    $results = [];
    
    // Test database connection
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $results['connection'] = 'SUCCESS: Connected to Neon PostgreSQL';
    } catch (Exception $e) {
        $results['connection'] = 'ERROR: ' . $e->getMessage();
        echo json_encode([
            'status' => 'error',
            'message' => 'Database connection failed',
            'error' => $e->getMessage(),
            'config' => [
                'host' => $dbConfig['host'],
                'database' => $dbConfig['database'],
                'username' => $dbConfig['username'],
                'port' => $dbConfig['port']
            ]
        ]);
        exit;
    }
    
    // Run migrations
    try {
        $kernel->call('migrate', ['--force' => true]);
        $results['migrations'] = 'SUCCESS: Database migrations completed';
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'already exists') !== false || 
            strpos($e->getMessage(), 'relation') !== false) {
            $results['migrations'] = 'INFO: Tables already exist';
        } else {
            $results['migrations'] = 'ERROR: ' . $e->getMessage();
        }
    }
    
    // Create admin user
    try {
        $admin = \App\Models\User::firstOrCreate([
            'email' => 'admin@smkitihsanulfikri.sch.id'
        ], [
            'name' => 'Administrator',
            'email' => 'admin@smkitihsanulfikri.sch.id',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'plain_password' => 'admin123'
        ]);
        
        if ($admin->wasRecentlyCreated) {
            $results['admin_user'] = 'SUCCESS: Admin user created';
        } else {
            $results['admin_user'] = 'INFO: Admin user already exists';
        }
    } catch (Exception $e) {
        $results['admin_user'] = 'ERROR: ' . $e->getMessage();
    }
    
    // Get some basic stats
    try {
        $userCount = \App\Models\User::count();
        $results['stats'] = "Database has {$userCount} users";
    } catch (Exception $e) {
        $results['stats'] = 'Could not get stats: ' . $e->getMessage();
    }
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Neon PostgreSQL setup completed',
        'results' => $results,
        'admin_credentials' => [
            'email' => 'admin@smkitihsanulfikri.sch.id',
            'password' => 'admin123'
        ],
        'database_config' => [
            'connection' => $dbConfig['connection'],
            'host' => $dbConfig['host'],
            'database' => $dbConfig['database'],
            'username' => $dbConfig['username'],
            'port' => $dbConfig['port']
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Setup failed',
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}
?>