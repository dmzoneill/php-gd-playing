<?php
Header("Content-type: image/png");
$height = 300;
$width = 300;
$im = ImageCreate($width, $height);
$bck = ImageColorAllocate($im, 10,110,100);
$white = ImageColorAllocate($im, 255, 255, 255);
ImageFill($im, 0, 0, $bck);
ImageLine($im, 0, 0, $width, $height, $white);
for($i=0;$i<=299;$i=$i+10) {
ImageLine($im, 0, $i, $width, $height, $white); }    
ImagePNG($im);
?>