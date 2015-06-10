--TEST--
epeg_thumbnail_comments_enable() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$epeg = epeg_open(__DIR__ . '/fixture1.jpg');
var_dump(epeg_thumbnail_comments_get($epeg));
epeg_thumbnail_comments_enable($epeg, true);
$buf = epeg_encode($epeg);
$epeg2 = epeg_memory_open($buf);
var_dump(epeg_thumbnail_comments_get($epeg2));
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