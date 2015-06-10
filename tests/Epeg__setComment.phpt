--TEST--
Epeg::setComment() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$epeg = new Epeg(__DIR__ . '/fixture1.jpg');
$epeg->setComment('this is a test comment');
$buf = $epeg->encode();
$epeg2 = new Epeg($buf, true);
var_dump($epeg2->getComment());
?>
--EXPECT--
string(22) "this is a test comment"