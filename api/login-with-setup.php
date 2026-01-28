<?php

// Login endpoint with automatic database setup
require __DIR__ . '/../vendor/autoload.php';

// Set up environment for Vercel
$_ENV['APP_ENV'] = $_ENV['APP_ENV'] ?? 'production';
$_ENV['APP_DEBUG'] = 'true';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

// Force environment variables
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=/tmp/database.sqlite');
putenv('DB_HOST=');
putenv('DB_PORT=');
putenv('DB_USERNAME=');
putenv('DB_PASSWORD=');

// Create SQLite database if it doesn't exist
if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
    chmod('/tmp/database.sqlite', 0666);
}

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    // Always ensure database is set up
    try {
        // Check if users table exists
        $userCount = \App\Models\User::count();
    } catch (Exception $e) {
        // Table doesn't exist, run setup
        try {
            $kernel->call('migrate', ['--force' => true]);
        } catch (Exception $migrationError) {
            // Ignore if tables already exist
        }
        
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
    }
    
    // Handle login request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if ($email && $password) {
            // Find user
            $user = \App\Models\User::where('email', $email)->first();
            
            if ($user && password_verify($password, $user->password)) {
                // Login successful - redirect to dashboard
                header('Location: /admin/dashboard');
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        } else {
            $error = 'Email and password required';
        }
    }
    
    // Show login form
    echo "<!DOCTYPE html><html><head><title>Login - SMK IT Ihsanul Fikri</title>";
    echo "<style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0; padding: 20px; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); max-width: 400px; width: 100%; }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
        input[type='email'], input[type='password'] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #667eea; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        button:hover { background: #5a6fd8; }
        .error { color: #e74c3c; margin-bottom: 15px; padding: 10px; background: #fdf2f2; border: 1px solid #fecaca; border-radius: 5px; }
        .success { color: #16a085; margin-bottom: 15px; padding: 10px; background: #f0fdfa; border: 1px solid #a7f3d0; border-radius: 5px; }
        .info { color: #2980b9; margin-bottom: 15px; padding: 10px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 5px; }
        a { color: #667eea; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style></head><body>";
    
    echo "<div class='login-container'>";
    echo "<h1>🔐 Login Admin</h1>";
    echo "<div class='info'>Database automatically set up and ready!</div>";
    
    if (isset($error)) {
        echo "<div class='error'>❌ $error</div>";
    }
    
    echo "<form method='POST'>";
    echo "<div class='form-group'>";
    echo "<label for='email'>📧 Email:</label>";
    echo "<input type='email' id='email' name='email' value='admin@smkitihsanulfikri.sch.id' required>";
    echo "</div>";
    
    echo "<div class='form-group'>";
    echo "<label for='password'>🔑 Password:</label>";
    echo "<input type='password' id='password' name='password' placeholder='admin123' required>";
    echo "</div>";
    
    echo "<button type='submit'>🚀 Login</button>";
    echo "</form>";
    
    echo "<div style='margin-top: 20px; text-align: center;'>";
    echo "<small>Default: admin@smkitihsanulfikri.sch.id / admin123</small><br>";
    echo "<a href='/'>← Back to Homepage</a>";
    echo "</div>";
    
    echo "</div>";
    echo "</body></html>";
    
} catch (Exception $e) {
    echo "<!DOCTYPE html><html><head><title>Error</title></head><body>";
    echo "<h1>Setup Error</h1>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>File: " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p>Line: " . $e->getLine() . "</p>";
    echo "</body></html>";
}