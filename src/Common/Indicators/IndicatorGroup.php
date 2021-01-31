<?php

namespace Edev\ChartGen\Common\Indicator;

use Edev\ChartGen\Common\Color;
use Edev\ChartGen\Core\ChartGen;
use Edev\System\Helpers\Arr;

use function Edev\Chartgen\Helpers\defineIndicatorType;

class IndicatorGroup {

    private $indicators = [];
    private $rawData;
    private $chart;
    private $colors ;

    public function __construct($rawIndicatorArray, ChartGen $chartGen)
    {
        
        $this->rawData = $rawIndicatorArray;
        $this->chart = $chartGen;
        if (isset($_GET['debug'])) {
            // Arr::pre($this);
            Arr::pre(Color::getInstance());
            die();
        }
        $this->_init();
    }

    private function _setColors(){
        $this->colors = [
            Color::get('pink'),
            Color::get('aqua'),
            Color::get('blue'),
            Color::get('black'),
            Color::get('purple'),
            Color::get('orange'),
            Color::get('green'),
            Color::get('gold'),
            Color::get('red'),
        ];
    }

    private function _init() {
        $this->_setColors();
        $this->_calculateCanvasOverlayData();
        $this->_processRawData();
    }

    private function _calculateCanvasOverlayData(){
        $this->canvasData = $this->chart->getChartConfig();
    }

    private function _processRawData() {
        $cnt = count($this->rawData['columns']);
        for ($ii = 0; $ii < $cnt; $ii++){
            $this->addIndicator(
                IndicatorFactory::create(
                    $this->rawData['columns'][$ii], 
                    $this->_getData($ii),
                    $this->colors[$ii % count($this->colors)]
                    )
            );
        }
    }

    public function addIndicator(Indicator $ind){
        $ind->setImageHandler($this->chart->getImage());
        $ind->setConfig($this->chart->getChartConfig());
        $ind->init();
        $this->add($ind);
    }

    private function _getData($index){
        return array_combine(
            array_column($this->rawData['index'], 1),
            array_column($this->rawData['data'], $index)
        );
    }

    private function add(Indicator $indicator) {
        $this->indicators[] = $indicator;
    }

    public function get() {
        return $this->indicators;
    }
}