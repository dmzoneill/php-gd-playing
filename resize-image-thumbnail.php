<?php

include("function_openimage.php");

if ($_POST) {
    // No image?
    if (empty($_FILES['image']) OR $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        die ('<strong>Invalid image uploaded.  Please go back and try again.</strong>');
    }

    $imagepath = $_FILES['image']['tmp_name'];

    // Load image
    $image = open_image($imagepath);

    if ($image == false) {
        die ('<strong>You uploaded an invalid image. Please go back and try again.</strong>');
    }

    // Get original width and height
    $width = imagesx($image);
    $height = imagesy($image);

    // Percentage?
    if (!empty($_POST['percent']) AND is_numeric($_POST['percent'])) {
        $percent = floatval($_POST['percent']);
        $percent = $percent/100;

        $new_width = $width * $percent;
        $new_height = $height * $percent;

    // New width? Calculate new height
    } elseif (!empty($_POST['new_width']) AND is_numeric($_POST['new_width'])) {
        $new_width = floatval($_POST['new_width']);
        $new_height = $height * ($new_width/$width);

    // New height? Calculate new width
    } elseif (!empty($_POST['new_height']) AND is_numeric($_POST['new_height'])) {
        $new_height = floatval($_POST['new_height']);
        $new_width = $width * ($new_height/$height);

    // New height and new width
    } elseif (!empty($_POST['height']) AND is_numeric($_POST['height']) AND !empty($_POST['width']) AND is_numeric($_POST['width'])) {
        $new_height = floatval($_POST['height']);
        $new_width = floatval($_POST['width']);
    } else {
        die ('<strong>You didn\'t specify any resizing options.</strong>');
    }    

    // Resample
    $image_resized = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    // Display resized image
    header('Content-type: image/jpeg');
    imagejpeg($image_resized);
    die();

}

// Display the upload form:
?>
<html>
    <head>
        <title>Image Resizer</title>

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
                <th>Resize to: </th>
                <td><input type="text" name="percent" size="1" />% (percentage)</td>
            </tr>

            <tr>
                <th>OR new width: </th>
                <td><input type="text" name="new_width" size="1" /> pixels (height will be calculated automatically)</td>
            </tr>

            <tr>
                <th>OR new height: </th>
                <td><input type="text" name="new_height" size="1" /> pixels (width will be calculated automatically)</td>
            </tr>

            <tr>
                <th>OR new height and new width: </th>
                <td>
                    <table>
                        <tr><td>width:</td><td><input type="text" name="width" size="1" /> pixels</td></tr>
                        <tr><td>height:</td><td><input type="text" name="height" size="1" /> pixels</td></tr>
                    </table>
                </td>
            </tr>


            <tr><td colspan="2" style="text-align:center;"><input type="submit" value="Resize Image" /></td></tr>
        </form>
    </body>
</html> 