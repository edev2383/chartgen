<?php

namespace Edev\ChartGen\Common;

class CandleDataFormatter
{

    private $chartData;

    public static function process($chartData) {
        return (new static)->_process($chartData);
    }

    private function _process($chartData) {
        $this->chartData = $chartData;
        return $this->_reindexCandles();
        // print_r($this);
    }

    private function _reindexCandles() {
        $c = [];
        foreach ($this->chartData['data'] as $candle) {
            $tmp = array_combine($this->chartData['columns'], $candle);
            $rawdate = round($tmp["Date"]/1000);
            $tmp["day"] = date("d", $rawdate);
            $tmp["month"] = date("m", $rawdate);
            $tmp["year"] = date("y", $rawdate);
            $tmp["print_date"] = date("m/d/y", $rawdate);
            $c[] = $tmp;
        }
        return $c;
    }
}