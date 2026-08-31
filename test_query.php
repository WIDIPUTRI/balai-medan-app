<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $rank = \App\Models\Staff::selectRaw('`rank`, COUNT(*) as total')
        ->groupBy('rank')
        ->pluck('total', 'rank');
    dump($rank);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
