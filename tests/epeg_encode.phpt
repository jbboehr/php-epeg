--TEST--
epeg_encode() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_open($file);
echo round(strlen(epeg_encode($epeg)) / 100);
?>
--EXPECT--
343