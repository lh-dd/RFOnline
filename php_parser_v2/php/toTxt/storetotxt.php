<?php
include './include.php'; // necessary include


$data_file = $installpath."unpacker\\store.dat";

$fp = fopen($data_file, "rb");
$nblock = fread($fp, 4);
$nsize = fread($fp, 4);
$count = unpack("i", $nblock);
$size = unpack("i", $nsize);
$file = fopen($installpath."unpacker\\clientsource\\store.txt","w+");
for($a=0;$a < $count[1]; $a++){
	fseek($fp, $a * $size[1] + 8, SEEK_SET);
	fseek($fp, 8, SEEK_CUR);
	$nrace = fread($fp, 1);
	$nid1 = fread($fp, 32);
	$nid2 = fread($fp, 32);
	fseek($fp, 43, SEEK_CUR);
	$fheight = fread($fp, 4);
	$race = unpack("c", $nrace);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($nid1, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$id1 = unpack("a".$pos, $nid1);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($nid2, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$id2 = unpack("a".$pos, $nid2);
	$height = unpack("f", $fheight);
	$trans = array("."=>",");
	$height[1] = strtr($height[1], $trans);
	fseek($fp, 1614, SEEK_CUR);
	fwrite($file, "$race[1]\t");
	fwrite($file, "$height[1]\t");
	fwrite($file, "$id1[1]\t");
	fwrite($file, "$id2[1]\t");
	if(!defined('GU')){
	$desc = fread($fp, 1024);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($desc, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$des = unpack("a".$pos, $desc);
	fwrite($file, "$des[1]\t");	
	}
	fwrite($file, "\r\n");
}
fclose($file);
fclose($fp);

if(defined('GU'))
{
	$data_file = $installpath."unpacker\\ndstore.dat";
	$fp = fopen($data_file, "rb");
	$nblock = fread($fp, 4);
	$count = unpack("i", $nblock);
	$file = fopen($installpath."unpacker\\clientsource\\ndstore.txt","w+");
	for($i = 0; $i < $count[1]; $i++)
	{
		fseek($fp, 4, SEEK_CUR);
		$name1 = fread($fp, 32);
		$name2 = fread($fp, 32);
		$deslen = fread($fp, 4);
		$deslen = unpack("i", $deslen);
		$desc = fread($fp, $deslen[1]);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($name1, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$name1 = unpack("a".$pos, $name1);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($name2, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$name2 = unpack("a".$pos, $name2);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($desc, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$desc = unpack("a".$pos, $desc);
		fwrite($file, $name1[1]."\t");
		fwrite($file, $name2[1]."\t");
		fwrite($file, $desc[1]."\r\n");
	}
	fclose($file);
	fclose($fp);
}
echo "<br>Script finished";