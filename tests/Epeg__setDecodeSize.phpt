--TEST--
Epeg::setDecodeSize() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
$epeg->setDecodeSize(80, 80, true);
echo round(strlen($epeg->encode()) / 100);
?>
--EXPECT--
19