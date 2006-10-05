
<?php

$image = 'pic/flower.jpg'; // the image to crop
$dest_image = 'pic/cropped_whatever.jpg'; // make sure the directory is writeable

$margin = 10; // to keep the image and layer in sync

if(!isset($_POST['step'])) $title = '1';
else $title = $_POST['step'];

echo '
<html>
<head>
	<title>lixlpixel image crop | step '.$title.'</title>
</head>
<body style="margin: '.$margin.'px;">';

if(!isset($_POST['tx']) && !isset($_POST['fx']))
{
	echo '
	<form method="post" action="'.$_SERVER['PHP_SELF'].'">
		<input type="image" src="'.$image.'"><p>';
	if(!isset($_POST['x']))
	{
		echo '
		<input type="hidden" name="step" value="2">
		click to mark first corner';
	}else{
		echo '
		<input type="hidden" name="step" value="3">
		<input type="hidden" name="fx" value="'.$_POST['x'].'">
		<input type="hidden" name="fy" value="'.$_POST['y'].'">
		click to mark second corner | <a href="'.$_SERVER['PHP_SELF'].'">start over</a>';
	}
	echo '
	</form>
	';
}

if(isset($_POST['fx']))
{
	echo '
	<form method="post" action="'.$_SERVER['PHP_SELF'].'">
		<input type="hidden" name="step" value="4">
		<input type="image" src="'.$image.'">
		<input type="hidden" name="tx" value="'.$_POST['fx'].'">
		<input type="hidden" name="ty" value="'.$_POST['fy'].'">
		<input type="hidden" name="width" value="'.($_POST['x']-$_POST['fx']).'">
		<input type="hidden" name="height" value="'.($_POST['y']-$_POST['fy']).'"><p>
		<div style="position: absolute;
					left:'.($_POST['fx']+$margin).'px;
					top: '.($_POST['fy']+$margin).'px;
					width: '.($_POST['x']-$_POST['fx']).'px;
					height: '.($_POST['y']-$_POST['fy']).'px;
					border: 1px solid #fff;">
		</div>
		click image to crop rectangle | <a href="'.$_SERVER['PHP_SELF'].'">start over</a>
	</form>';
}

if(isset($_POST['tx']))
{
	$img = imagecreatetruecolor($_POST['width'],$_POST['height']);
	$org_img = imagecreatefromjpeg($image);
	$ims = getimagesize($image);
	imagecopy($img,$org_img, 0, 0, $_POST['tx'], $_POST['ty'], $ims[0], $ims[1]);
	imagejpeg($img,$dest_image,90);
	imagedestroy($img);
	echo '
	<img src="'.$dest_image.'" width="'.$_POST['width'].'" height="'.$_POST['height'].'"><p>
	<a href="'.$_SERVER['PHP_SELF'].'">try again</a>';
}

echo '
</body>
</html>';

?>
