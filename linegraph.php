<?php
///////////////////////////////////////////////////////////////////////////////
//                                                                           //
// graphics.php                                                              //
// Version 1.0 (5/28/2003)                                                   //
//                                                                           //
///////////////////////////////////////////////////////////////////////////////
//                                                                           //
// Line graphics generator configurable library                              //
// Creator: Guillermo Guti�rrez Almazor                                      //
//                                                                           //
// You are free to modify and redistribute this library.                     //
// I only ask you to mail me the changes made to this code :)                //
// mail: 100030506@alumnos.uc3m.es                                           //
//                                                                           //
///////////////////////////////////////////////////////////////////////////////
//                                                                           //
// You can create graphics with thees two functions. The first one creates a //
// PNG image with a grid of x width and y height, vertical and horizontal    //
// indexes and some left margin to accomodate vertical indexes. You can also //
// select item colors passing them through the function arguments in         //
// hexadecimal. The second function creates the metioned grid and puts in it //
// the lines plotted using the data passed through the data array. It also   //
// calculates the cells width and the margin needed to accomodate indexes    //
// dinamycally, so you only have to worry about putting the indexes and data //
// properly, independently how many characters have in them and how many px  //
// will they occupy. You also must pass the function an array with the       //
// color to use for the traces.                                              //
//                                                                           //
///////////////////////////////////////////////////////////////////////////////
//                                                                           //
// For more information, read the code comments                              //
//                                                                           //
///////////////////////////////////////////////////////////////////////////////


function generate_grid($filename, $rows, $columns, $margin, $cell_width, $cell_height, $bg_color, $altern_color_1, $altern_color_2, $grid_color, $text_color, $a_v_indexes, $a_h_indexes) {
	// I check the arguments first to see if they're filled. If they're 
	// i use default settings. You can modify them thru this part of the code
	if ($filename == "") { $filename = "prueba.png"; }
	if ($rows == "") { $rows = 10; }
	if ($columns == "") { $columns = 12; }
	if ($margin == "") { $margin = 20; }
	if ($cell_width == "") { $cell_width = 20; }
	// cell_height accepts a minimum of 12 px but you don't see the indexes very well
	// with this number, so i recomend a minimum of 20 px height
	if ($cell_height == "") { 
		$cell_height = 20;
	}
	if ($bg_color == "") { $bg_color = "ffffff"; }
	if ($altern_color_1 == "") { $altern_color_1 = "0099cc"; }
	if ($altern_color_2 == "") { $altern_color_2 = "bdd7e7"; }
	if ($grid_color == "") { $grid_color = "000000"; }
	if ($text_color == "") { $text_color = "000000"; }
	if ($a_v_indexes == "") {
		for ($i = 0; $i <= $rows; $i ++) {
			$a_v_indexes[$i] = $i;
		}
	}
	if ($a_h_indexes	== "") {
		for ($i = 0; $i <= $columns; $i ++) {
			$a_h_indexes[$i] = $i;
		}
	}

	// Calculate the image dimensions
	$ancho_px = $cell_width * $columns;
	$alto_px = $cell_height * $rows;

	// Create the image in memory, adding some margins ti accomodate indexes
	// Note: Margins are like following:
	// Left: amount of px passed thru $margin argument
	// Right: One cells width is used as margin
	// Top and bottom: 20 px are used
	$image = imagecreatetruecolor(($ancho_px + $margin + $cell_width), $alto_px + 40);

	// Color definitions
	$bg_color	= imagecolorallocate($image, hexdec(substr($bg_color, 0, 2)), hexdec(substr($bg_color, 2, 2)), hexdec(substr($bg_color, 4, 2)));
	$text_color	= imagecolorallocate($image, hexdec(substr($text_color, 0, 2)), hexdec(substr($text_color, 2, 2)), hexdec(substr($text_color, 4, 2)));
	$grid_color	= imagecolorallocate($image, hexdec(substr($grid_color, 0, 2)), hexdec(substr($grid_color, 2, 2)), hexdec(substr($grid_color, 4, 2)));
	$altern_color_1	= imagecolorallocate($image, hexdec(substr($altern_color_1, 0, 2)), hexdec(substr($altern_color_1, 2, 2)), hexdec(substr($altern_color_1, 4, 2)));
	$altern_color_2	= imagecolorallocate($image, hexdec(substr($altern_color_2, 0, 2)), hexdec(substr($altern_color_2, 2, 2)), hexdec(substr($altern_color_2, 4, 2)));

	// Image background filling
	imagefill($image, 0, 0, $bg_color);

	// Writting the grid
	for ( $xx=0; $xx < $columns; $xx++ ) {
		for ( $yy=0; $yy < $rows; $yy++ ) {
			$x1 = ($cell_width * $xx) + $margin;
			$x2 = ($cell_width * ($xx+1)) + $margin;
			$y1 = ($cell_height * $yy) + 20;
			$y2 = ($cell_height * ($yy+1)) + 20;
			// This is the grid itself
			imagerectangle($image, $x1, $y1, $x2, $y2, $grid_color);
			// Theese are the little 2px lines at the edges
			if (($yy % 2) == 0) {
				imagefill($image, ($x1+1), ($y1+1), $altern_color_1);
			} else {
				imagefill($image, ($x1+1), ($y1+1), $altern_color_2);
			}
			if ($xx == 0) {
				imageline($image, $x1, $y1, ($x1 - 2), $y1, $grid_color);
			}
			if (($yy + 1) >= ($alto_px/$cell_height)) {
				imageline($image, $x2, $y2, $x2, ($y2 + 2), $grid_color);
			}
		}
	} 

	// Vertical indexes
	for ($i = 0; $i <= $rows; $i ++) {
		$yy = 12 + $cell_height * $i;
		$texto = $a_v_indexes[($rows-$i)];
		$n = strlen($texto);
		$separacion = 8 * $n + 4;
		imagestring($image, 4, ($margin - $separacion), $yy, $texto, $text_color);
	}

	// Horizontal indexes
	for ($i = 0; $i <= $columns; $i ++) {
		$xx = $margin - 5 + $cell_width * $i;
		imagestring($image, 4, $xx, ($alto_px + 24), $a_h_indexes[$i], $text_color);
	}

	// PNG creation
	imagepng($image, $filename);

	// Erase the image from memory
	imagedestroy($image);
}

