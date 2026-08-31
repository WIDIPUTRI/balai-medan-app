<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$host = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$port = '4000';
$db = 'test';
$user = '3KugKQQueSHLBVh.root';
$pass = 'zU4oxXXJR6kn6n1Y';
$ssl_ca = __DIR__ . '/api/cacert.pem';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_SSL_CA => $ssl_ca,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Check if user exists
    $stmt = $pdo->query("SELECT id FROM users WHERE email = 'admin@example.com'");
    $userId = $stmt->fetchColumn();

    if (!$userId) {
        $pdo->exec("INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES ('Admin', 'admin@example.com', '" . bcrypt('password') . "', 'admin', NOW(), NOW())");
        echo "User admin@example.com created!\n";
    } else {
        $pdo->exec("UPDATE users SET password = '" . bcrypt('password') . "' WHERE email = 'admin@example.com'");
        echo "User admin@example.com updated!\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
