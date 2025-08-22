<?php
include './include.php'; // necessary include

$data_file = $installpath."unpacker\\datsource\\";
$text_file = $installpath."unpacker\\txtsource\\";
$verfile = file("./".VERSION."unpack.ini", FILE_SKIP_EMPTY_LINES);

for($vs = 0; $vs < sizeof($verfile); $vs++)
{
	$fpath = trim($verfile[$vs]);
	$spt = "\\\\";
	$fpart = split($spt, $fpath);
	$spart = count($fpart) - 1;

	$structpath = $installpath.$fpath.".txt";
	$datapath = $data_file.$fpart[$spart].".dat";
	$textpath = $text_file.$fpart[$spart].".txt";
	totxtparser($textpath, $datapath, $structpath);
}
echo "<br>Script finished";