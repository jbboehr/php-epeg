--TEST--
epeg_decode_size_set() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_open($file);
epeg_decode_size_set($epeg, 80, 80, true);
echo round(strlen(epeg_encode($epeg)) / 100);
?>
--EXPECT--
19