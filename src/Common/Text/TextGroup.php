<?php

namespace Edev\ChartGen\Common;

use Edev\ChartGen\Core\ChartGen;

class TextGroup
{
    protected $image;
    protected $chart;
    protected $default;

    public function __construct(ChartGen $chartGen, $image) {
        $this->image = $image;
        $this->chart = $chartGen;
        $this->default = $chartGen->getDefaults();
    }

    public function init() {
        $this->_init();
    }

    protected function _init() {}
}