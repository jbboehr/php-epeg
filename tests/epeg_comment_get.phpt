--TEST--
epeg_comment_get() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$epeg = epeg_open(__DIR__ . '/fixture2.jpg');
var_dump(epeg_comment_get($epeg));
?>
--EXPECT--
string(22) "this is a test comment"