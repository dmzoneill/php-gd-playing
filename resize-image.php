<?php

include("function_openimage.php");

// Load image
$image = open_image('pic/woman.jpg');
if ($image === false) { die ('Unable to open image'); }

// Get original width and height
$width = imagesx($image);
$height = imagesy($image);

// New width and height
$new_width = 150;
$new_height = 100;

// Resample
$image_resized = imagecreatetruecolor($new_width, $new_height);
imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Display resized image
header('Content-type: image/jpeg');
imagejpeg($image_resized);
die();

?>