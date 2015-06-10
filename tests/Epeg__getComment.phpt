--TEST--
Epeg::getComment() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$epeg = new Epeg(__DIR__ . '/fixture2.jpg');
var_dump($epeg->getComment());
?>
--EXPECT--
string(22) "this is a test comment"