<?php

 $image = imagecreate(900, 300); 
    
// Set the background color of image 
$background_color = imagecolorallocate($image, 215, 215, 215); 

// Set the text color of image 
$text_color = imagecolorallocate($image,  75, 75, 75);

// Function to create image which contains string. 
imagestring($image, 2, 10, 10, 'TESTING', $text_color);
imagestring($image, 5, 10, 10, 'TESTING', $text_color);
imagestring($image, 5, 180, 100,  "GeeksforGeeks", $text_color); 
imagestring($image, 3, 160, 120,  "A computer science portal", $text_color); 

header("Content-Type: image/png"); 

imagepng($image); 
imagedestroy($image); 