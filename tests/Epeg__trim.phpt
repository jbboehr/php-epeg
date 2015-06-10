--TEST--
Epeg::trim() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
$epeg->setDecodeBounds(0, 0, 50, 50);
echo round(strlen($epeg->trim()) / 100), PHP_EOL;
?>
--EXPECT--
14