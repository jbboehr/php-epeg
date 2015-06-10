--TEST--
epeg_size_get() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_open($file);
var_dump(epeg_size_get($epeg));
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