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
	echo $e->getMessage();
}
var_dump(new Epeg(__DIR__ . '/fixture1.jpg'));
?>
--EXPECTF--
object(Epeg)#%d (0) {
}
object(Epeg)#%f (0) {
}
