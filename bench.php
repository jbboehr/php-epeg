#!/usr/bin/env php
<?php

// Try to disable xdebug >.>
if( extension_loaded('xdebug') ) {
    echo "Xdebug is loaded, trying to re-run with bare configuration\n";
    // Find the json and handlebars modules
    $command = 'php -n -d display_errors=On -d error_reporting=E_ALL ';
    $extensionDir = ini_get('extension_dir');
    if( file_exists($extensionDir . '/epeg.so') ) {
        $command .= "-d 'extension=" . $extensionDir . "/epeg.so' ";
    }
    if( file_exists($extensionDir . '/imagick.so') ) {
        $command .= "-d 'extension=" . $extensionDir . "/imagick.so' ";
    }
    if( file_exists($extensionDir . '/gd.so') ) {
        $command .= "-d 'extension=" . $extensionDir . "/gd.so' ";
    }
    $command .= ' ' . __FILE__;
    //echo $command, "\n";
    passthru($command);
    exit(0);
}

$file = __DIR__ . '/tests/fixture3.jpg';
$count = 50;
$w = 302;
$h = 170;
$quality = 75;

printf("Count: %d\n", $count);
printf("Quality: %d\n", $quality);

// Benchmark gd
$gd_start = microtime(true);
for( $i = 0; $i < $count; $i++ ) {
    $gd = imagecreatefromjpeg($file);
    list($gd_w, $gd_h) = getimagesize($file);
    $gd_p = imagecreatetruecolor($w, $h);
    imagecopyresampled($gd_p, $gd, 0, 0, 0, 0, $w, $h, $gd_w, $gd_h);
    ob_start();
    imagejpeg($gd_p, null, $quality);
    $gd_buf = ob_get_clean();
}
$gd_end = microtime(true);
printf("GD: Total: %f\n", $gd_end - $gd_start);
printf("GD: Avg: %f\n", ($gd_end - $gd_start) / $count);
printf("GD: Ops/ms: %g\n", $count / ($gd_end - $gd_start) / 1000);
file_put_contents('sample_gd.jpg', $gd_buf);
printf("GD: Wrote sample to: sample_gd.jpg\n");

// Benchmark imagick
$imagick_start = microtime(true);
for( $i = 0; $i < $count; $i++ ) {
    $imagick = new Imagick($file);
    $imagick_w = $imagick->getImageWidth();
    $imagick_h = $imagick->getImageHeight();
    $imagick->resizeImage($w, $h, \Imagick::FILTER_LANCZOS, 1);
    $imagick->setCompressionQuality($quality);
    $imagick->stripImage();
    $imagick_buf = $imagick->getImageBlob();
}
$imagick_end = microtime(true);
printf("Imagick: Total: %f\n", $imagick_end - $imagick_start);
printf("Imagick: Avg: %f\n", ($imagick_end - $imagick_start) / $count);
printf("Imagick: Ops/ms: %g\n", $count / ($imagick_end - $imagick_start) / 1000);
file_put_contents('sample_imagick.jpg', $imagick_buf);
printf("Imagick: Wrote sample to: sample_imagick.jpg\n");

// Benchmark epeg
$epeg_start = microtime(true);
for( $i = 0; $i < $count; $i++ ) {
    $epeg = new Epeg($file);
    $epeg->setDecodeSize($w, $h, true);
    $epeg->setQuality($quality);
    $epeg_buf = $epeg->encode();
}
$epeg_end = microtime(true);
printf("Epeg: Total: %f\n", $epeg_end - $epeg_start);
printf("Epeg: Avg: %f\n", ($epeg_end - $epeg_start) / $count);
printf("Epeg: Ops/ms: %g\n", $count / ($epeg_end - $epeg_start) / 1000);
file_put_contents('sample_epeg.jpg', $epeg_buf);
printf("Epeg: Wrote sample to: sample_epeg.jpg\n");


