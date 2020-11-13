--TEST--
epeg_open() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
var_dump(epeg_open(__DIR__ . '/fixture1.jpg'));
var_dump(epeg_open('doesnotexist.jpg'));
?>
--EXPECTF--
resource(%d) of type (epeg)

Warning: epeg_open(doesnotexist.jpg): %sailed to open stream: No such file or directory in %s on line %d
bool(false)
