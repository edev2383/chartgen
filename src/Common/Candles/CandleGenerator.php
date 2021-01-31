<?php

namespace Edev\ChartGen\Common;

use Edev\ChartGen\Core\ChartGen;

use function Edev\Chartgen\Helpers\addColor;

class CandleGenerator
{
    private $im;
    private $config;
    private $factory;

    public function __construct(ChartGen $chartGen)
    {
        $this->chart = $chartGen;
        $this->_init();
    }
    
    private function _init() {
        $this->im = $this->chart->getImage();
        $this->config = $this->chart->getChartConfig();
        $this->_calculateConfig();
        $this->_createCandles();
    }

    private function _calculateConfig() {
        // get max ceiling
        // get divisor
        // get $/pix
    }

    public function getColors() {
        return $this->colors;
    }

    private function _createCandles() {
        $candle = array_reverse($this->chart->getCandles());
        $len = count($candle);
        for ($ii = 0; $ii < $len; $ii++) {
            $curr = $candle[$ii];
            $pre = $ii > 0 ? $candle[$ii-1] : null;
            $this->config['index'] = $ii;
            new Candle($curr, $pre, $this->im, $this->config);
        }
        if (isset($_GET['__debug'])) {
            die();
        }
    }

}