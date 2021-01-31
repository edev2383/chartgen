<?php

namespace Edev\Chartgen\Helpers;

use Edev\ChartGen\Common\Color;
use Edev\System\Helpers\Arr;

function getColor(string $color) {
    switch ($color) {
        case "red":
            return ["r" => 255, "g" => 0, "b" => 0];
        case "white":
            return ["r" => 255, "g" => 255, "b" => 255];
        case "black":
            return ["r" => 0, "g" => 0, "b" => 0];
        case "green":
            return ["r" => 15, "g" => 140, "b" => 0];
        case "blue":
            return ["r" => 5, "g" => 0, "b" => 150];
        case "orange":
            return ["r" => 200, "g" => 75, "b" => 0];
        case "purple":
            return ["r" => 170, "g" => 0, "b" => 204];
        case "pink":
            return ["r" => 255, "g" => 0, "b" => 187];
        case "aqua":
            return ["r" => 0, "g" => 204, "b" => 255];
        case "gold":
            return ["r" => 245, "g" => 255, "b" => 0];
        case "lightgrey":
            return ["r" => 210, "g" => 210, "b" => 225];
        case "lightgray":
            return ["r" => 210, "g" => 210, "b" => 225];
        case "midgrey":
            return ["r" => 110, "g" => 110, "b" => 110];
        case "midgray":
            return ["r" => 110, "g" => 110, "b" => 110];
        case "darkgrey":
            return ["r" => 45, "g" => 45, "b" => 45];
        case "darkgray":
            return ["r" => 45, "g" => 45, "b" => 45];
        default:
            return ["r" => 0, "g" => 255, "b" => 0];
    }
}

function addColor($image, $color, $alpha=1) {
    extract(getColor($color));
    $a = 127 - (127 * $alpha);
    return imagecolorallocatealpha($image, $r, $g, $b, $a);
}

function createText($im, $str, $opts = []) {
    extract ($opts);
    $color = $color ?: "darkgrey";
    $font = boolval($bold) ? 'arialbd' : 'arial';
    $ang = isset($opts['ang']) ? $ang : 0;
    return imagettftext(
        $im,
        $size,
        $ang,
        $x,
        $y,
        Color::get($color),
        $font, 
        $str
    );
}

function calcValCeil($vol) {
    $len = '';
}

function defineIndicatorType($title) {
    $re = '/^(.*?)\(/';
    preg_match($re, $title, $m);
    if (empty($m)) {
        throw new \Exception("Indicator format incorrect [$title]");
    }
    return strtolower($m[1]);
}
