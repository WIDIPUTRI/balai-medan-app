<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Try to disable window functions globally
    // Note: tidb_enable_window_function is deprecated in TiDB 4.0+. We can try it anyway.
    DB::statement("SET GLOBAL tidb_enable_window_function = 0");
    echo "Set global tidb_enable_window_function = 0\n";
} catch (\Exception $e) {
    echo "WARNING: " . $e->getMessage() . "\n";
}

try {
    // Also set for current session to test
    DB::statement("SET SESSION tidb_enable_window_function = 0");
} catch (\Exception $e) {
}

try {
    $rank = \DB::select('select rank, COUNT(*) as total from `staff` group by rank');
    echo "SUCCESS: Query with unescaped 'rank' executed successfully!\n";
} catch (\Exception $e) {
    echo "ERROR executing query: " . $e->getMessage() . "\n";
}
