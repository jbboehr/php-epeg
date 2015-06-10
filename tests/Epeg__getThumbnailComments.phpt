--TEST--
Epeg::getThumbnailComments() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
var_dump($epeg->getThumbnailComments());
?>
--EXPECT--
array(5) {
  ["uri"]=>
  NULL
  ["mtime"]=>
  int(0)
  ["width"]=>
  int(0)
  ["height"]=>
  int(0)
  ["mimetype"]=>
  NULL
}