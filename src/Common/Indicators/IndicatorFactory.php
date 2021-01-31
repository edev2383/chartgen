<?php

namespace Edev\ChartGen\Common\Indicator;

use function Edev\Chartgen\Helpers\defineIndicatorType;

class IndicatorFactory{

    public static function create($title, $data, $color){
        switch(defineIndicatorType($title)){
            case 'sma':
                return new MovingAverage($title, $data, $color);
            case 'ema':
                return new MovingAverage($title, $data, $color);
            case 'rsi':
                return new RelativeStrengthIndex($title, $data);
            case 'slosto':
                return new SlowStochastic($title, $data);
        }
    }
}