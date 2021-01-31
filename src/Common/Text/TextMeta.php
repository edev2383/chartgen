<?php

namespace Edev\ChartGen\Common;

use function Edev\Chartgen\Helpers\createText;

class TextMeta extends TextGroup
{
    private $charW = 8.5;
    private $dotW = 3.5;
    private $signW = 4;

    private $leftDataMargin = 8;
    private $leftHeaderMargin = 10;
    private $rM; // right margin

    protected function _init() {
        $this->data = $this->chart->getLastRecord();
        $this->rM = $this->default['DEFAULT_WIDTH'] - $this->default['RIGHT_Y_INDEX_WIDTH'];
        $this->rM = $this->_printChangeData();
        $this->_resetDataColor();
        $this->rM = $this->_printChangeHeader();
        $this->rM = $this->_printCloseData();
        $this->rM = $this->_printCloseHeader();
        $this->rM = $this->_printOpenData();
        $this->rM = $this->_printOpenHeader();
        $this->rM = $this->_printLowData();
        $this->rM = $this->_printLowHeader();
        $this->rM = $this->_printHighData();
        $this->rM = $this->_printHighHeader();
        $this->_printVolume();
    }

    private function _resetDataColor() {
        $this->default['meta_data']['color'] = "darkgrey";

    }

    private function _printChangeData() {
        $color = $this->data['Change'] >= 0 ? 'green' : 'red';
        $str = number_format($this->data['Change'], 2, '.', '');
        $w = ((strlen($str) - 2) * $this->charW) + $this->dotW + $this->signW;

        $this->default['meta_data']['color'] = $color;
        $this->default['meta_data']['x'] = $this->rM - $w;
        return createText($this->image, $str, $this->default['meta_data'])[0];
    }

    private function _printChangeHeader() {
        $w = 17; // determined through repetitive testing
        $this->default['meta_header']['x'] = $this->rM - $w - $this->leftDataMargin;
        return createText($this->image, '+/-: ', $this->default['meta_header'])[0];
    }

    private function _printCloseData() {
        $str = number_format($this->data['Adj Close'], 2, '.', '');
        $w = ((strlen($str) - 1) * $this->charW) + $this->dotW;
        $this->default['meta_data']['color'] = "darkgrey";
        $this->default['meta_data']['x'] = $this->rM - $w - $this->leftHeaderMargin;
        return createText($this->image, $str, $this->default['meta_data'])[0];
    }

    private function _printCloseHeader() {
        $w = 34; // determined through repetitive testing
        $this->default['meta_header']['x'] = $this->rM - $w - $this->leftDataMargin;
        return createText($this->image, 'Close: ', $this->default['meta_header'])[0];
    }
    
    private function _printOpenData() {
        $str = number_format($this->data['Open'], 2, '.', '');
        $w = ((strlen($str) - 1) * $this->charW) + $this->dotW;
        $this->default['meta_data']['x'] = $this->rM - $w - $this->leftHeaderMargin;
        return createText($this->image, $str, $this->default['meta_data'])[0];
    }
    private function _printOpenHeader() {
        $w = 32; // determined through repetitive testing
        $this->default['meta_header']['x'] = $this->rM - $w - $this->leftDataMargin;
        return createText($this->image, 'Open: ', $this->default['meta_header'])[0];
    }
    private function _printLowData() {
        $str = number_format($this->data['Low'], 2, '.', '');
        $w = ((strlen($str) - 1) * $this->charW) + $this->dotW;
        $this->default['meta_data']['x'] = $this->rM - $w - $this->leftHeaderMargin;
        return createText($this->image, $str, $this->default['meta_data'])[0];
    }
    private function _printLowHeader() {
        $w = 25; // determined through repetitive testing
        $this->default['meta_header']['x'] = $this->rM - $w - $this->leftDataMargin;
        return createText($this->image, 'Low: ', $this->default['meta_header'])[0];
    }
    private function _printHighData() {
        $str = number_format($this->data['High'], 2, '.', '');
        $str = number_format(3089, 2, '.', '');
        $w = ((strlen($str) - 1) * $this->charW) + $this->dotW;
        $this->default['meta_data']['x'] = $this->rM - $w - $this->leftHeaderMargin;
        return createText($this->image, $str, $this->default['meta_data'])[0];
    }
    private function _printHighHeader() {
        $w = 27; // determined through repetitive testing
        $this->default['meta_header']['x'] = $this->rM - $w - $this->leftDataMargin;
        return createText($this->image, 'High: ', $this->default['meta_header'])[0];
    }
    private function _printVolume() {
        return createText($this->image, 'Vol: ' . $this->data['Volume'], $this->default['volume']);
    }
}