<?php

include("function_openimage.php");

// Load image
$image = open_image('pic/woman.jpg');
if ($image === false) { die ('Unable to open image'); }

// Get original width and height
$width = imagesx($image);
$height = imagesy($image);

// Calculate new width and height using percentage
$percent = 0.54;

$new_width = $width * $percent;
$new_height = $height * $percent;

// Resample
$image_resized = imagecreatetruecolor($new_width, $new_height);
imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Display resized image
header('Content-type: image/jpeg');
imagejpeg($image_resized);
die();

?>