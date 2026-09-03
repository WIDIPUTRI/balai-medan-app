<?php $lines = file("storage/logs/laravel.log"); $last = ""; foreach($lines as $l){if(strpos($l, "local.ERROR")!==false) $last=$l;} echo "\n===\n".$last."\n===\n";
