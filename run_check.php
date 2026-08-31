<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$db = app('db');
config([
    'database.connections.mysql' => [
        'driver' => 'mysql',
        'host' => 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com',
        'port' => '4000',
        'database' => 'test',
        'username' => '3KugKQQueSHLBVh.root',
        'password' => 'zU4oxXXJR6kn6n1Y',
        'options' => [
            PDO::MYSQL_ATTR_SSL_CA => __DIR__ . '/api/cacert.pem',
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        ],
    ]
]);
try {
    $tables = $db->connection('mysql')->select('SHOW TABLES');
    echo "TABLES IN TEST:\n";
    print_r($tables);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
