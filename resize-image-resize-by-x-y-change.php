<?php

include("function_openimage.php");

// Load image
$image = open_image('pic/woman.jpg');
if ($image === false) { die ('Unable to open image'); }

// Get original width and height
$width = imagesx($image);
$height = imagesy($image);

// Set a new width, and calculate new height
$new_width = 200;
$new_height = $height * ($new_width/$width);

// Or, vice versa
//$new_height = 300;
//$new_width = $width * ($new_height/$height);

// Resample
$image_resized = imagecreatetruecolor($new_width, $new_height);
imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Display resized image
header('Content-type: image/jpeg');
imagejpeg($image_resized);
die();

?>