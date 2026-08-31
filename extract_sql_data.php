<?php
$sql = file_get_contents(__DIR__ . '/balaimedan.sql');

// Remove all DDL statements
$sql = preg_replace('/CREATE DATABASE.*?;/is', '', $sql);
$sql = preg_replace('/USE `?balaimedan`?;/is', '', $sql);
$sql = preg_replace('/DROP TABLE.*?;/is', '', $sql);
$sql = preg_replace('/CREATE TABLE.*?;/is', '', $sql);
$sql = preg_replace('/ALTER TABLE.*?;/is', '', $sql);

// Save this clean dump containing only INSERTs
file_put_contents(__DIR__ . '/balaimedan_data_only.sql', $sql);
echo "Cleaned SQL dump created!\n";
