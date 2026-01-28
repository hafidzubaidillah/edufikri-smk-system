<?php
// Test login functionality
require_once __DIR__ . '/../vendor/autoload.php';

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

// Create directories and database
@mkdir('/tmp/storage/framework/views', 0755, true);
@mkdir('/tmp/storage/framework/cache/data', 0755, true);
@mkdir('/tmp/storage/logs', 0755, true);

if (!file_exists('/tmp/database.sqlite')) {
    @touch('/tmp/database.sqlite');
    @chmod('/tmp/database.sqlite', 0666);
}

// Set APP_URL
if (isset($_SERVER['HTTP_HOST'])) {
    $isHttps = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    $protocol = $isHttps ? 'https://' : 'http://';
    $_ENV['APP_URL'] = $protocol . $_SERVER['HTTP_HOST'];
}

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Ensure database is set up
    $hasUsers = \Illuminate\Support\Facades\Schema::hasTable('users');
    if (!$hasUsers) {
        $kernel->call('migrate', ['--force' => true]);
        
        // Create admin user
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@smkitihsanulfikri.sch.id',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'plain_password' => 'admin123'
        ]);
    }
    
    // Handle login form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if ($email && $password) {
            $user = \App\Models\User::where('email', $email)->first();
            
            if ($user && password_verify($password, $user->password)) {
                // Login successful
                echo json_encode([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email
                    ]
                ]);
                exit;
            } else {
                // Login failed
                echo json_encode([
                    'success' => false,
                    'message' => 'Email atau password salah!'
                ]);
                exit;
            }
        }
    }
    
    // Show login form
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Test Login - SMK IT Ihsanul Fikri</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
            .form-group { margin: 15px 0; }
            label { display: block; margin-bottom: 5px; font-weight: bold; }
            input[type="email"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
            button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
            button:hover { background: #0056b3; }
            .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin: 10px 0; }
            .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin: 10px 0; }
            .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 4px; margin: 10px 0; }
        </style>
    </head>
    <body>
        <h1>🔐 Test Login</h1>
        <p>SMK IT Ihsanul Fikri - Mungkid Magelang</p>
        
        <div class="info">
            <strong>Login Credentials:</strong><br>
            Email: admin@smkitihsanulfikri.sch.id<br>
            Password: admin123
        </div>
        
        <form method="POST" id="loginForm">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="admin@smkitihsanulfikri.sch.id" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="admin123" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
        
        <div id="result"></div>
        
        <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('result');
                if (data.success) {
                    resultDiv.innerHTML = '<div class="success">' + data.message + '<br>Welcome, ' + data.user.name + '!</div>';
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                } else {
                    resultDiv.innerHTML = '<div class="error">' + data.message + '</div>';
                }
            })
            .catch(error => {
                document.getElementById('result').innerHTML = '<div class="error">Error: ' + error.message + '</div>';
            });
        });
        </script>
        
        <hr>
        <p><a href="/">← Kembali ke Homepage</a></p>
    </body>
    </html>
    <?php
    
} catch (Exception $e) {
    echo "<h1>Error</h1>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>