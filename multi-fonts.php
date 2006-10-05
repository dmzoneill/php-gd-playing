<?php

set_time_limit(0);

function createImage($text,$file){

$backgroundimage = "pic/blank.gif";
$im=imagecreatefromgif($backgroundimage);
$colour = imagecolorallocate($im, 0, 0, 0);
$font = "c:/wamp/www/GD/fonts/$file";
$string = $text." - - $file";
$angle = rand(0,0);
// Add the text
imagettftext($im, 30, $angle, 20, 57, $colour, $font, $string);
$outfile= "logos/$file-Rand.gif";
imagegif($im,$outfile);
return $outfile;
}




if ($handle = opendir('./fonts')) {


   while (false !== ($file = readdir($handle))) {
if(!is_dir($file)){
       echo "<IMG SRC='".createImage("anto yau","$file")."' name=secimg>$file<br>";
   }
}

   closedir($handle);
}







?> 