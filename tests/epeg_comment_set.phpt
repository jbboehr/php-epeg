--TEST--
epeg_comment_set() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$epeg = epeg_open(__DIR__ . '/fixture1.jpg');
epeg_comment_set($epeg, 'this is another test comment');
$epeg2 = epeg_open(epeg_encode($epeg), true);
var_dump(epeg_comment_get($epeg2));
?>
--EXPECT--
string(28) "this is another test comment"