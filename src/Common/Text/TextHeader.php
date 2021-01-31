<?php

namespace Edev\ChartGen\Common;

use function Edev\Chartgen\Helpers\createText;

class TextHeader extends TextGroup
{

    protected function _init() {
        $this->_createHeaderSymbol();
        $this->_createHeaderDate();
        $this->_createDateRow();
    }

    private function _createHeaderSymbol() {
        createText(
            $this->image, 
            $this->chart->getSymbol(), 
            $this->default['symbol'] 
        );
    }

    private function _createHeaderDate() {
        $rec = $this->chart->getLastRecord();
        $date = round($rec['Date']/1000);
        createText(
            $this->image, 
            date("m/d/Y", $date), 
            $this->default['date']
        );
    }

    private function _createDateRow() {
        createText(
            $this->image, 
            '5',
            $this->default['daterow']
        );
    }
}