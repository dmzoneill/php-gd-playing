<?php
header("Content-type: image/jpeg"); 

include("function_openimage.php");

// Load open
$image = open_image('pic/flower.jpg');
if ($image === false) { die ('Unable to open image'); }

// ... Do some manipulation here ...

// Display image
imagejpeg($image);


?>