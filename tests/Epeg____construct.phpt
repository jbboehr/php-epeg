--TEST--
Epeg::__construct() method
--SKIPIF--
<?php include 'skipif_oo.inc'; ?>
--FILE--
<?php
// Try to open a file that does not exist
try {
	var_dump(new Epeg('doesnotexist.jpg'));
} catch( EpegException $e ) {
	echo $e->getMessage(), PHP_EOL;
}
// Try to open a file that does exist
var_dump(new Epeg(__DIR__ . '/fixture1.jpg'));
?>
--EXPECTF--
failed to open stream: doesnotexist.jpg
object(Epeg)#%f (0) {
}
