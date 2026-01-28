<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon PostgreSQL Setup - SMK IT Ihsanul Fikri</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .container { background: #f5f5f5; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; }
        pre { background: #f8f9fa; padding: 10px; border-radius: 4px; overflow-x: auto; }
        .step { margin: 20px 0; padding: 15px; border-left: 4px solid #007bff; background: #f8f9fa; }
    </style>
</head>
<body>
    <h1>🐘 Neon PostgreSQL Setup</h1>
    <p>Setting up persistent database for SMK IT Ihsanul Fikri Laravel Application</p>

<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Check if we have database configuration
$dbConfig = [
    'connection' => $_ENV['DB_CONNECTION'] ?? 'not set',
    'host' => $_ENV['DB_HOST'] ?? 'not set',
    'database' => $_ENV['DB_DATABASE'] ?? 'not set',
    'username' => $_ENV['DB_USERNAME'] ?? 'not set',
    'password' => !empty($_ENV['DB_PASSWORD']) ? '***set***' : 'not set',
    'port' => $_ENV['DB_PORT'] ?? 'not set'
];

echo '<div class="container info">';
echo '<h3>📊 Current Database Configuration</h3>';
echo '<pre>';
foreach ($dbConfig as $key => $value) {
    echo strtoupper($key) . ': ' . $value . "\n";
}
echo '</pre>';
echo '</div>';

if (empty($_ENV['DB_HOST']) || $_ENV['DB_HOST'] === 'not set') {
    echo '<div class="container error">';
    echo '<h3>❌ Database Not Configured</h3>';
    echo '<p>You need to set up Neon PostgreSQL database first.</p>';
    echo '</div>';
    
    echo '<div class="step">';
    echo '<h3>📝 Step 1: Create Neon Account</h3>';
    echo '<ol>';
    echo '<li>Go to <a href="https://neon.tech" target="_blank">https://neon.tech</a></li>';
    echo '<li>Sign up for a free account</li>';
    echo '<li>Create a new project named "edufikri-smk-system"</li>';
    echo '<li>Select region closest to your users</li>';
    echo '</ol>';
    echo '</div>';
    
    echo '<div class="step">';
    echo '<h3>🔗 Step 2: Get Connection Details</h3>';
    echo '<ol>';
    echo '<li>In your Neon dashboard, click the "Connect" button</li>';
    echo '<li>Select "Laravel" from the framework dropdown</li>';
    echo '<li>Copy the connection details</li>';
    echo '</ol>';
    echo '</div>';
    
    echo '<div class="step">';
    echo '<h3>⚙️ Step 3: Set Environment Variables</h3>';
    echo '<p>Run these commands in your terminal:</p>';
    echo '<pre>';
    echo 'vercel env add DB_CONNECTION production
# Enter: pgsql

vercel env add DB_HOST production  
# Enter: your-neon-hostname.us-east-1.aws.neon.tech

vercel env add DB_PORT production
# Enter: 5432

vercel env add DB_DATABASE production
# Enter: your-database-name

vercel env add DB_USERNAME production
# Enter: your-username

vercel env add DB_PASSWORD production
# Enter: your-password

# Then redeploy
vercel --prod';
    echo '</pre>';
    echo '</div>';
    
} else {
    // We have database config, try to connect and setup
    try {
        // Load Composer autoloader first
        require_once __DIR__ . '/../vendor/autoload.php';
        
        // Bootstrap Laravel
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        
        echo '<div class="container success">';
        echo '<h3>✅ Database Configuration Found</h3>';
        echo '<p>Attempting to connect and setup database...</p>';
        echo '</div>';
        
        $results = [];
        
        // Test database connection
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            echo '<div class="container success">';
            echo '<h4>🔗 Database Connection: SUCCESS</h4>';
            echo '<p>Successfully connected to Neon PostgreSQL!</p>';
            echo '</div>';
        } catch (Exception $e) {
            echo '<div class="container error">';
            echo '<h4>❌ Database Connection: FAILED</h4>';
            echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<p><strong>Common fixes:</strong></p>';
            echo '<ul>';
            echo '<li>Check if your Neon database is active</li>';
            echo '<li>Verify connection details are correct</li>';
            echo '<li>Try adding endpoint ID to password: <code>endpoint=ep-xxx-xxx;your-password</code></li>';
            echo '</ul>';
            echo '</div>';
            exit;
        }
        
        // Run migrations
        try {
            $kernel->call('migrate', ['--force' => true]);
            echo '<div class="container success">';
            echo '<h4>📊 Database Migrations: SUCCESS</h4>';
            echo '<p>All database tables created successfully!</p>';
            echo '</div>';
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'already exists') !== false || 
                strpos($e->getMessage(), 'relation') !== false) {
                echo '<div class="container info">';
                echo '<h4>📊 Database Migrations: ALREADY EXISTS</h4>';
                echo '<p>Database tables are already set up.</p>';
                echo '</div>';
            } else {
                echo '<div class="container error">';
                echo '<h4>❌ Database Migrations: ERROR</h4>';
                echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
                echo '</div>';
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
                echo '<div class="container success">';
                echo '<h4>👤 Admin User: CREATED</h4>';
                echo '<p>Admin user created successfully!</p>';
                echo '</div>';
            } else {
                echo '<div class="container info">';
                echo '<h4>👤 Admin User: ALREADY EXISTS</h4>';
                echo '<p>Admin user is already set up.</p>';
                echo '</div>';
            }
        } catch (Exception $e) {
            echo '<div class="container error">';
            echo '<h4>❌ Admin User: ERROR</h4>';
            echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '</div>';
        }
        
        // Get some basic stats
        try {
            $userCount = \App\Models\User::count();
            $learnerCount = \App\Models\Learner::count();
            $teacherCount = \App\Models\Teacher::count();
            
            echo '<div class="container info">';
            echo '<h4>📈 Database Statistics</h4>';
            echo '<ul>';
            echo "<li>Users: {$userCount}</li>";
            echo "<li>Learners: {$learnerCount}</li>";
            echo "<li>Teachers: {$teacherCount}</li>";
            echo '</ul>';
            echo '</div>';
        } catch (Exception $e) {
            // Ignore stats errors
        }
        
        echo '<div class="container success">';
        echo '<h3>🎉 Setup Complete!</h3>';
        echo '<p>Your Laravel application is now using Neon PostgreSQL database.</p>';
        echo '<h4>🔑 Admin Login Credentials:</h4>';
        echo '<ul>';
        echo '<li><strong>Email:</strong> admin@smkitihsanulfikri.sch.id</li>';
        echo '<li><strong>Password:</strong> admin123</li>';
        echo '</ul>';
        echo '<p><a href="/" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Go to Application</a></p>';
        echo '</div>';
        
    } catch (Exception $e) {
        echo '<div class="container error">';
        echo '<h3>❌ Setup Failed</h3>';
        echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
        echo '</div>';
    }
}
?>

    <div class="container">
        <h3>📚 Useful Links</h3>
        <ul>
            <li><a href="https://neon.tech" target="_blank">Neon PostgreSQL</a></li>
            <li><a href="https://vercel.com/dashboard" target="_blank">Vercel Dashboard</a></li>
            <li><a href="/" target="_blank">Laravel Application</a></li>
        </ul>
    </div>

</body>
</html>