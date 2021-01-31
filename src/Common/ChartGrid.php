<?php

namespace Edev\ChartGen\Common;

use Edev\ChartGen\Core\ChartGen;

use function Edev\Chartgen\Helpers\addColor;

class ChartGrid
{
    protected $chart;
    protected $image;

    protected $yZero;
    protected $yMax;
    protected $xZero;
    protected $xMax;

    protected $verticalOrigin = 0;
    protected $horizontalOrigin = 0;

    protected $vertexColor;

    protected $viewPortWidth;
    protected $viewPortHeight;

    public function __construct(ChartGen $chartGen, $imageHandler)
    {
        $this->chart = $chartGen;
        $this->image = $imageHandler;
        $this->default = $chartGen->getDefaults();
        $this->_init();
    }

    private function _init() {
        $this->_setOriginPoints();
        $this->_setViewPort();
        $this->_createLeftVerical();
        $this->_createRightVertical();
        $this->_createTopHorizontal();
        $this->_createBottomHorizontal();
        if (isset($_GET['xo'])) {
            $this->_createPlacementOverlayGridX();
        }
        if (isset($_GET['yo'])) {
            $this->_createPlacementOverlayGridY();
        }
    }

    private function _createPlacementOverlayGridX() {
        $origin = 0; 
        $span = isset($_GET['grid']) ? $_GET['grid'] : 10;
        $im = $this->image;
        extract($this->chart->getDims());
        while ($origin < $height){
            imageline($im, 0, $origin, $width, $origin, addColor($im, "midgrey"));
            $origin += $span;
        }
    }
    private function _createPlacementOverlayGridY() {
        $origin = 0; 
        $span = isset($_GET['grid']) ? $_GET['grid'] : 10;
        $im = $this->image;
        extract($this->chart->getDims());
        while ($origin < $width){
            imageline($im, $origin, 0, $origin, $width, addColor($im, "midgrey"));
            $origin += $span;
        }
    }

    private function _setViewPort() {
        extract($this->chart->getDims());
        $hMargin = $this->default['RIGHT_Y_INDEX_WIDTH'] + $this->default['LEFT_Y_INDEX_WIDTH'];
        $vMargin = $this->default['HEADER_HEIGHT'] + $this->default['BOTTOM_X_INDEX_HEIGHT'];
        $this->viewPortWidth = $width - $hMargin;
        $this->viewPortHeight = $height - $vMargin;
    }

    private function _setOriginPoints() {
        extract($this->chart->getDims());
        $this->yZero = $this->verticalOrigin + $this->default['HEADER_HEIGHT'];
        $this->yMax = $height - $this->default['BOTTOM_X_INDEX_HEIGHT'];
        $this->xZero = $this->horizontalOrigin + $this->default['LEFT_Y_INDEX_WIDTH'];
        $this->xMax = $width - $this->default['RIGHT_Y_INDEX_WIDTH'];
        $this->vertexColor = addColor($this->image, $this->default['VERTEX_COLOR']);
    }

    private function _createLeftVerical() {
        return imageline(
            $this->image, 
            $this->xZero,
            $this->yZero,
            $this->xZero, 
            $this->yMax,
            $this->vertexColor,
        );
    }
    
    private function _createRightVertical() {
        return imageline(
            $this->image, 
            $this->xMax,
            $this->yZero,
            $this->xMax, 
            $this->yMax,
            $this->vertexColor,
        );
    }
    
    private function _createTopHorizontal() {
        return imageline(
            $this->image, 
            $this->xZero,
            $this->yZero,
            $this->xMax, 
            $this->yZero,
            $this->vertexColor,
        );
    }
    
    private function _createBottomHorizontal() {
        return imageline(
            $this->image, 
            $this->xZero,
            $this->yMax,
            $this->xMax, 
            $this->yMax,
            $this->vertexColor,
        );
    }
}