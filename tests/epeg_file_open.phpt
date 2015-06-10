--TEST--
epeg_file_open() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_file_open($file);
echo round(strlen(epeg_encode($epeg)) / 100);
?>
--EXPECT--
343