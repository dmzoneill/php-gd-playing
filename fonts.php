<?php
Header("Content-type: image/png");

$im = imagecreate (250, 28);
$black = ImageColorAllocate ($im, 0, 0, 0);
$yellow = ImageColorAllocate ($im, 235, 235, 51);
ImageTTFText ($im, 20, 0, 10, 20, $yellow, "/WINDOWS/Fonts/IMPACT.ttf",
              "IMPACT FONT HIP HIP Hurray!!!");
ImagePNG($im);
?> 