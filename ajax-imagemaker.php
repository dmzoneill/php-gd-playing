<html>
<head>
<script src=ajax.js language=javascript></script>
<script language=javascript>

function makeimage(){

loadurl('ajax-renderimage.php?u_string=' + document.options.u_string.value + '&u_font=' + document.options.u_font.value + '&u_sizes=' + document.options.bu_size.value + '|' + document.options.fu_size.value + '&u_fcolor=' + document.options.fcr.value + '|' + document.options.fcg.value + '|' + document.options.fcb.value + '&u_bcolor=' + document.options.bcr.value + '|' + document.options.bcg.value + '|' + document.options.bcb.value + '&angles=' + document.options.bangle.value + '|' + document.options.fangle.value + '&coors=' + document.options.cx1.value + '|' + document.options.cy1.value + '|' + document.options.cx2.value + '|' + document.options.cy2.value + '&im_width=' + document.options.imwidth.value + '&im_height=' + document.options.imheight.value + '&im_bgcolor=' + document.options.imcr.value + '|' + document.options.imcg.value + '|' + document.options.imcb.value);
}

</script>
</head>
<body>

<table cellpadding="10" cellspacing="5" border="0" width="100%" height="100%"><tr><td valign="top">


<form name=options>
The text you wish to enter : <br>
<textarea rows=10 cols=30 name='u_string' onkeyup="makeimage()">arrrg</textarea><br>
<?php 

include("ajax-functions.php");
echo  "The font you wish to use : <br>";
html_select_font();
echo  "<br>";
echo  "The font size you wish to use for the shadow : <br>";
html_select_bsize();
echo  "<br>";
echo  "The font size you wish to use for the foreground text : <br>";
html_select_fsize();
echo  "<br>";
echo  "The font angle for the background and foreground text : <br>";
html_input_angles();
echo  "<br>";
echo  "Where to place the background and foreground text : <br>";
html_input_coors();
echo  "<br>";
echo  "The font color of the foreground text : <br>";
html_select_fcolor();
echo  "<br>";
echo  "The font color of the background text : <br>";
html_select_bcolor();
echo  "<br>";
echo  "The width of the image : <br>";
html_select_width();
echo  "<br>";
echo  "The height of the image : <br>";
html_select_height();
echo  "<br>";
echo  "The background color of the image : <br>";
html_select_bgcolor();


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

?>
</form>

<div id=status></div>
</td><td valign="top">

<div id=output></div>

</td></tr></table>



</body>
</html>