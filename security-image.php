<?php
function createImage(){
//        creates the images, writes the file
       $fileRand = md5(rand(100000,999999));
       $string_a = array("A","B","C","D","E","F","G","H","J","K",
"L","M","N","P","R","S","T","U","V","W","X","Y","Z",
"2","3","4","5","6","7","8","9");
       $keys = array_rand($string_a, 6);
       foreach($keys as $n=>$v){
           $string .= $string_a[$v];
         }
$backgroundimage = "pic/texture.gif";
$im=imagecreatefromgif($backgroundimage);
$colour = imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,255));
$font = 'Georgia';
$angle = rand(-5,5);
// Add the text
imagettftext($im, 30, $angle, 60, 47, $colour, $font, $string);
$outfile= "security/$fileRand.gif";
imagegif($im,$outfile);
return $outfile;
}
echo "<IMG SRC=".createImage()." name=secimg>";

?>