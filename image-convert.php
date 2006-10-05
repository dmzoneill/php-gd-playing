<?php

include("function_openimage.php");


if ($_POST) {
    // No image?
    if (empty($_FILES['image']) OR $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        die ('<strong>Invalid image uploaded.  Please go back and try again.</strong>');
    }

    if (empty($_POST['type'])) {
        die ('<strong>Invalid image type selected. Please go back and try again.</strong>');
    }

    $type = $_POST['type'];
    $imagepath = $_FILES['image']['tmp_name'];

    // Load image
    $image = open_image($imagepath);

    if ($image == false) {
        die ('<strong>You uploaded an invalid image. Please go back and try again.</strong>');
    }

    // Display image
    switch($type) {
        case 'jpg':
            header ('Content-Type: image/jpeg');
            imagejpeg($image);
            break;
        case 'gif':
            header ('Content-Type: image/gif');
            imagegif($image);
            break;
        case 'png':
            header ('Content-Type: image/png');
            imagepng($image);
            break;
        case 'wbmp':
            header ('Content-Type: image/vnd.wap.wbmp');
            imagewbmp($image);
            break;
        default:
            die ('<strong>You selected an invalid image type. Please go back and try again.</strong>');
    }
        
    die;
}

// Display the upload form:
?>
<html>
    <head>
        <title>Image Converter</title>
    </head>

    <body>
        <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <th style="text-align:right;">Image:</th>
                <td><input type="file" name="image"></td>
            </tr>

            <tr>
                <th>Convert Into: </th>
                <td>
                    <select name="type">
                        <option value="jpg">JPEG</option>
                        <option value="gif">GIF</option>
                        <option value="png">PNG</option>
                        <option value="wbmp">WBMP</option>
                    </select>
                </td>
            <tr><td colspan="2"><input type="submit" value="Convert Image" /></td></tr>
        </form>
    </body>
</html>

