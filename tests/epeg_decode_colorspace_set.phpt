--TEST--
epeg_decode_colorspace_set() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_open($file);
epeg_decode_colorspace_set($epeg, EPEG_CMYK);
echo round(strlen(epeg_encode($epeg)) / 100);
?>
--EXPECTF--
Warning: epeg_encode(): Failed to decode image in %s on line %d
0