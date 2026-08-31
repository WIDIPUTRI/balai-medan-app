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

    // Get all tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        try {
            $cols = $pdo->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($cols as $col) {
                if ($col['Field'] === 'id' && strpos(strtolower($col['Type']), 'int') !== false) {
                    if (strpos(strtolower($col['Extra']), 'auto_increment') === false) {
                        $type = $col['Type'];
                        $pdo->exec("ALTER TABLE `$table` MODIFY `id` $type NOT NULL AUTO_INCREMENT");
                        echo "Fixed AUTO_INCREMENT for $table.id\n";
                    }
                }
            }
        } catch (\Exception $e) {
            echo "Skipping $table: " . $e->getMessage() . "\n";
        }
    }

    echo "Done checking all tables!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
