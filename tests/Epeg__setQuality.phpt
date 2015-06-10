--TEST--
Epeg::setQuality() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
$epeg->setQuality(1);
echo round(strlen($epeg->encode()) / 100);
?>
--EXPECT--
43