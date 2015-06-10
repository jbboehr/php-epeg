--TEST--
Epeg::setDecodeColorSpace() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
$epeg->setDecodeColorSpace(EPEG_CMYK);
echo round(strlen($epeg->encode()) / 100);
?>
--EXPECTF--
Warning: Epeg::encode(): Failed to decode image in %s
0