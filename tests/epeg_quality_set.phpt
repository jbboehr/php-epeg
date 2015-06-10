--TEST--
epeg_quality_set() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_open($file);
epeg_quality_set($epeg, 1);
echo round(strlen(epeg_encode($epeg)) / 100);
?>
--EXPECT--
43