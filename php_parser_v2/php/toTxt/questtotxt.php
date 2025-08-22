<?php
include './include.php'; // necessary include

$incname = "unpacker\\Quest.dat"; //��� �����

$data_file = $installpath.$incname;
$fo = fopen($data_file, "rb");
for($cons = 0; $cons < 7; $cons++)
{
	$nblock = fread($fo, 4);
	$fsize = fread($fo, 4);
	$count = unpack("i", $nblock);

	$fp = fopen($installpath."unpacker\\cliquest\\quest".$cons.".txt","w+");
	//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
	for($i=0;$i < $count[1];$i++)
	{
		for($j = 0; $j < 84; $j++)
		{
			$data[$j] = fread($fo, 4);
		}
		$number0 = unpack("i", $data[0]);
		$number1 = unpack("H*", $data[1]);
		fwrite($fp, $number0[1]."\t");
		fwrite($fp, $number1[1]."\t");
		for($j = 2; $j < 84; $j ++)
		{
			$tmpunp = unpack("i", $data[$j]);
			fwrite($fp, $tmpunp[1]."\t");
		}
		fwrite($fp, "\r\n");
	}
	fclose($fp);
}


$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliquest\\questmain".$cons.".txt","w+");
//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
for($i=0;$i < $count[1];$i++){
	$re1 = fread($fo, 4);
	$re2 = fread($fo, 4);
	$re3 = fread($fo, 1);
	$re4 = fread($fo, 1);
	$re5 = fread($fo, 1);
	$re6 = fread($fo, 1);
	$re7 = fread($fo, 4);	
	$un1 = unpack("i", $re1);
	$un2 = unpack("H*", $re2);
	$un3 = unpack("c", $re3);
	$un4 = unpack("c", $re4);
	$un5 = unpack("c", $re5);
	$un6 = unpack("c", $re6);
	$un7 = unpack("i", $re7);
	fwrite($fp, $un1[1]."\t");
	fwrite($fp, $un2[1]."\t");
	fwrite($fp, $un3[1]."\t");
	fwrite($fp, $un4[1]."\t");
	fwrite($fp, $un5[1]."\t");
	fwrite($fp, $un6[1]."\t");
	fwrite($fp, $un7[1]."\t");
	for($j = 0; $j < 3; $j++){
		$re1 = fread($fo, 4);
		$re2 = fread($fo, 4);
		$re3 = fread($fo, 4);
		$re4 = fread($fo, 4);
		$re5 = fread($fo, 4);
		$re6 = fread($fo, 4);
		$re7 = fread($fo, 4);
		$re8 = fread($fo, 4);
		$un1 = unpack("i", $re1);
		$un2 = unpack("H*", $re2);
		$un3 = unpack("H*", $re3);
		$un4 = unpack("H*", $re4);
		$un5 = unpack("i", $re5);
		$un6 = unpack("i", $re6);
		$un7 = unpack("i", $re7);
		$un8 = unpack("i", $re8);
		fwrite($fp, $un1[1]."\t");
		fwrite($fp, $un2[1]."\t");
		fwrite($fp, $un3[1]."\t");
		fwrite($fp, $un4[1]."\t");
		fwrite($fp, $un5[1]."\t");
		fwrite($fp, $un6[1]."\t");
		fwrite($fp, $un7[1]."\t");
		fwrite($fp, $un8[1]."\t");
	}
	$re1 = fread($fo, 8);
	$re2 = fread($fo, 4);
	$re3 = fread($fo, 4);
	$re4 = fread($fo, 4);
	$re5 = fread($fo, 4);
	$un1 = unpack("d", $re1);
	$un2 = unpack("i", $re2);
	$un3 = unpack("i", $re3);
	$un4 = unpack("i", $re4);
	$un5 = unpack("i", $re5);
	$val = $un1[1];
	if (is_finite($val) && abs($val) >= 1e12) {
    	fwrite($fp, sprintf("%.11E\t", $val)); //use php 5 style
	} else {
    	fwrite($fp, $val."\t");
	}
	fwrite($fp, $un2[1]."\t");
	fwrite($fp, $un3[1]."\t");
	fwrite($fp, $un4[1]."\t");
	fwrite($fp, $un5[1]."\t");
	for($j = 0; $j < 6; $j++){
		$re1 = fread($fo, 4);
		$re2 = fread($fo, 4);
		$re3 = fread($fo, 4);
		$un1 = unpack("i", $re1);
		$un2 = unpack("H*", $re2);
		$un3 = unpack("i", $re3);
		fwrite($fp, $un1[1]."\t");
		fwrite($fp, $un2[1]."\t");
		fwrite($fp, $un3[1]."\t");
	}
	for($j = 0; $j < 41; $j++){
		$re1 = fread($fo, 4);
		$un1 = unpack("i", $re1);
		fwrite($fp, $un1[1]."\t");
	}
	for($j = 0; $j < 3; $j++){
		$re1 = fread($fo, 4);
		$re2 = fread($fo, 4);
		$re3 = fread($fo, 4);
		$un1 = unpack("i", $re1);
		$un2 = unpack("i", $re2);
		$un3 = unpack("H*", $re3);
		fwrite($fp, $un1[1]."\t");
		fwrite($fp, $un2[1]."\t");
		fwrite($fp, $un3[1]."\t");
	}
	$re1 = fread($fo, 4);
	$re2 = fread($fo, 4);
	$re3 = fread($fo, 4);
	$re4 = fread($fo, 4);
	$un1 = unpack("i", $re1);
	$un2 = unpack("i", $re2);
	$un3 = unpack("i", $re3);
	$un4 = unpack("H*", $re4);
	fwrite($fp, $un1[1]."\t");
	fwrite($fp, $un2[1]."\t");
	fwrite($fp, $un3[1]."\t");
	fwrite($fp, $un4[1]."\r\n");
}
fclose($fp);

