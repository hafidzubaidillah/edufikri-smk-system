<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "User Count: " . \App\Models\User::count() . PHP_EOL;
    $user = \App\Models\User::where('email', 'test@example.com')->first();
    if ($user) {
        echo "User 'test@example.com' found. Password hash: " . substr($user->password, 0, 10) . "..." . PHP_EOL;
    } else {
        echo "User 'test@example.com' NOT FOUND." . PHP_EOL;
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
