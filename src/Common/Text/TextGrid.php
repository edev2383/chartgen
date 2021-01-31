<?php

namespace Edev\ChartGen\Common;

use \Edev\ChartGen\Core\ChartGen;

use function Edev\Chartgen\Helpers\createText;

class TextGrid
{

    public function __construct(ChartGen $chartGen, $image) {
        $this->_init($chartGen, $image);
    }

    private function _init($chartGen, $image) {
        $this->_buildHeader($chartGen, $image); 
        $this->_buildMeta($chartGen, $image);  
    }

    private function _buildHeader($chartGen, $image) {
        $header = new TextHeader($chartGen, $image);
        return $header->init();
    }

    private function _buildMeta($chartGen, $image) {
        $meta = new TextMeta($chartGen, $image);
        return $meta->init();
    }

}