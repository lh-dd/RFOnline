<?php
include './include.php'; // necessary include

function decode($dfile)
{
	global $fo;
	$bnum = fread($fo, 4);
	$cnum = fread($fo, 4);
	$bnumu = unpack("i", $bnum);
	for($i = 0; $i < $bnumu[1]; $i++){
		$str1 = fread($fo, 32);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($str1, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$stru1 = unpack("a".$pos, $str1);
		$str2 = fread($fo, 512);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($str2, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$stru2 = unpack("a".$pos, $str2);
		fwrite($dfile, $stru1[1]."\t".$stru2[1]."\r\n");
	}
	fclose($dfile);
}

$incname = "unpacker\\skillforce.dat"; //��� �����


$data_file = $installpath.$incname;
$fo = fopen($data_file, "rb");

$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliskillforce\\cliforce.txt","w+");
fwrite($fp, "string[32]\tstring[1024]\tEND\r\nClassName\tClassDesc\r\n");
for($i=0;$i < $count[1];$i++){
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 1);
	$data[7] = fread($fo, 32);
	$data[8] = fread($fo, 32);
	$data[9] = fread($fo, 32);
	$data[10] = fread($fo, 32);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("c", $data[6]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[7], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[7] = unpack("a".$pos, $data[7]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[8], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[8] = unpack("a".$pos, $data[8]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[9], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[9] = unpack("a".$pos, $data[9]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[10], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[10] = unpack("a".$pos, $data[10]);
	
	for($j = 0; $j < 11; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	for($a=0;$a < 7;$a++){
	for($j=0;$j < 10;$j++){
		$data[0] = fread($fo, 1);
		$number[0] = unpack("c", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	$data[0] = fread($fo, 2);
	$number[0] = unpack("s", $data[0]);
	fwrite($fp, $number[0][1]."\t");
	for($j=0;$j < 7;$j++){
		$data[0] = fread($fo, 4);
		$number[0] = unpack("f", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("H*", $data[3]);
	$number[4] = unpack("H*", $data[4]);
	$number[5] = unpack("H*", $data[5]);
	$number[6] = unpack("H*", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("i", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 2);
	$data[6] = fread($fo, 2);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("s", $data[5]);
	$number[6] = unpack("s", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 512);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 2);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[0], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[0] = unpack("a".$pos, $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("s", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("H*", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 1);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 2);
	$number[0] = unpack("c", $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("s", $data[5]);
	for($j = 0; $j < 6; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	fwrite($fp, "\r\n");
}
fclose($fp);
$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);
$fp = fopen($installpath."unpacker\\cliskillforce\\cliskill.txt","w+");
fwrite($fp, "string[32]\tstring[32]\tstring[32]\tEND\r\nBellato\tCora\tAccretia\r\n");
for($i=0;$i < $count[1];$i++){
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 1);
	$data[7] = fread($fo, 32);
	$data[8] = fread($fo, 32);
	$data[9] = fread($fo, 32);
	$data[10] = fread($fo, 32);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("c", $data[6]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[7], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[7] = unpack("a".$pos, $data[7]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[8], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[8] = unpack("a".$pos, $data[8]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[9], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[9] = unpack("a".$pos, $data[9]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[10], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[10] = unpack("a".$pos, $data[10]);
	
	for($j = 0; $j < 11; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	for($a=0;$a < 7;$a++){
	for($j=0;$j < 10;$j++){
		$data[0] = fread($fo, 1);
		$number[0] = unpack("c", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	$data[0] = fread($fo, 2);
	$number[0] = unpack("s", $data[0]);
	fwrite($fp, $number[0][1]."\t");
	for($j=0;$j < 7;$j++){
		$data[0] = fread($fo, 4);
		$number[0] = unpack("f", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("H*", $data[3]);
	$number[4] = unpack("H*", $data[4]);
	$number[5] = unpack("H*", $data[5]);
	$number[6] = unpack("H*", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("i", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 2);
	$data[6] = fread($fo, 2);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("s", $data[5]);
	$number[6] = unpack("s", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 512);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 2);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[0], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[0] = unpack("a".$pos, $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("s", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("H*", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 1);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("c", $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("f", $data[5]);
	$number[6] = unpack("f", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	fwrite($fp, "\r\n");
}

fclose($fp);
$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliskillforce\\cliclskill.txt","w+");
fwrite($fp, "string[32]\tEND\r\nName\r\n");
for($i=0;$i < $count[1];$i++){
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 1);
	$data[7] = fread($fo, 32);
	$data[8] = fread($fo, 32);
	$data[9] = fread($fo, 32);
	$data[10] = fread($fo, 32);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("c", $data[6]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[7], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[7] = unpack("a".$pos, $data[7]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[8], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[8] = unpack("a".$pos, $data[8]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[9], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[9] = unpack("a".$pos, $data[9]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[10], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[10] = unpack("a".$pos, $data[10]);
	
	for($j = 0; $j < 11; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	for($a=0;$a < 7;$a++){
	for($j=0;$j < 10;$j++){
		$data[0] = fread($fo, 1);
		$number[0] = unpack("c", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	$data[0] = fread($fo, 2);
	$number[0] = unpack("s", $data[0]);
	fwrite($fp, $number[0][1]."\t");
	for($j=0;$j < 7;$j++){
		$data[0] = fread($fo, 4);
		$number[0] = unpack("f", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("H*", $data[3]);
	$number[4] = unpack("H*", $data[4]);
	$number[5] = unpack("H*", $data[5]);
	$number[6] = unpack("H*", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("i", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 2);
	$data[6] = fread($fo, 2);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("s", $data[5]);
	$number[6] = unpack("s", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 512);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 2);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[0], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[0] = unpack("a".$pos, $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("s", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("H*", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 1);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("c", $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("f", $data[5]);
	$number[6] = unpack("f", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	fwrite($fp, "\r\n");
}

fclose($fp);
$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliskillforce\\clibull.txt","w+");
fwrite($fp, "string[32]\tEND\r\nName\r\n");
for($i=0;$i < $count[1];$i++){
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 1);
	$data[7] = fread($fo, 32);
	$data[8] = fread($fo, 32);
	$data[9] = fread($fo, 32);
	$data[10] = fread($fo, 32);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("c", $data[6]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[7], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[7] = unpack("a".$pos, $data[7]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[8], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[8] = unpack("a".$pos, $data[8]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[9], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[9] = unpack("a".$pos, $data[9]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[10], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[10] = unpack("a".$pos, $data[10]);
	
	for($j = 0; $j < 11; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	for($a=0;$a < 7;$a++){
	for($j=0;$j < 10;$j++){
		$data[0] = fread($fo, 1);
		$number[0] = unpack("c", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	$data[0] = fread($fo, 2);
	$number[0] = unpack("s", $data[0]);
	fwrite($fp, $number[0][1]."\t");
	for($j=0;$j < 7;$j++){
		$data[0] = fread($fo, 4);
		$number[0] = unpack("f", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("H*", $data[3]);
	$number[4] = unpack("H*", $data[4]);
	$number[5] = unpack("H*", $data[5]);
	$number[6] = unpack("H*", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("i", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 2);
	$data[6] = fread($fo, 2);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("s", $data[5]);
	$number[6] = unpack("s", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 512);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 2);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[0], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[0] = unpack("a".$pos, $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("s", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("H*", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 1);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("c", $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("f", $data[5]);
	$number[6] = unpack("f", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	fwrite($fp, "\r\n");
}
fclose($fp);
$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliskillforce\\clipot.txt","w+");
fwrite($fp, "string[32]\tEND\r\nName\r\n");
for($i=0;$i < $count[1];$i++){
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 1);
	$data[7] = fread($fo, 32);
	$data[8] = fread($fo, 32);
	$data[9] = fread($fo, 32);
	$data[10] = fread($fo, 32);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("c", $data[6]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[7], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[7] = unpack("a".$pos, $data[7]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[8], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[8] = unpack("a".$pos, $data[8]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[9], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[9] = unpack("a".$pos, $data[9]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[10], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[10] = unpack("a".$pos, $data[10]);
	
	for($j = 0; $j < 11; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	for($a=0;$a < 7;$a++){
	for($j=0;$j < 10;$j++){
		$data[0] = fread($fo, 1);
		$number[0] = unpack("c", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	$data[0] = fread($fo, 2);
	$number[0] = unpack("s", $data[0]);
	fwrite($fp, $number[0][1]."\t");
	for($j=0;$j < 7;$j++){
		$data[0] = fread($fo, 4);
		$number[0] = unpack("f", $data[0]);
		fwrite($fp, $number[0][1]."\t");
	}
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("H*", $data[3]);
	$number[4] = unpack("H*", $data[4]);
	$number[5] = unpack("H*", $data[5]);
	$number[6] = unpack("H*", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("i", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 4);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 2);
	$data[6] = fread($fo, 2);
	$data[7] = fread($fo, 2);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("i", $data[0]);
	$number[1] = unpack("i", $data[1]);
	$number[2] = unpack("i", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("s", $data[5]);
	$number[6] = unpack("s", $data[6]);
	$number[7] = unpack("s", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 512);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 2);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data[0], $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number[0] = unpack("a".$pos, $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("s", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("i", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("H*", $data[7]);
	$number[8] = unpack("H*", $data[8]);
	$number[9] = unpack("H*", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 4);
	$data[1] = fread($fo, 4);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 1);
	$data[4] = fread($fo, 1);
	$data[5] = fread($fo, 1);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 1);
	$number[0] = unpack("H*", $data[0]);
	$number[1] = unpack("H*", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("c", $data[3]);
	$number[4] = unpack("c", $data[4]);
	$number[5] = unpack("c", $data[5]);
	$number[6] = unpack("i", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("i", $data[8]);
	$number[9] = unpack("c", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	$data[0] = fread($fo, 1);
	$data[1] = fread($fo, 1);
	$data[2] = fread($fo, 1);
	$data[3] = fread($fo, 4);
	$data[4] = fread($fo, 4);
	$data[5] = fread($fo, 4);
	$data[6] = fread($fo, 4);
	$data[7] = fread($fo, 4);
	$data[8] = fread($fo, 4);
	$data[9] = fread($fo, 4);
	$number[0] = unpack("c", $data[0]);
	$number[1] = unpack("c", $data[1]);
	$number[2] = unpack("c", $data[2]);
	$number[3] = unpack("i", $data[3]);
	$number[4] = unpack("i", $data[4]);
	$number[5] = unpack("f", $data[5]);
	$number[6] = unpack("f", $data[6]);
	$number[7] = unpack("i", $data[7]);
	$number[8] = unpack("f", $data[8]);
	$number[9] = unpack("f", $data[9]);
	for($j = 0; $j < 10; $j++){
		fwrite($fp, $number[$j][1]."\t");
	}
	fwrite($fp, "\r\n");
}
fclose($fp);
fclose($fo);
if(defined('GU'))
{
$fo = fopen($installpath."unpacker\\ndskillforce.dat", "rb");
$fp = fopen($installpath."unpacker\\cliskillforce\\ndforce.txt","w+");
decode($fp);
$fp = fopen($installpath."unpacker\\cliskillforce\\ndskill.txt","w+");
decode($fp);
$fp = fopen($installpath."unpacker\\cliskillforce\\ndclassskill.txt","w+");
decode($fp);
$fp = fopen($installpath."unpacker\\cliskillforce\\ndbullet.txt","w+");
decode($fp);
$fp = fopen($installpath."unpacker\\cliskillforce\\ndpotion.txt","w+");
decode($fp);
fclose($fo);
}

echo "<br>Script finished";