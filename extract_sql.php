<?php
$in = file_get_contents('d:/2026/DATATHON/balaimedan.sql');
// The inserts might be multi-line. We need to split by semicolon.
$statements = explode(';', $in);
$out = '';
foreach ($statements as $stmt) {
    if (preg_match('/^\s*(INSERT INTO|LOCK TABLES|UNLOCK TABLES)/i', $stmt)) {
        $out .= trim($stmt) . ";\n";
    }
}
file_put_contents('d:/2026/DATATHON/data_only.sql', $out);
echo "Extracted " . strlen($out) . " bytes\n";
