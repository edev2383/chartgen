<?php

namespace Edev\ChartGen\Common;

use Edev\System\Helpers\Arr;

use function Edev\Chartgen\Helpers\addColor;

class Candle
{

    protected $im;
    protected $config;
    protected $curr;
    protected $pre;

    protected $fill;
    protected $line;

    public function __construct($curr, $prev, $im, $config)
    {
        $this->curr = $curr;
        $this->prev = $prev;
        $this->im = $im;
        $this->config = $config;
        $this->default = include('../config.php');
        $this->_init();
    }

    private function _init() {
        $this->_setColorPalette();
        $this->_createVolumeBar();
        $this->_createWick();
        $this->_createBody();
    }

    private function _createVolumeBar() {

    }

    private function _setColorPalette() {
        $primary = $this->_getPrimaryDiff(); // $this->curr['Change'] >= 0 ? 'UP' : 'DOWN';
        $secondary = $this->_getSecondaryDiff();
        $this->volumeColor = $this->default['VOLUME_' . $primary . '_COLOR'];
        $this->fill = $this->default["CANDLE_FILL_$primary$secondary"];
        $this->line = $this->default["CANDLE_LINE_$primary$secondary"];
    }

    private function _getPrimaryDiff() {
        if (is_null($this->prev)) {
            return $this->curr['Change'] >= 0 ? 'UP' : 'DOWN'; 
        }
        return $this->curr['Close'] > $this->prev['Close'] ? 'UP' : 'DOWN';
    }

    private function _getSecondaryDiff() {
        return $this->curr['Close'] > $this->curr['Open'] ? 'UP' : 'DOWN';
    }


    private function _createWick() {
        $index = $this->config['index'] ;
        $originX = $this->config['originX'];
        $originY = $this->config['originY'];
        $wickY1 = $originY - ( ($this->curr['Low'] - $this->config['floor'] ) / $this->config['dolperpix'] );
        $wickY2 = $originY - ( ($this->curr['High'] - $this->config['floor'] ) / $this->config['dolperpix'] );
        $width = $this->config['spacePerCandle'];
        $wickX = $originX + ($index * $width) + $width/2;
        imageline($this->im, $wickX, $wickY1, $wickX, $wickY2, Color::get($this->line));
    }

    private function _createBody() {
        $index = $this->config['index'];
        $bodyX = $this->config['originX'];
        $bodyY = $this->config['originY'];
        $width = $this->config['spacePerCandle'];
        $x1 = $bodyX  + ($index * $width);
        $y1 = $bodyY - ( ($this->curr['Close'] - $this->config['floor'] ) / $this->config['dolperpix'] );
        $x2 = $bodyX + ($index * $width) + $width;
        $y2 = $bodyY - ( ($this->curr['Open'] - $this->config['floor'] ) / $this->config['dolperpix'] );
        imagefilledrectangle($this->im, $x1, $y1, $x2, $y2, Color::get($this->fill));
        imagerectangle($this->im, $x1, $y1, $x2, $y2, Color::get($this->line));
    }
}