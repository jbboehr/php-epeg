#!/usr/bin/env php
<?php

function runself(array $args = array()) {
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
    $command .= ' ' . join(' ', array_map('escapeshellarg', $args));
    //echo $command, "\n";
    passthru($command);
}

$action = $argc >= 2 ? $argv[1] : null;

$file = __DIR__ . '/tests/fixture3.jpg';
$count = 50;
$w = 512;
$h = 384;
$quality = 75;

switch( $action ) {
    default: {
        printf("Count: %d\n", $count);
        printf("Quality: %d\n", $quality);
        runself(array('gd'));
        runself(array('imagick'));
        runself(array('epeg'));
        break;
    }
    // Benchmark gd
    case 'gd': {
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
        $rusage = getrusage();
        printf("GD: Total: %f\n", $gd_end - $gd_start);
        printf("GD: Avg: %f\n", ($gd_end - $gd_start) / $count);
        printf("GD: Ops/ms: %g\n", $count / ($gd_end - $gd_start) / 1000);
        printf("GD: User Time: %f\n", $rusage['ru_utime.tv_sec'] + ($rusage['ru_utime.tv_usec'] / 1000000));
        file_put_contents('sample_gd.jpg', $gd_buf);
        printf("GD: Wrote sample to: sample_gd.jpg\n");
        break;
    }
    // Benchmark imagick
    case 'imagick': {
        $imagick_start = microtime(true);
        for( $i = 0; $i < $count; $i++ ) {
            $imagick = new Imagick($file);
            $imagick_w = $imagick->getImageWidth();
            $imagick_h = $imagick->getImageHeight();
            //$imagick->resizeImage($w, $h, \Imagick::FILTER_LANCZOS, 1);
            $imagick->scaleImage($w, $h, 1);
            $imagick->setImageCompressionQuality($quality);
            $imagick->stripImage();
            $imagick_buf = $imagick->getImageBlob();
        }
        $imagick_end = microtime(true);
        $rusage = getrusage();
        printf("Imagick: Total: %f\n", $imagick_end - $imagick_start);
        printf("Imagick: Avg: %f\n", ($imagick_end - $imagick_start) / $count);
        printf("Imagick: Ops/ms: %g\n", $count / ($imagick_end - $imagick_start) / 1000);
        printf("Imagick: User Time: %f\n", $rusage['ru_utime.tv_sec'] + ($rusage['ru_utime.tv_usec'] / 1000000));
        file_put_contents('sample_imagick.jpg', $imagick_buf);
        printf("Imagick: Wrote sample to: sample_imagick.jpg\n");
        break;
    }
    // Benchmark epeg
    case 'epeg': {
        $epeg_start = microtime(true);
        for( $i = 0; $i < $count; $i++ ) {
            $epeg = new Epeg($file);
            $epeg->setDecodeSize($w, $h, true);
            $epeg->setQuality($quality);
            $epeg_buf = $epeg->encode();
        }
        $epeg_end = microtime(true);
        $rusage = getrusage();
        printf("Epeg: Total: %f\n", $epeg_end - $epeg_start);
        printf("Epeg: Avg: %f\n", ($epeg_end - $epeg_start) / $count);
        printf("Epeg: Ops/ms: %g\n", $count / ($epeg_end - $epeg_start) / 1000);
        printf("Epeg: User Time: %f\n", $rusage['ru_utime.tv_sec'] + ($rusage['ru_utime.tv_usec'] / 1000000));
        file_put_contents('sample_epeg.jpg', $epeg_buf);
        printf("Epeg: Wrote sample to: sample_epeg.jpg\n");
        break;
    }
}

