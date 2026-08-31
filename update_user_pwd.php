<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
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
    \DB::connection('mysql')->table('users')->where('email', 'admin@example.com')->update([
        'password' => bcrypt('password'),
    ]);
    echo "UPDATED admin@example.com with password 'password'\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
