<?php

namespace Edev\ChartGen\Common;

use Edev\System\Helpers\Arr;

use function Edev\Chartgen\Helpers\addColor;

class Color 
{
    private $im;
    private static $__instance;
    private $colors = [];

    public static function getInstance() {
        if (!self::$__instance) {
            self::$__instance = new Color();
        }
        return self::$__instance;
    }

    public function setImage($im) {
        $this->im = $im;
    }

    public static function get($color, $alpha = 1) {
        $inst = self::getInstance();
        return $inst->getColor($color, $alpha);
    }

    public static function random() {
        $inst = self::getInstance();
        return $inst->getRandomColor();
    }

    public function getRandomColor() {
        $len = count($this->colors);
        $keys = array_keys($this->colors);
        return $this->colors[$keys[rand(0, $len-1)]];
    }

    public function getColor($color, $alpha) {
        if (!isset($this->colors[$color])) {
            $this->colors[$color] = addColor($this->im, $color, $alpha);
        }
        return $this->colors[$color];
    }

}