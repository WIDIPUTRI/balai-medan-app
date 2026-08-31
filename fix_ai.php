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
    foreach ($tables as $table) {
        $tableName = array_values((array) $table)[0];
        $columns = $db->connection('mysql')->select("SHOW COLUMNS FROM `$tableName`");
        foreach ($columns as $column) {
            if ($column->Field === 'id' && strpos(strtolower($column->Type), 'int') !== false) {
                // If it's an integer ID, make sure it's AUTO_INCREMENT (if it's not already)
                if (strpos(strtolower($column->Extra), 'auto_increment') === false) {
                    echo "Altering $tableName.id to AUTO_INCREMENT...\n";
                    $db->connection('mysql')->statement("ALTER TABLE `$tableName` MODIFY `id` {$column->Type} NOT NULL AUTO_INCREMENT");
                }
            }
        }
    }
    echo "DONE ALTERING TABLES.";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
