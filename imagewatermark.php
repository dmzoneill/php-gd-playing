<?php

include("function_openimage.php");

if ($_POST) {
    // No image?
    if (empty($_FILES['image']) OR $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        die ('<strong>Invalid image uploaded.  Please go back and try again.</strong>');
    }

    if (empty($_POST['watermark'])) {
        die('<strong>Please enter some text for your watermark.</strong>');
    }

    $imagepath = $_FILES['image']['tmp_name'];

    // Load image
    $image = open_image($imagepath);

    if ($image == false) {
        die ('<strong>You uploaded an invalid image. Please go back and try again.</strong>');
    }

    switch($_POST['color']) {
        case 'black':
            $color = imagecolorallocate($image, 0, 0, 0);
            break;
        case 'red':
            $color = imagecolorallocate($image, 255, 0, 0);
            break;
        case 'blue':
            $color = imagecolorallocate($image, 0, 0, 255);
            break;
        case 'yellow':
            $color = imagecolorallocate($image, 255, 255, 0);
            break;
        case 'green':
            $color = imagecolorallocate($image, 0, 255, 0);
            break;
        case 'white':
        default:
            $color = imagecolorallocate($image, 255, 255, 255);
    }

    // Add text to image
    imagestring($image, 3, 5, imagesy($image)-20, $_POST['watermark'], $color);



    // Display image
    header('Content-type: image/jpeg');
    imagejpeg($image);
    die();

}

// Display the upload form:
?>
<html>
    <head>
        <title>Image Watermarker</title>

    <style type="text/css">
        th { text-align: right; }
    </style>

    </head>

    <body>
        <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Image:</th>
                <td><input type="file" name="image"></td>
            </tr>

            <tr>
                <th>Text:</th>
                <td><input type="text" name="watermark" size="30" /></td>
            </tr>

            <tr>
                <th>Text Color:</th>
                <td>
                    <select name="color">
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="blue">Blue</option>
                        <option value="red">Red</option>
                        <option value="yellow">Yellow</option>
                        <option value="green">Green</option>                        
                    </select>                
                </td>
            </tr>

            <tr><td colspan="2" style="text-align:center;"><input type="submit" value="Add Watermark" /></td></tr>
        </form>
    </body>
</html> 