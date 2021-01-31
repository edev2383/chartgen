<?php

///home/zerodock/public_html
$vendorDir = __DIR__;

// define constants
define('ROOT', $vendorDir . '/src');


$dirs = [
    "Common/Candles",
    "Common/Indicators",
    "Common/Text",
    "Common",
    "Helpers",
    "Core",
];


foreach ($dirs as $dir) {
    foreach (glob(ROOT . "/$dir/*.php") as $filename) {
        include_once($filename);
    }
};