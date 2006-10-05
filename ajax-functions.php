<?php


/*

creatimage() Usage
$u_string = "this is my text" your text
$u_font = "arial.ttf" obviously font name
$u_sizes = string "40|40" back text, front text,
$u_fcolor = string "0|0|0" black text foreground color
$u_bcolor = string "128|128|128" grey text shadow (note see $coors)
$angles = string "90|180" counter clockwise rotation, back, fore text
$coors = string "x1|y1|x2|y2" ie "40|40|38|38" back | fore ground respectivly
	note the offset coors above would produce a drop shadow starting from -2,-2 of the foreground text
$im_width = "600" width of the image
$im_height = "100" height of image
$im_bgcolor = "255|255|255" white background color

*/


function createImage($u_string,$u_font,$u_sizes,$u_fcolor,$u_bcolor,$angles,$coors,$im_width,$im_height,$im_bgcolor){

	$u_string = htmlspecialchars(eregi_replace("%20"," ",$u_string)); // string spaces
	$u_font = eregi_replace("%20"," ",$u_font); // string spaces
	$font = "./fonts/$u_font"; // the font to use
	$u_sizes = explode("|",$u_sizes); // font sizes
	$u_bcolor = explode("|",$u_bcolor); // back text color
	$u_fcolor = explode("|",$u_fcolor); // fore text color
	$im_bgcolor = explode("|",$im_bgcolor); // bgcolor
	$angles = explode("|",$angles); // z1,z2 actually still x-y axis plain but z for distinguishing purposes
	$coors = explode("|",$coors); // split x1,y1,x2,y2
	$im = imagecreatetruecolor($im_width, $im_height) or die ("Cannot Create image"); // create new file
	$bc = imagecolorallocate($im, $im_bgcolor[0],$im_bgcolor[1],$im_bgcolor[2]); // white background
	$btc = imagecolorallocate($im, $u_bcolor[0],$u_bcolor[1],$u_bcolor[2]); // text shadow color
	$ftc = imagecolorallocate($im, $u_fcolor[0],$u_fcolor[1],$u_fcolor[2]); // text color
	imagefilledrectangle($im, 0, 0, $im_width, $im_height, $bc); // make rectangle too fille background color
	imagettftext($im, $u_sizes[0], $angles[0], $coors[0], $coors[1], $btc, $font, $u_string); // add background text (shadow)
	imagettftext($im, $u_sizes[1], $angles[1], $coors[2], $coors[3], $ftc, $font, $u_string); // overlay foreground text
	$rand = rand(5,555555); // poor random image filename
	$outfile= "ajax-renderedimages/$rand.png"; //output directory
	imagepng($im,$outfile); // image png PNG format
	return $outfile; // return filename to be used in relative links
	
}

function html_select_font(){

	if ($handle = opendir('./fonts')) {
		print "<select name='u_font' onchange=\"makeimage()\">\n";
   		while (false !== ($file = readdir($handle))) {
			if(!is_dir($file)){
       			echo "<option value='$file'>$file</option>\n";
   			}
		}
		print "</select>\n";
   		closedir($handle);
	}
	
}

function html_input_angles(){

	print "Shadow angle: <input type=text value=0 name=bangle onkeyup=\"makeimage()\"> <br>Fore angle : <input type=text value=0 name=fangle onkeyup=\"makeimage()\">";
  	
}

function html_input_coors(){

	print "Shadow x : <input type=text value=30 name=cx1 size=3 width=3 onkeyup=\"makeimage()\"> y : <input type=text value=50 name=cy1 size=3 width=3 onkeyup=\"makeimage()\"><br>";
  	print "Foreground x : <input type=text value=32 name=cx2 size=3 width=3 onkeyup=\"makeimage()\"> y : <input type=text value=52 name=cy2 size=3 width=3 onkeyup=\"makeimage()\"><br>";
}

function html_select_fsize(){

	print "<select name='fu_size' onchange=\"makeimage()\">";
   	for($i=5;$i<100;$i++){
		echo "<option value='$i'>$i pt</option>\n";
	}
	print "</select>";
  	
}

function html_select_bsize(){

	print "<select name='bu_size' onchange=\"makeimage()\">";
   	for($i=5;$i<100;$i++){
		echo "<option value='$i'>$i pt</option>\n";
	}
	print "</select>";
  	
}

function html_select_fcolor(){

	print "<select name='fcr' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
	print "<select name='fcg' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
	print "<select name='fcb' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
}

function html_select_bcolor(){

	print "<select name='bcr' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
	print "<select name='bcg' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
	print "<select name='bcb' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
}

function html_select_width(){

	$widths = array(800,700,600,500,400,300,200,100);
	print "<select name='imwidth' onchange=\"makeimage()\">";
	foreach($widths as $value){
		echo "<option value='$value'>$value pixels</option>\n";
	}
	print "</select>";
}

function html_select_height(){

	$heights = array(800,700,600,500,400,300,200,100);
	print "<select name='imheight' onchange=\"makeimage()\">";
	foreach($heights as $value){
		echo "<option value='$value'>$value pixels</option>\n";
	}
	print "</select>";	
}

function html_select_bgcolor(){

	print "<select name='imcr' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
	print "<select name='imcg' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
	print "<select name='imcb' onchange=\"makeimage()\">";
   	for($i=0;$i<256;$i++){
		echo "<option value='$i'>$i</option>\n";
	}
	print "</select>";
	
}

?>




