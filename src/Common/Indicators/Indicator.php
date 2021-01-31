<?php

namespace Edev\ChartGen\Common\Indicator;

class Indicator {

    protected $title, $data, $type, $orientation, $config, $color;
    
    public function __construct($title, $data, $color = null)
    {
        $this->color = $color;
        $this->title = $title;
        $this->data = array_reverse(array_values($data));
    }

    public function init() {
        $this->_init();
    }

    public function setImageHandler($img) {
        $this->image = $img;
    }

    public function setConfig($config) {
        $this->config = $config;
    }

    private function _init() {
        $this->_draw();
    }

    protected function _draw() {
    }
}