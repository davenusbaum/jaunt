<?php

use Jaunt\Router;

include 'bootstrap.php';


echo "Loop\n";
$test_mem_start = memory_get_usage ();
$test_time_start = microtime ( true );
for($i=1;$i<1000000;$i++) {
    $list = ['Bob','Mark','Carl'];
    foreach (['Mary','Jon','John','Jane'] as $name) {
        $list[] = $name;
    }
}
echo "Time required = " . (microtime ( true ) - $test_time_start) . " seconds\n";
echo "Memory required = " . sprintf('%.2f',((memory_get_usage () - $test_mem_start)/1048576)) . " MB\n";
echo "\narray_push\n";
$test_mem_start = memory_get_usage ();
$test_time_start = microtime ( true );
for($i=1;$i<1000000;$i++) {
    $list = ['Bob','Mark','Carl'];
    array_push($list,['Mary','Jon','John','Jane']);
}
echo "Time required = " . (microtime ( true ) - $test_time_start) . " seconds\n";
echo "Memory required = " . sprintf('%.2f',((memory_get_usage () - $test_mem_start)/1048576)) . " MB\n";
echo"\narray_merge()\n";
$test_mem_start = memory_get_usage ();
$test_time_start = microtime ( true );
for($i=1;$i<1000000;$i++) {
    $list = ['Bob','Mark','Carl'];
    $list = array_merge($list, ['Mary','Jon','John','Jane']);
}
echo "Time required = " . (microtime ( true ) - $test_time_start) . " seconds\n";
echo "Memory required = " . sprintf('%.2f',((memory_get_usage () - $test_mem_start)/1048576)) . " MB\n";

