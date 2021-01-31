<?php

namespace Edev\ChartGen\Core;

use Edev\ChartGen\Common\CandleGenerator;
use Edev\ChartGen\Common\ChartGrid;
use Edev\ChartGen\Common\ChartLayout;
use Edev\ChartGen\Common\TextGrid;
use Edev\System\Helpers\Arr;
use Edev\ChartGen\Common\Color;
use Edev\ChartGen\Common\Indicator\IndicatorGroup;

use function Edev\Chartgen\Helpers\addColor;
use function Edev\Chartgen\Helpers\calcValCeil;

class ChartGen
{
    
    // candle variables
    protected $bar_width = 8;
    protected $bar_space = 2;
    protected $downdown_bar_fill = "red";
    protected $downdown_bar_line = "red";
    protected $upup_bar_fill = "white";
    protected $upup_bar_line = "black";
    protected $downup_bar_fill = "white";
    protected $downup_bar_line = "red";
    protected $updown_bar_fill = "black";
    protected $updown_bar_line = "black";
    protected $bar_line_width = "2";
    
    // data props
    protected $data;
    protected $options;

    // image handler variables set at construct time
    protected $imageWidth;
    protected $imageHeight;
    protected $textColor;
    protected $backgroundColor;

    // image handler
    protected $image;

    protected $default;

    private $chartConfig = [];

    public function __construct($chartData, $chartOptions = [])
    {
        $this->data = $chartData;
        $this->options = $chartOptions;
        $this->_init();
    }

    public function getCandles() {
        return $this->data['candle_data'];
    }

    public function getChartConfig() {
        return $this->chartConfig;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDefaults() {
        return $this->default;
    }

    public function getDims() {
        return ['width' => $this->imageWidth, 'height' => $this->imageHeight];
    }

    protected function _init() {
        $this->_importDefaults();
        $this->_initializeOptions();
        $this->_setChartConfig();
        $this->_createImageHandler();
        $this->_seedColors();
        $this->_createChartLayout();
        $this->_generateCandles();
        $this->_generateIndicators();
        $this->_createTextGrid();
    }

    private function _generateIndicators(){
        return new IndicatorGroup($this->data['indicators'], $this);
    }

    private function _seedColors() {
        Color::getInstance()->setImage($this->image);
        Color::get("lightgrey");
    }

    private function _generateCandles() {
        return new CandleGenerator($this);
    }

    private function _setChartConfig() {
        $ceil = ceil($this->data['meta']['max']/10) * 10;
        $floor= floor($this->data['meta']['min'] - ($this->data['meta']['min'] % 10));
        $this->chartConfig['ceil'] = $ceil;
        $this->chartConfig['floor'] = $floor;
        $this->chartConfig['rangeSize'] = $ceil - $floor;
        $this->chartConfig['workingCanvas'] = $this->imageHeight - $this->default['HEADER_HEIGHT'] - $this->default['BOTTOM_X_INDEX_HEIGHT'];
        $this->chartConfig['dolperpix'] = $this->chartConfig['rangeSize'] / $this->chartConfig['workingCanvas'];
        // includes margin
        $this->chartConfig['spacePerCandle'] = ($this->imageWidth - $this->default['RIGHT_Y_INDEX_WIDTH'] - $this->default['LEFT_Y_INDEX_WIDTH']) / $this->data['meta']['candleCount'];
        $this->chartConfig['originX'] = $this->default['LEFT_Y_INDEX_WIDTH'];
        $this->chartConfig['index'] = 0;
        $this->chartConfig['originY'] = $this->imageHeight - $this->default['BOTTOM_X_INDEX_HEIGHT'];
        $this->_calcConfigVolume();
        
    }

    private function _calcConfigVolume() {
        $this->chartConfig['volume_canvas_height'] = $this->chartConfig['workingCanvas'] * $this->default['VOLUME_HEIGHT_RATIO'];
        $this->chartConfig['volume_max_y'] = $this->default['BOTTOM_X_INDEX_HEIGHT'] + $this->chartConfig['volume_canvas_height'];
        $this->chartConfig['volume_max_y_value'] = calcValCeil($this->data['meta']['volume_max']);
    }
    private function _createTextGrid() {
        return new TextGrid($this, $this->image);
    }

    public function render() {
        header("Content-Type: image/jpeg"); 
        imagepng($this->image); 
        imagedestroy($this->image); 
    }

    public function getSymbol() {
        return strtoupper($this->data['symbol']);
    }

    public function getLastRecord() {
        return $this->data["last_record"];
    }

    protected function _createChartLayout() {
        $this->chartLayout =  new ChartGrid($this, $this->image);
    }

    private function _importDefaults() {
        $this->default = include('../config.php');
    }

    private function _createImageHandler() {
        $this->image = imagecreate($this->imageWidth, $this->imageHeight);
    }

    private function _initializeOptions() {
        $this->imageWidth = round($this->_getImageWidth());
        $this->imageHeight = round($this->imageWidth / $this->default['VIEWPORT_RATIO']);        
    }

    private function _getImageWidth() {
        return isset($this->options['width']) 
            ? $this->options['width']
            : $this->default['DEFAULT_WIDTH'];
    }
}