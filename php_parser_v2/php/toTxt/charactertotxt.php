<?php
include './include.php'; // necessary include

function xehconv($code)
{
	$row = str_split($code, 2);
	$preconv = $row[3].$row[2].$row[1].$row[0];
	$row = str_split($preconv);
	$skip = 3;
	$trans = array("a"=>"A", "b"=>"B", "c"=>"C", "d"=>"D", "e"=>"E", "f"=>"F");
    $converted = '';
	for($i = $skip; $i < 8; $i++)
	{
		$converted .= $row[$i];
	}
	return strtr($converted, $trans);
}

$fp = fopen($installpath."unpacker\\Character.dat", "rb");

$nblock = fread($fp, 4);
$nsize = fread($fp, 4);
$count = unpack("i", $nblock);
$file = fopen($installpath."unpacker\\clientsource\\classclient.txt","w+");
$trans = array("." => ",");
for($a=0;$a < $count[1]; $a++)
{
	$raw = fread($fp, 1);
	$data[1] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[2] = unpack("c", $raw);
	$raw = fread($fp, 2);
	$data[3] = unpack("s", $raw);
	$raw = fread($fp, 4);
	$data[4] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[5] = unpack("H*", $raw);
	$raw = fread($fp, 32);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($raw, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$data[6] = unpack("a".$pos, $raw);
	$raw = fread($fp, 4);
	$data[7] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[8] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[9] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[10] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[11] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[12] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[13] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[14] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[15] = unpack("i", $raw);
	$raw = fread($fp, 32);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($raw, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$data[16] = unpack("a".$pos, $raw);
	$raw = fread($fp, 32);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($raw, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$data[17] = unpack("a".$pos, $raw);
	$raw = fread($fp, 32);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($raw, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$data[18] = unpack("a".$pos, $raw);
	$raw = fread($fp, 4);
	$data[19] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[20] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[21] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[22] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[23] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[24] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[25] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[26] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[27] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[28] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[29] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[30] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[31] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[32] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[33] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[34] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[35] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[36] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[37] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[38] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[39] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[40] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[41] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[42] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[43] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[44] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[45] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[46] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[47] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[48] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[49] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[50] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[51] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[52] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[53] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[54] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[55] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[56] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[57] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[58] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[59] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[60] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[61] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[62] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[63] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[64] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[65] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[66] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[67] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[68] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[69] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[70] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[71] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[72] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[73] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[74] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[75] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[76] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[77] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[78] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[79] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[80] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[81] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[82] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[83] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[84] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[85] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[86] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[87] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[88] = unpack("i", $raw);
	$raw = fread($fp, 4);
	$data[90] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[92] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[94] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[96] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[98] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[100] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[102] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[104] = unpack("H*", $raw);
	$raw = fread($fp, 4);
	$data[106] = unpack("H*", $raw);
	$raw = fread($fp, 1);
	$data[107] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[108] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[109] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[110] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[111] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[112] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[113] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[114] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[115] = unpack("c", $raw);
	$raw = fread($fp, 1);
	$data[116] = unpack("c", $raw);
	$raw = fread($fp, 2);
	$data[117] = unpack("s", $raw);
	$raw = fread($fp, 4);
	$data[118] = unpack("i", $raw);
	$raw = fread($fp, 1024);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($raw, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$data[119] = unpack("a".$pos, $raw);
	for($i = 1; $i < 120; $i++) {
    	if (isset($data[$i][1])) {
        	fwrite($file, $data[$i][1] . "\t");
    	} else {
        	fwrite($file, "\t");
    	}	
    }	
	fwrite($file, "\r\n");
}
fclose($file);

$file = fopen($installpath."unpacker\\clientsource\\monsterclient.txt","w+");
$skip = 0;
if(defined('GU'))
	$sparam = 1;
else
	$sparam = 3;
for($i = 0; $i < $sparam; $i++)
{	
	$nblock = fread($fp, 4);
	$nsize = fread($fp, 4);
	$count = unpack("i", $nblock);
	$size = unpack("i", $nsize);
	$skip = $size[1] * $count[1];
	fseek($fp, $skip, SEEK_CUR);
}

$nblock = fread($fp, 4);
$nsize = fread($fp, 4);
$count = unpack("i", $nblock);
$trans = array("." => ",");
for($a=0;$a < $count[1]; $a++)
{
	$nid = fread($fp, 4);
	$data[0] = unpack("i", $nid);
	$nmonid = fread($fp, 4);
	$data[1] = unpack("H*", $nmonid);
	$data[1][1] = xehconv($data[1][1]);
	$cstrmonname = fread($fp, 32);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($cstrmonname, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$data[2] = unpack("a".$pos, $cstrmonname);
	$nrace = fread($fp, 1);
	$data[3] = unpack("c", $nrace);
	$ngrade = fread($fp, 1);
	$data[4] = unpack("c", $ngrade);
	$nlevel = fread($fp, 1);
	$data[5] = unpack("c", $nlevel);
	$nnone1 = fread($fp, 1);
	$data[6] = unpack("c", $nnone1);
	$nhp = fread($fp, 4);
	$data[7] = unpack("i", $nhp);
	if(!defined('GU')){
	$nhz1 = fread($fp, 4);
	$data[8] = unpack("i", $nhz1);
	$nhz2 = fread($fp, 4);
	$data[9] = unpack("i", $nhz2);
	$nhz3 = fread($fp, 4);
	$data[10] = unpack("i", $nhz3);
	}
	$nattspd = fread($fp, 4);
	$data[11] = unpack("i", $nattspd);
	$nattrangetype = fread($fp, 4);
	$data[12] = unpack("i", $nattrangetype);
	$fAttExt = fread($fp, 4);
	$data[13] = unpack("f", $fAttExt);
	$floatVal = $data[13][1];
	if (abs(fmod($floatVal, 1.0)) < 1e-12) {
    	$data[13][1] = (string)(int)$floatVal;
	} else {
		$data[13][1] = sprintf('%.12g', $floatVal); //use php 5 style: up to 12 significant digits
	}
	$data[13][1] = strtr($data[13][1], $trans);
	$nmovspd = fread($fp, 1);
	$data[14] = unpack("c", $nmovspd);
	$nwarmovspd = fread($fp, 1);
	$data[15] = unpack("c", $nwarmovspd);
	$nwidth = fread($fp, 1);
	$data[16] = unpack("c", $nwidth);
	$nnone2 = fread($fp, 1);
	$data[17] = unpack("c", $nnone2);
	$fsizerate = fread($fp, 4);
	$data[18] = unpack("f", $fsizerate);
	$floatVal = $data[18][1];
	if (abs(fmod($floatVal, 1.0)) < 1e-12) {
    	$data[18][1] = (string)(int)$floatVal;
	} else {
		$data[18][1] = sprintf('%.12g', $floatVal); //use php 5 style: up to 12 significant digits
	}
	$data[18][1] = strtr($data[18][1], $trans);
	$nhz4 = fread($fp, 4);
	$data[19] = unpack("i", $nhz4);
	$nmonstercond = fread($fp, 4);
	$data[20] = unpack("i", $nmonstercond);
	$neffectcond = fread($fp, 4);
	$data[21] = unpack("H*", $neffectcond);
	$nattefftype = fread($fp, 4);
	$data[22] = unpack("i", $nattefftype);
	$ndefefftype = fread($fp, 4);
	$data[23] = unpack("i", $ndefefftype);
	$noffensive = fread($fp, 4);
	$data[24] = unpack("i", $noffensive);
	$nelement = fread($fp, 4);
	$data[25] = unpack("i", $nelement);
	if(!defined('GU'))
	{
	$neffectcond = fread($fp, 4);
	$data[26] = unpack("H*", $neffectcond);
	$neffectcond = fread($fp, 4);
	$data[27] = unpack("H*", $neffectcond);
	$neffectcond = fread($fp, 4);
	$data[28] = unpack("H*", $neffectcond);
	$noffensive = fread($fp, 4);
	$data[29] = unpack("i", $noffensive);
	$nelement = fread($fp, 4);
	$data[30] = unpack("i", $nelement);
	for($i = 0; $i < 31; $i++)
	{
		fwrite($file, $data[$i][1]."\t");
	}
	}
	else
	{
	for($i = 0; $i < 15; $i++)
	{
		$neffectcond = fread($fp, 4);
		$data[26 + $i * 2] = unpack("i", $neffectcond);
		$neffectcond = fread($fp, 4);
		$data[27 + $i * 2] = unpack("H*", $neffectcond);
	}
	$noffensive = fread($fp, 4);
	$data[56] = unpack("i", $noffensive);
	$nelement = fread($fp, 4);
	$data[57] = unpack("i", $nelement);
	for($i = 0; $i < 8; $i++)
	{
		fwrite($file, $data[$i][1]."\t");
	}
	for($i = 11; $i < 58; $i++)
	{
		fwrite($file, $data[$i][1]."\t");
	}
	}
	fwrite($file, "\r\n");
}
fclose($file);
fclose($fp);

if(defined('GU'))
{
	$fp = fopen($installpath."unpacker\\ndcharacter.dat", "rb");
	$file = fopen($installpath."unpacker\\clientsource\\ndclassclient.txt","w+");
	$nblock = fread($fp, 4);
	$nsize = fread($fp, 4);
	$count = unpack("i", $nblock);
	for($i = 0; $i < $count[1]; $i++)
	{
		$raw = fread($fp, 32);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($raw, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$data[1] = unpack("a".$pos, $raw);
		$raw = fread($fp, 1024);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($raw, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$data[2] = unpack("a".$pos, $raw);
		fwrite($file, $data[1][1]."\t".$data[2][1]."\r\n");
	}
	fclose($file);
	
	$nblock = fread($fp, 4);
	$nsize = fread($fp, 4);
	$count = unpack("i", $nblock);
	$unsize = unpack("i", $nsize);
	fseek($fp, $count[1] * $unsize[1], SEEK_CUR);
	$file = fopen($installpath."unpacker\\clientsource\\ndmonsterclient.txt","w+");
	$nblock = fread($fp, 4);
	$nsize = fread($fp, 4);
	$count = unpack("i", $nblock);
	for($i = 0; $i < $count[1]; $i++)
	{
		$raw = fread($fp, 32);
		$pos = 0;
		$findme = "\x00";
		$pos = strpos($raw, $findme);
		$pos = ($pos == 0) ? "*" : $pos;
		$data[1] = unpack("a".$pos, $raw);
		fwrite($file, $data[1][1]."\r\n");
	}
	fclose($file);
	fclose($fp);
}

echo "<br>Script finished";