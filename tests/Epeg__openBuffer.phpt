--TEST--
Epeg::openBuffer() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$buf = file_get_contents($file);
$epeg = Epeg::openBuffer($buf);
echo round(strlen($epeg->encode()) / 100);
?>
--EXPECT--
343