if(!defined('GU'))
{
$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliquest\\quest_desc_service.txt","w+");
//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
for($i=0;$i < $count[1];$i++){
	$data1 =fread($fo, 4);
	$data2 =fread($fo, 4);
	$data3 =fread($fo, 4);
	$data4 =fread($fo, 4);
	$number1 = unpack("i", $data1);
	$number2 = unpack("H*", $data2);
	$number3 = unpack("i", $data3);
	$n[$i] =  $number3[1];
	$number4 = unpack("H*", $data4);
	fwrite($fp, $number1[1]."\t");
	fwrite($fp, $number2[1]."\t");
	fwrite($fp, $number3[1]."\t");
	fwrite($fp, $number4[1]."\r\n");
}
$param = $count[1];

fclose($fp);

$fp = fopen($installpath."unpacker\\cliquest\\quest_desc.txt","w+");
/*
$i = 0;
while($i != 579909){
	$test=fread($fo, 1);
	$check = unpack("H2", $test);
	if($check[1]=="00"){
		$string = "\r\n";
	}
	else{
		$string1 = unpack("a1", $test);
		$string = $string1[1];
	}
	fwrite($fp, $string);
	$i++;
}
*/

for($i = 0; $i < $param; $i++){
	$rea = fread($fo, $n[$i]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($rea, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$unp = unpack("a".$pos, $rea);
	$trans = array("\n" => " ");
	$result = strtr($unp[1], $trans);
	fwrite($fp, $i."\t".$result."\r\n");
}

fclose($fp);
}

$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliquest\\questitem.txt","w+");
//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
for($i=0;$i < $count[1];$i++){
	$hcode = fread($fo, 4);
	$hcodes = fread($fo, 4);
	$path = fread($fo, 4);
	$fcode = fread($fo, 32);
	$number0 = unpack("i", $hcode);
	$number02 = unpack("H*", $hcodes);
	$number1 = unpack("i", $path);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($fcode, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number2 = unpack("a".$pos, $fcode);
	fwrite($fp, $number0[1]."\t");
	fwrite($fp, $number02[1]."\t");
	fwrite($fp, $number1[1]."\t");
	fwrite($fp, $number2[1]."\r\n");
}
fclose($fp);

$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliquest\\questorder_bel.txt","w+");
//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
for($i=0;$i < $count[1];$i++){
	$hcode = fread($fo, 4);
	$number0 = unpack("i", $hcode);
	fwrite($fp, $number0[1]."\r\n");

}
fclose($fp);
$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliquest\\questorder_cor.txt","w+");
//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
for($i=0;$i < $count[1];$i++){
	$hcode = fread($fo, 4);
	$number0 = unpack("i", $hcode);
	fwrite($fp, $number0[1]."\r\n");

}
fclose($fp);
$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliquest\\questorder_acc.txt","w+");
//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
for($i=0;$i < $count[1];$i++){
	$hcode = fread($fo, 4);
	$number0 = unpack("i", $hcode);
	fwrite($fp, $number0[1]."\r\n");

}
fclose($fp);
fclose($fo);
if(defined('GU'))
{
$fo = fopen($installpath."unpacker\\ndquest.dat", "rb");

$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);
$fp = fopen($installpath."unpacker\\cliquest\\ndquestitem.txt","w+");
for($i=0;$i < $count[1];$i++){
	$data1 =fread($fo, 32);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($data1, $findme);
	$pos = ($pos == 0) ? "*" : $pos;
	$number1 = unpack("a".$pos, $data1);
	fwrite($fp, $number1[1]."\r\n");
}
fclose($fp);

$nblock = fread($fo, 4);
$fsize = fread($fo, 4);
$count = unpack("i", $nblock);

$fp = fopen($installpath."unpacker\\cliquest\\quest_desc_service.txt","w+");
//fwrite($fp, "dword\tclcode\t1\tstore\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\r\n0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t\r\n");
for($i=0;$i < $count[1];$i++){
	$data1 =fread($fo, 4);
	$data2 =fread($fo, 4);
	$data3 =fread($fo, 4);
	$data4 =fread($fo, 4);
	$number1 = unpack("i", $data1);
	$number2 = unpack("H*", $data2);
	$number3 = unpack("i", $data3);
	$n[$i] =  $number3[1];
	$number4 = unpack("H*", $data4);
	fwrite($fp, $number1[1]."\t");
	fwrite($fp, $number2[1]."\t");
	fwrite($fp, $number3[1]."\t");
	fwrite($fp, $number4[1]."\r\n");
}
$param = $count[1];

fclose($fp);

$fp = fopen($installpath."unpacker\\cliquest\\quest_desc.txt","w+");
/*
$i = 0;
while($i != 579909){
	$test=fread($fo, 1);
	$check = unpack("H2", $test);
	if($check[1]=="00"){
		$string = "\r\n";
	}
	else{
		$string1 = unpack("a1", $test);
		$string = $string1[1];
	}
	fwrite($fp, $string);
	$i++;
}
*/

for($i = 0; $i < $param; $i++){
	$rea = fread($fo, $n[$i]);
	$pos = 0;
	$findme = "\x00";
	$pos = strpos($rea, $findme);
	$pos = ($pos === false) ? strlen($rea) : $pos;
	$unp = unpack("a".$pos, $rea);
	$trans = array("\n" => " ");
	$result = strtr($unp[1], $trans);
	fwrite($fp, $i."\t".$result."\r\n");
}

fclose($fp);
}
echo "<br>Script finished";