function graphic($a_data, $a_v_indexes, $a_h_indexes, $a_colors) {
	// Default filename. You can modify this so as it is passed thru arguments (better)
	$file_name = "grafica.png";

	// Getting number of rows and columns 
	$rows = count($a_v_indexes);
	$columns = count($a_h_indexes);

	// Calculating size of margins
	$n = 0;
	for ($i = 0; $i < count($a_v_indexes); $i ++) {
		if (strlen($a_v_indexes[$i]) > $n) {
			$n = strlen($a_v_indexes[$i]);
		}
	}
	$margin = 8 * ($n + 1); // Each letter is 8 px (more or less) width, spaces included

	// Calculating with of cells
	$n = 0;
	for ($i = 0; $i < count($a_h_indexes); $i ++) {
		if (strlen($a_h_indexes[$i]) > $n) {
			$n = strlen($a_h_indexes[$i]);
		}
	}
	$cell_width = ($n + 1) * 8;
	// A little correction 
	if ($cell_width < 20) {
		$cell_width = 20;
	}

	// Height of cells doesn't matter at all, but i make a little correction
	// if the rows to show are very few.
	if ($rows < 10) {
		$cell_height = 35;
	} else {
		$cell_height = 20;
	}

	// Grid generation. Remember to have write permissions on the directory of the script to place the image file
	generate_grid($file_name, ($rows-1), ($columns-1), $margin, $cell_width, $cell_height, "", "", "", "", "", $a_v_indexes, $a_h_indexes);

	// We recover image from the file to memory
	$image = imagecreatefrompng($file_name);

	// This loop takes data and traces the lines onto the grid
	for ($n = 0; $n < count($a_data); $n ++) {
		$data = $a_data[$n];
		$x1 = $margin;
		$y1 = 20 + (($rows-1) * $cell_height) - ($data[0] * (($rows-1) * $cell_height)/100);
		for ($x = 1; $x < $columns; $x++) {
			$color = $a_colors[$n];
			$x2 = $margin + $x*$cell_width;
			$y2 = 20 + (($rows-1) * $cell_height) - ($data[$x] * (($rows-1) * $cell_height)/100);
			$grid_color = imagecolorallocate($image, hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
			imageline($image, $x1, $y1, $x2, $y2, $grid_color);
			$x1 = $x2;
			$y1 = $y2;
		}
	}

	// PNG creation
	imagepng($image, $file_name);

	// Image removal from memory
	imagedestroy($image);

	// HTML code for the image
	echo "<img src=\"$file_name\" border=\"0\" />";
}

// This is all. Now there is some code for the demo

// seed with microseconds
function make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}


// Data to show. Each $n index is one trace
$a_data = array();
for ($n = 0; $n < 5; $n ++) {
	srand(make_seed());
	$a_data[$n][0] = round(rand(0,100));
	$a_data[$n][1] = round(rand(0,100));
	$a_data[$n][2] = round(rand(0,100));
	$a_data[$n][3] = round(rand(0,100));
	$a_data[$n][4] = round(rand(0,100));
	$a_data[$n][5] = round(rand(0,100));
	$a_data[$n][6] = round(rand(0,100));
	$a_data[$n][7] = round(rand(0,100));
	$a_data[$n][8] = round(rand(0,100));
	$a_data[$n][9] = round(rand(0,100));
	$a_data[$n][10] = round(rand(0,100));
	$a_data[$n][11] = round(rand(0,100));
}

// Horizontal indexes
$a_h_indexes[0] =  "JAN";
$a_h_indexes[1] =  "FEB";
$a_h_indexes[2] =  "MAR";
$a_h_indexes[3] =  "APR";
$a_h_indexes[4] =  "MAY";
$a_h_indexes[5] =  "JUN";
$a_h_indexes[6] =  "JUL";
$a_h_indexes[7] =  "AUG";
$a_h_indexes[8] =  "SEP";
$a_h_indexes[9] =  "OCT";
$a_h_indexes[10] = "NOV";
$a_h_indexes[11] = "DIC";

// Vertical indexes
$a_v_indexes[0] = 0;
$a_v_indexes[1] = 10;
$a_v_indexes[2] = 20;
$a_v_indexes[3] = 30; 
$a_v_indexes[4] = 40; 
$a_v_indexes[5] = 50; 
$a_v_indexes[6] = 60; 
$a_v_indexes[7] = 70; 
$a_v_indexes[8] = 80; 
$a_v_indexes[9] = 90;
$a_v_indexes[10] = 100;

// Colors array
$a_colors[0] = "000000";
$a_colors[1] = "6600FF";
$a_colors[2] = "FF0099";
$a_colors[3] = "33CC00";
$a_colors[4] = "CCCC00";
$a_colors[5] = "0000CC";
$a_colors[6] = "FFFF66";
$a_colors[7] = "006600";
$a_colors[8] = "00FFFF";
$a_colors[9] = "FFFFFF";
$a_colors[10] = "660033";
$a_colors[11] = "66FFCC";

graphic($a_data, $a_v_indexes, $a_h_indexes, $a_colors);

// End :)

?>
