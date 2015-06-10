--TEST--
epeg_trim() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_open($file);
epeg_decode_bounds_set($epeg, 0, 0, 50, 50);
echo round(strlen(epeg_trim($epeg)) / 100), PHP_EOL;
?>
--EXPECT--
14