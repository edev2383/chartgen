<?php 

namespace Edev\ChartGen\Common\Indicator;

use Edev\ChartGen\Common\Color;

class MovingAverage extends Indicator{
    
    protected function _draw() {
        imagesetthickness($this->image, 2);
        imageantialias($this->image, true);
        $cnt = count($this->data); 
        for ($ii = 0; $ii < $cnt; $ii++) {
            [$x1, $y1, $x2, $y2] = $this->_generateCoords($ii); 
            if (!is_null($y1)){
                imageline($this->image, $x1, $y1, $x2, $y2, $this->color);
            }
        }
    }

    private function _generateCoords($index) {
        [$x1, $x2] = $this->_generateX($index);
        [$y1, $y2] = $this->_generateY($index);
        return [$x1, $y1, $x2, $y2];
    }

    private function _generateX($index) {
        $oX = $this->config['originX'];
        return [
            $oX + ($this->config['spacePerCandle'] * ($index + 1)),
            $oX + ($this->config['spacePerCandle'] * ($index + 2))
        ];
    }

    /**
     * Generate y1 and y2 values to create line segment
     *
     * @param int $index
     * @return array
     */
    private function _generateY($index) {
        $oY = $this->config['originY'];
        $v1 = $this->data[$index];

        // ignore 0 values
        if ($v1 == 0) {
            return [null, null];
        }

        // while index is below length of data, return the next data pt
        // hacky short circut is when not true, return $v1 so then...
        $v2 = $index < count($this->data) - 1 ? $this->data[$index + 1] : $v1;

        // ...if they are equal, short circuit
        if ($v2 == $v1) {
            return [null, null];
        }

        // the actual magic. account for floor and origin values, then
        // divide by dolperpix
        return [
            $oY - (($v1 - $this->config['floor']) / $this->config['dolperpix']),
            $oY - (($v2 - $this->config['floor']) / $this->config['dolperpix']),
        ];
    }
}