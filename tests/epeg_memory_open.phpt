--TEST--
epeg_memory_open() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$buf = file_get_contents($file);
$epeg = epeg_memory_open($buf);
echo round(strlen(epeg_encode($epeg)) / 100);
?>
--EXPECT--
343