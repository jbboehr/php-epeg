--TEST--
Epeg::encode() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
echo round(strlen($epeg->encode()) / 100);
?>
--EXPECT--
343