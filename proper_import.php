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
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'options' => [
            PDO::MYSQL_ATTR_SSL_CA => __DIR__ . '/api/cacert.pem',
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        ],
    ]
]);

try {
    echo "Running migrate:fresh...\n";
    \Artisan::call('migrate:fresh', ['--force' => true, '--database' => 'mysql']);
    echo "Migrate fresh done. \n";

    $sql = file_get_contents('d:/2026/DATATHON/balaimedan.sql');

    // Split on INSERT INTO
    preg_match_all('/INSERT INTO `[^`]+`.*?(?=INSERT INTO `|ALTER TABLE `|COMMIT;|SET|$)/is', $sql, $matches);

    if (isset($matches[0])) {
        foreach ($matches[0] as $insert) {
            $insert = trim($insert);
            if (!empty($insert)) {
                echo "Running insert: " . substr($insert, 0, 50) . "...\n";
                // Strip trailing semicolons or comments roughly
                if (substr($insert, -1) !== ';') {
                    $insert .= ';';
                }
                $db->connection('mysql')->unprepared($insert);
            }
        }
    }

    echo "ALL DATA IMPORTED SUCCESSFULLY!\n";

    // Update admin user just in case
    \DB::connection('mysql')->table('users')->where('email', 'admin@example.com')->update([
        'email' => 'a@gmail.com',
        'password' => bcrypt('password'),
    ]);
    echo "UPDATED admin@example.com to a@gmail.com with password 'password'\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
