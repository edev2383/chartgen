<?php

namespace Edev\ChartGen\Common;

use function Edev\Chartgen\Helpers\addColor;

class TextNode
{
    public static function create($image, string $text, int $x, int $y, int $fontsize, $bold = false) {
        $font = boolval($bold) ? 'arialbd': 'arial';
        imagettftext(
            $image, 
            $fontsize, 
            0, 
            $x, 
            $y, 
            addColor($image, "darkgrey"), 
            $font, 
            $text);
        // imagestring($image, $fontsize, $x, $y, $text, addColor($image, "darkgrey"));
    }
}