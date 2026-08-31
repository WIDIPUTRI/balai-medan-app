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
    // Check if a@gmail.com exists, if not create it
    $user = \DB::connection('mysql')->table('users')->where('email', 'a@gmail.com')->first();
    if (!$user) {
        \DB::connection('mysql')->table('users')->insert([
            'name' => 'Admin Baru',
            'email' => 'a@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        echo "CREATED a@gmail.com with password 'password'";
    } else {
        \DB::connection('mysql')->table('users')->where('email', 'a@gmail.com')->update([
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        echo "UPDATED a@gmail.com with password 'password'";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
