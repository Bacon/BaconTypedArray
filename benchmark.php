<?php
require_once 'autoload_register.php';

echo "Typed array:\n";

$startTime   = microtime(true);
$startMemory = memory_get_usage();

$array = new BaconTypedArray\Int32Array();
for ($i = 0; $i < 10000; $i++) {
    $array[] = $i;
}

echo memory_get_usage() - $startMemory, " bytes\n";
echo microtime(true) - $startTime, " seconds\n";

echo "\nStandard array:\n";

$startTime   = microtime(true);
$startMemory = memory_get_usage();

$array = array();
for ($i = 0; $i < 10000; $i++) {
    $array[] = $i;
}

echo memory_get_usage() - $startMemory, " bytes\n";
echo microtime(true) - $startTime, " seconds\n";
