<?php

include("ajax-functions.php");

/*

creatimage() Usage
$u_string = "this is my text" your text
$u_font = "arial.ttf" obviously font name
$u_sizes = string "40|40" back text, front text,
$u_fcolor = string "0|0|0" black text foreground color
$u_bcolor = string "128|128|128" grey text shadow (note see $coors)
$angles = string "90|180" counter clockwise rotation, back, fore text
$coors = string "x1|y1|x2|y2" ie "40|40|38|38" back | fore ground respectivly
	note the offset coors above would produce a drop shadow starting from -2,-2 of the foreground text
$im_width = "600" width of the image
$im_height = "100" height of image
$im_bgcolor = "255|255|255" white background color

*/

echo "<img src='" .createImage($u_string,$u_font,$u_sizes,$u_fcolor,$u_bcolor,$angles,$coors,$im_width,$im_height,$im_bgcolor) ."'>";



?>