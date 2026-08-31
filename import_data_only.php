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
    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT, // changed to SILENT to ignore INSERT duplication errors
    PDO::MYSQL_ATTR_SSL_CA => $ssl_ca,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Read the data-only sql
    $sql = file_get_contents(__DIR__ . '/balaimedan_data_only.sql');

    // Execute
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0;");
    $statements = explode(";\n", $sql);
    $count = 0;
    foreach ($statements as $stmt) {
        $stmt = trim($stmt);
        if ($stmt) {
            $pdo->exec($stmt);
            $count++;
        }
    }
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");

    // Reset login for admin just to be double sure
    $pdo->exec("UPDATE `users` SET `password` = '" . bcrypt('password') . "' WHERE `email` = 'admin@example.com'");

    echo "Data Import of $count statements and Password Reset Completed Successfully!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
