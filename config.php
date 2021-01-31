<?php

$secondaryHeaderRowYOrigin = 28;
$metaDataNodeWidth = 90;
$metaHeaderFontSize = 10;
$metaDataFontSize = 11;
$metaDataBold = true;
$metaHeaderBold = false;
$metaHeaderColor = "darkgrey";
$metaDataColor = "black";
$defaultWidth = isset($_GET['w']) ? $_GET['w'] : 900;
$metaHeaderOrigin = $defaultWidth - 490;
return [
    'DEFAULT_WIDTH' => $defaultWidth,
    'VIEWPORT_RATIO' => 1.618,
    'BG_R' => 255,
    'BG_G' => 255,
    'BG_B' => 255,
    'TEXT_R' => 75,
    'TEXT_G' => 75,
    'TEXT_B' => 75,
    'HEADER_HEIGHT' => 30,
    'INDICATOR_HEIGHT' => 80,
    'RIGHT_Y_INDEX_WIDTH' => 30,
    'LEFT_Y_INDEX_WIDTH' => 30,
    'BOTTOM_X_INDEX_HEIGHT' => 20,
    'DEFAULT_END' => date('Y-m-d'),
    'DEFAULT_RANGE' => 252, // days
    // VOLUME BAR
    'VOLUME_UP_COLOR' => 'green',
    'VOLUME_DOWN_COLOR' => 'red',
    'VOLUME_HEIGHT_RATIO' => .175,
    'GRID_COLOR' => "lightgrey",
    'GRID_HIGHLIGHT_COLOR' => "midgrey",
    'VERTEX_COLOR' => "midgrey",
    'CANDLE_FILL_DOWNDOWN' => "red",
    'CANDLE_LINE_DOWNDOWN' => "red",
    'CANDLE_FILL_UPUP' => "white",
    'CANDLE_LINE_UPUP' => "black",
    'CANDLE_FILL_UPDOWN' => "black",
    'CANDLE_LINE_UPDOWN' => "black",
    'CANDLE_FILL_DOWNUP' => "white",
    'CANDLE_LINE_DOWNUP' => "red",
    'CANDLE_MARGIN' => 0,
    'SYMBOL_Y' => 17,
    'SYMBOL_X' => 30,
    'SYMBOL_FONT_SIZE' => 14,
    'SECONDARY_HEADER_ROW' => 28,
    'DATE_X' => 30,
    'DATE_FONT_SIZE' => 8,
    'DATEROW_X_AXIS_NEG_PADDING' => 18,
    'DATEROW_FONT_SIZE' => 8,
    'symbol' => [
        'size' => 14,
        'x' => 30, // left/right x buffer
        'y' => 17, 
        'bold' => true,
        'color' => 'black'
    ],
    'date' => [
        'size' => 8,
        'x' => 30, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => false,
        'color' => 'darkgrey'
    ],
    'daterow' => [
        'size' => 8,
        'x' => 30, // left/right x buffer
        'y' => 250, // secondary header row
        'bold' => false,
        'color' => 'darkgrey'
    ],
    'high_header' => [
        'size' => $metaHeaderFontSize,
        'x' => $metaHeaderOrigin, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaHeaderBold,
        'color' => $metaHeaderColor,
        'right' => $metaDataNodeWidth + $metaHeaderOrigin,
        
    ],
    'low_header' => [
        'size' => $metaHeaderFontSize,
        'x' => 100 + $metaHeaderOrigin, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaHeaderBold,
        'color' => $metaHeaderColor,
        'right' => 100 + $metaDataNodeWidth + $metaHeaderOrigin,
    ],
    'open_header' => [
        'size' => $metaHeaderFontSize,
        'x' => 200 + $metaHeaderOrigin, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaHeaderBold,
        'color' => $metaHeaderColor,
        'right' => 200 + $metaDataNodeWidth + $metaHeaderOrigin,
    ],
    'close_header' => [
        'size' => $metaHeaderFontSize,
        'x' => 300 + $metaHeaderOrigin, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaHeaderBold,
        'color' => $metaHeaderColor,
        'right' => 300 + $metaDataNodeWidth + $metaHeaderOrigin,
    ],
    'change_header' => [
        'size' => $metaHeaderFontSize,
        'x' => 400 + $metaHeaderOrigin, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaHeaderBold,
        'color' => $metaHeaderColor,
        'right' => 400 + $metaHeaderOrigin + 80,
    ],
    'high_data' => [
        'size' => $metaDataFontSize,
        'x' => 430, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaDataBold,
        'color' => $metaDataColor,
    ],
    'low_data' => [
        'size' => $metaDataFontSize,
        'x' => 545, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaDataBold,
        'color' => $metaDataColor,
    ],
    'open_data' => [
        'size' => $metaDataFontSize,
        'x' => 660, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaDataBold,
        'color' => $metaDataColor,
    ],
    'close_data' => [
        'size' => $metaDataFontSize,
        'x' => 775, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaDataBold,
        'color' => $metaDataColor,
    ],
    'change_data' => [
        'size' => $metaDataFontSize,
        'x' => 775, // left/right x buffer
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaDataBold,
    ],
    'meta_header' => [
        'size' => $metaHeaderFontSize,
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaHeaderBold,
        'color' => $metaHeaderColor,
    ],
    'meta_data' => [
        'size' => $metaDataFontSize,
        'y' => $secondaryHeaderRowYOrigin, // secondary header row
        'bold' => $metaDataBold,
        'color' => $metaDataColor,
    ],
    'volume' => [
        'size' => 9,
        'x' => 35, // left/right x buffer
        'y' => 43, // secondary header row
        'bold' => false,
        'color' => 'black',
    ],
    'chart' => [
        'vertical_buffer' => 10, // space between bottom axis and meta['low'] & top
    ]
];