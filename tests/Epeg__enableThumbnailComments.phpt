--TEST--
Epeg::enableThumbnailComments() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
$epeg = new Epeg(__DIR__ . '/fixture1.jpg');
var_dump($epeg->getThumbnailComments());
$epeg->enableThumbnailComments(true);
$buf = $epeg->encode();
$epeg2 = new Epeg($buf, true);
var_dump($epeg2->getThumbnailComments());
?>
--EXPECTF--
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
array(5) {
  ["uri"]=>
  NULL
  ["mtime"]=>
  int(0)
  ["width"]=>
  int(500)
  ["height"]=>
  int(375)
  ["mimetype"]=>
  string(10) "image/jpeg"
}