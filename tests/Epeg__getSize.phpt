--TEST--
Epeg::getSize() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
var_dump($epeg->getSize());
?>
--EXPECT--
array(4) {
  [0]=>
  int(500)
  [1]=>
  int(375)
  ["width"]=>
  int(500)
  ["height"]=>
  int(375)
}