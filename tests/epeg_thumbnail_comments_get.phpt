--TEST--
epeg_thumbnail_comments_get() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = epeg_open($file);
var_dump(epeg_thumbnail_comments_get($epeg));
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