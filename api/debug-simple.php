<?php
// Simple debug endpoint
echo "<!DOCTYPE html><html><head><title>Debug</title></head><body>";
echo "<h1>🔍 Simple Debug</h1>";

echo "<h3>PHP Info</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Current Directory: " . __DIR__ . "</p>";

echo "<h3>Environment Variables</h3>";
echo "<ul>";
echo "<li>APP_ENV: " . ($_ENV['APP_ENV'] ?? 'not set') . "</li>";
echo "<li>DB_CONNECTION: " . ($_ENV['DB_CONNECTION'] ?? 'not set') . "</li>";
echo "<li>DATABASE_URL: " . (isset($_ENV['DATABASE_URL']) ? 'set' : 'not set') . "</li>";
echo "</ul>";

echo "<h3>File System</h3>";
echo "<ul>";
echo "<li>Vendor exists: " . (file_exists(__DIR__ . '/../vendor/autoload.php') ? 'YES' : 'NO') . "</li>";
echo "<li>Bootstrap exists: " . (file_exists(__DIR__ . '/../bootstrap/app.php') ? 'YES' : 'NO') . "</li>";
echo "<li>Public index exists: " . (file_exists(__DIR__ . '/../public/index.php') ? 'YES' : 'NO') . "</li>";
echo "</ul>";

echo "<h3>Test Autoloader</h3>";
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    echo "<p style='color: green;'>✅ Autoloader loaded successfully</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Autoloader failed: " . $e->getMessage() . "</p>";
}

echo "<h3>Test Laravel Bootstrap</h3>";
try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "<p style='color: green;'>✅ Laravel app bootstrapped</p>";
    echo "<p>App class: " . get_class($app) . "</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Laravel bootstrap failed: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "</body></html>";
?>