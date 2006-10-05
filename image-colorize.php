<?php
function imagecolorize($im,$col,$pct) {
    // Get the image's width
    $im_w = imagesx($im);
    // Get the image's height
    $im_h = imagesy($im);
    // Set a pixel with the color, so we can get it easily
    $setpixel = imagesetpixel($im,$im_w,0,$col);
    // Get the color
    $index = imagecolorat($im,$im_w,0);
    // Find the color in the index
    $rgb = imagecolorsforindex($im,$index);
    // Get the red value
    $r = $rgb["red"];
    // Get the green value
    $g = $rgb["green"];
    // Get the blue value
    $b = $rgb["blue"];
    // Create the layover
    $layover = imagecreate($im_w,$im_h);
    // Allocate the color on this image
    $color = imagecolorallocate($layover,$r,$g,$b);
    // Fill the image with the new color (this really isn't needed)
    $fill = imagefill($layover,0,0,$color);
    // Merge the layover on top of the older image
    $merge = imagecopymerge($im,$layover,0,0,0,0,$im_w,$im_h,$pct);
    imagedestroy($layover); // Destroy the layover
}


imagecolorize('pic/woman.jpg','0,0,255','50');

?>