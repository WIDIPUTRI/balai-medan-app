<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$db = app('db');
// Force DB config
config([
    'database.connections.mysql' => [
        'driver' => 'mysql',
        'host' => 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com',
        'port' => '4000',
        'database' => 'test',
        'username' => '3KugKQQueSHLBVh.root',
        'password' => 'zU4oxXXJR6kn6n1Y',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
        'options' => [
            PDO::MYSQL_ATTR_SSL_CA => __DIR__ . '/api/cacert.pem',
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        ],
    ]
]);
$sql = file_get_contents('d:/2026/DATATHON/balaimedan.sql');
try {
    $db->connection('mysql')->unprepared($sql);
    echo "SQL IMPORT SUCCESS\n";
} catch (\Exception $e) {
    echo "SQL IMPORT FAILED: " . $e->getMessage() . "\n";
}
