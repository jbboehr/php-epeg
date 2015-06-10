--TEST--
Epeg::setDecodeBounds() method
--SKIPIF--
<?php
include 'skipif_oo.inc';
if (!method_exists('Epeg', 'setDecodeBounds')) {
    die('skip Epeg::setDecodeBounds() is not available');
}
?>
--FILE--
<?php
$file = __DIR__ . '/fixture1.jpg';
$epeg = new Epeg($file);
echo round(strlen($epeg->encode()) / 100), PHP_EOL;
$epeg->setDecodeBounds(0, 0, 50, 50);
echo round(strlen($epeg->encode()) / 100), PHP_EOL;
?>
--EXPECT--
343
15