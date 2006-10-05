<?php

include("function_openimage.php");

$image = open_image('pic/flower.jpg');

if ($image === false) {
        die ('Unable to open image');
}

echo 'Opened image<br>';
echo 'Height: ' . imagesy($image) . ' pixels<br>';
echo 'Width: ' . imagesx($image) . ' pixels<br>';



?>