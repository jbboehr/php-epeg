--TEST--
Epeg::enableThumbnailComments() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$epeg = new Epeg(__DIR__ . '/fixture1.jpg');
$epeg->enableThumbnailComments(true);
var_dump($epeg);
echo 'OK';
?>
--EXPECT--
OK