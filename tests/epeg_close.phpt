--TEST--
epeg_close() function
--SKIPIF--
<?php include 'skipif.inc'; ?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$res = epeg_open($file);
var_dump(epeg_close($res));
?>
--EXPECT--
NULL