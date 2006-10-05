<?php
   $im = imagecreatefromgif('pic/texture.gif');
   $img = imagecreatetruecolor(100,100);
   $trans = imagecolorallocate($img,255,99,140);
   imagecolortransparent($img,$trans);
   imagecopy($img,$im,0,0,0,0,100,100);
   imagetruecolortopalette($img, true, 256);
   imageinterlace($img);
   imagegif($img,'trans.gif');
   imagedestroy($img);
?>