<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

$tmpDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Override Laravel's paths specifically for Vercel
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/storage/framework/cache/services.php';
$_SERVER['APP_SERVICES_CACHE'] = '/tmp/storage/framework/cache/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/storage/framework/cache/packages.php';
$_SERVER['APP_PACKAGES_CACHE'] = '/tmp/storage/framework/cache/packages.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/storage/framework/cache/routes.php';
$_SERVER['APP_ROUTES_CACHE'] = '/tmp/storage/framework/cache/routes.php';
$_ENV['APP_EVENTS_CACHE'] = '/tmp/storage/framework/cache/events.php';
$_SERVER['APP_EVENTS_CACHE'] = '/tmp/storage/framework/cache/events.php';
$_ENV['CACHE_STORE'] = 'array';
$_SERVER['CACHE_STORE'] = 'array';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_SERVER['SESSION_DRIVER'] = 'cookie';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_SERVER['LOG_CHANNEL'] = 'stderr';

putenv('DB_CONNECTION=mysql');
$_ENV['DB_CONNECTION'] = 'mysql';
$_SERVER['DB_CONNECTION'] = 'mysql';

putenv('DB_HOST=gateway01.ap-southeast-1.prod.aws.tidbcloud.com');
$_ENV['DB_HOST'] = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$_SERVER['DB_HOST'] = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';

putenv('DB_PORT=4000');
$_ENV['DB_PORT'] = '4000';
$_SERVER['DB_PORT'] = '4000';

putenv('DB_DATABASE=test');
$_ENV['DB_DATABASE'] = 'test';
$_SERVER['DB_DATABASE'] = 'test';

putenv('DB_USERNAME=3KugKQQueSHLBVh.root');
$_ENV['DB_USERNAME'] = '3KugKQQueSHLBVh.root';
$_SERVER['DB_USERNAME'] = '3KugKQQueSHLBVh.root';

putenv('DB_PASSWORD=zU4oxXXJR6kn6n1Y');
$_ENV['DB_PASSWORD'] = 'zU4oxXXJR6kn6n1Y';
$_SERVER['DB_PASSWORD'] = 'zU4oxXXJR6kn6n1Y';

$caPaths = [
    '/etc/ssl/certs/ca-certificates.crt',
    '/etc/pki/tls/certs/ca-bundle.crt',
    '/etc/ssl/ca-bundle.pem',
    '/etc/ssl/cert.pem',
];
foreach ($caPaths as $path) {
    if (is_file($path)) {
        putenv('MYSQL_ATTR_SSL_CA=' . $path);
        $_ENV['MYSQL_ATTR_SSL_CA'] = $path;
        $_SERVER['MYSQL_ATTR_SSL_CA'] = $path;
        break;
    }
}

require __DIR__ . '/../public/index.php';
