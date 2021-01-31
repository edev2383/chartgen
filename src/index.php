<?php

use Edev\ChartGen\Common\CandleDataFormatter;
use Edev\ChartGen\Common\Indicator\IndicatoryGroup;
use Edev\ChartGen\Core\ChartGen;
use Edev\System\Helpers\Arr;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '64M');
putenv('GDFONTPATH=' . realpath('.'));
include('../autoload.php');
include('../../framework/src/System/Helpers/arrayHelpers.php');

try{

    $file = "/var/www/edickdev/cgi-bin/py/chartgen/chartgen.py";
    $command = "sudo python3";
    $args = [];
    $args[] = isset($_GET['range']) ? ' -r ' . strtolower($_GET['range']) : '';
    $args[] = isset($_GET['ticker']) ? ' -t ' . strtoupper($_GET['ticker']) : '';
    
    $data = json_decode(shell_exec("$command $file" . implode(" ", $args)), true);
    
    $chart = json_decode($data["data"], true);
    $inds = json_decode($data["indicators"], true);
    
    $lastRecordKeys = $chart['columns'];
    $data["last_record"] = array_combine($lastRecordKeys, $chart["data"][0]);
    $data["indicators"] = $inds;
    $data["chart"] = $chart;
    $data["candle_data"] = CandleDataFormatter::process($data["chart"]);
    $data["meta"] = [
        "candleCount" => count($chart["index"]),
        "frequency" => "daily",
        "max" => number_format(max(array_column($data['candle_data'], 'High')), 2, '.', ''),
        "min" => number_format(min(array_column($data['candle_data'], 'Low')), 2, '.', ''),
        "volume_max" => max(array_column($data['candle_data'], 'Volume')),
        "volume_min" => min(array_column($data['candle_data'], 'Volume')),
    ];
    
    $chart = new ChartGen($data, []);

    $chart->render();
    // $w = $w ?: $CHARTGEN['DEFAULT_WIDTH'];
    // // Create the size of image or blank image 
    // $image = imagecreate($w, $w / 1.618); 
    
    // // Set the background color of image 
    // $background_color = imagecolorallocate($image, $CHARTGEN['BG_R'], $CHARTGEN['BG_G'], $CHARTGEN['BG_B']); 

    // $text_color = imagecolorallocate($image,  $text_color_rbg["r"], $text_color_rbg["g"], $text_color_rbg["b"]);
    
    // // Function to create image which contains string. 
    // imagestring($image, 2, 10, 10, 'TESTING', $text_color);
    // imagestring($image, 5, 10, 10, 'TESTING', $text_color);
    // imagestring($image, 5, 180, 100,  "GeeksforGeeks", $text_color); 
    // imagestring($image, 3, 160, 120,  "A computer science portal", $text_color); 
    
    // header("Content-Type: image/png"); 
    
    // imagepng($image); 
    // imagedestroy($image); 
} catch (\Exception $e) {
    echo $e->getMessage();
}
  
?> 