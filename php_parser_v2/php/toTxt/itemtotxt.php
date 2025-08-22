<?php
include './include.php'; // necessary include

function xehconv($code)
{
	$row = str_split($code, 2);
	$preconv = $row[3].$row[2].$row[1].$row[0];
	$row = str_split($preconv);
	$skip = 0;
    $converted = '';
	$trans = array("a"=>"A", "b"=>"B", "c"=>"C", "d"=>"D", "e"=>"E", "f"=>"F");
	for($i = 0; $i < 8; $i ++)
	{
		if($row[$i] == 0 && $skip != 2)
			$skip++;
		else
			break;
	}
	for($i = $skip; $i < 8; $i++)
	{
		$converted .= $row[$i];
	}
	return strtr($converted, $trans);
}

$data_file = $installpath."unpacker\\Item.dat";
$struct_file = $installpath."unpacker\\Item2.strs";
$fp = fopen($data_file, "rb");
$struct_load = file($struct_file, FILE_SKIP_EMPTY_LINES);
$start=0;
$childcnt=0;
$type=0;
for($j=0; $j < sizeof($struct_load); $j++)
{
	$temp= split(" ", trim($struct_load[$j]));
	if($temp[0]!="child" && $start==0)
		continue;
	elseif($temp[0]=="child"){
		$start=1;
		$orderarr[$childcnt]= $temp['1'];
		$childcnt++;
		echo "Queuing. ".$temp[1]."<br>";
		flush();
	}
	elseif($temp[0]=="struct"){
		$size=0;
		$type++;
		$sizearr[$type][$size]=$temp['1'];
		$typearr[$type][$size]=$temp['1'];
		$size++;
		echo "Structure loading. ".$temp[1]."<br>";
		flush();
		continue;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="i32"){
		$sizearr[$type][$size]=4;
		$typearr[$type][$size]="i";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="i16"){
		$sizearr[$type][$size]=2;
		$typearr[$type][$size]="s";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="i8"){
		$sizearr[$type][$size]=1;
		$typearr[$type][$size]="c";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="u32"){
		$sizearr[$type][$size]=4;
		$typearr[$type][$size]="I";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="u16"){
		$sizearr[$type][$size]=2;
		$typearr[$type][$size]="S";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="u8"){
		$sizearr[$type][$size]=1;
		$typearr[$type][$size]="C";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="x32"){
		$sizearr[$type][$size]=4;
		$typearr[$type][$size]="H*";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="float"){
		$sizearr[$type][$size]=4;
		$typearr[$type][$size]="f";
		$size++;
	}
	elseif($temp[0]!="struct"&&$temp[0]=="cstr"){
		for($i=1;$i < 1025;$i++){
			if($temp[1]=="[len=".$i."]"){
				$sizearr[$type][$size]=$i;
				$typearr[$type][$size]="a";
				$size++;
				}
		}
	}	
}
echo "Structure file loaded.<br>";
echo "Conversion started.<br>";
flush();

for($a=0;$a < 46;$a++){
	$nsomeinfo = fread($fp, 10);
	$nblock = fread($fp, 4);
//$ncolumn = fread($fp, 4); //��� ���������
	$sizeofblock = fread($fp, 4);
	$count = unpack("i", $nblock);

	$fmd5 = fopen($installpath."unpacker\\clientsource\\".$a."list.txt","w+");
	for($b=1;$b <= $type; $b++){
		if($orderarr[$a]!=$typearr[$b][0])
			continue;
		else{
			for($i=0;$i < $count[1];$i++){
				for($j=1;$j < count($sizearr[$b]); $j++){
						$data[$i][$j] = fread($fp, $sizearr[$b][$j]);
				}
			}
			for($k=0;$k < $count[1];$k++){
				for($l=1;$l < count($typearr[$b]); $l++){
					if($typearr[$b][$l] == "a")
					{
						$findme = "\x00";
						$pos = strpos($data[$k][$l], $findme);
						$pos = ($pos == 0) ? "*" : $pos;
						$number = unpack("a".$pos, $data[$k][$l]);
					}
					else
						$number = unpack($typearr[$b][$l], $data[$k][$l]);
					if($typearr[$b][$l] == "H*" && $l == 4 && $a < 44)
						$number[1] = xehconv($number[1]);
					fwrite($fmd5, "$number[1]\t");
				}
				fwrite($fmd5, "\r\n");
			}
		}
	}
echo "$a of $childcnt complete<br>";
flush();
fclose($fmd5);
}
if(!defined('GU'))
{
$nsomeinfo = fread($fp, 378);
$nsomeinfo = fread($fp, 10);
for($a=0;$a < 46 ;$a++){
//	$nsomeinfo = fread($fp, 10);
	$nblock = fread($fp, 4);
//$ncolumn = fread($fp, 4); //��� ���������
//	$sizeofblock = fread($fp, 4);
	$count = unpack("i", $nblock);

	$fmd5 = fopen($installpath."unpacker\\clientsource\\".$a."desc.txt","w+");
	for($i=0;$i < $count[1];$i++){
		$data[$i][0] = fread($fp, 4);
		$data[$i][1] = fread($fp, 4);
		$data[$i][2] = fread($fp, 4);
		$len = unpack("i", $data[$i][2]);
		$data[$i][3] = fread($fp, $len[1]);
		$number0 = unpack("i", $data[$i][0]);
		//$number1 = unpack("H*", $data[$i][1]);
		$number3 = unpack("a*", $data[$i][3]);
		fwrite($fmd5, "$number0[1]\t");
		//fwrite($fmd5, "$number1[1]\t");
		fwrite($fmd5, "$number3[1]\r\n");
	}
		
	
echo "$a of 45 completed<br>";
flush();
fclose($fmd5);
}

	$nsomeinfo = fread($fp, 10);
	$nblock = fread($fp, 4);
//$ncolumn = fread($fp, 4); //��� ���������
//	$sizeofblock = fread($fp, 4);
	$count = unpack("i", $nblock);

	$fmd5 = fopen($installpath."unpacker\\clientsource\\dungeon.txt","w+");
	for($i=0;$i < $count[1];$i++){
		$data[$i][0] = fread($fp, 4);
		$data[$i][1] = fread($fp, 4);
		$data[$i][2] = fread($fp, 4);
		$len = unpack("i", $data[$i][2]);
		$data[$i][3] = fread($fp, $len[1]);
		$number0 = unpack("i", $data[$i][0]);
		$number1 = unpack("H*", $data[$i][1]);
		$number3 = unpack("a*", $data[$i][3]);
		fwrite($fmd5, "$number0[1]\t");
		fwrite($fmd5, "$number1[1]\t");
		fwrite($fmd5, "$number3[1]\r\n");
	}

fclose($fp);
}
else
{
fclose($fp);
$data_file = $installpath."unpacker\\nditem.dat";
$fp = fopen($data_file, "rb");



for($a=0;$a < 44 ;$a++){
//	$nsomeinfo = fread($fp, 10);
	$nblock = fread($fp, 4);
//$ncolumn = fread($fp, 4); //��� ���������
//	$sizeofblock = fread($fp, 4);
	$count = unpack("i", $nblock);
	$fmd5 = fopen($installpath."unpacker\\clientsource\\".$a."name.txt","w+");
	for($i=0;$i < $count[1];$i++){
		$data[$i][0] = fread($fp, 64);
		$number = unpack("a*", $data[$i][0]);
		fwrite($fmd5, "$number[1]\r\n");
	}
		
	
echo "$a of 44 completed<br>";
flush();
fclose($fmd5);
}
for($a=0;$a < 46 ;$a++){
//	$nsomeinfo = fread($fp, 10);
	$nblock = fread($fp, 4);
//$ncolumn = fread($fp, 4); //��� ���������
//	$sizeofblock = fread($fp, 4);
	$count = unpack("i", $nblock);
	$fmd5 = fopen($installpath."unpacker\\clientsource\\".$a."desc.txt","w+");
	for($i=0;$i < $count[1];$i++){
		$data[$i][0] = fread($fp, 4);
		$data[$i][1] = fread($fp, 4);
		$data[$i][2] = fread($fp, 4);
		$len = unpack("i", $data[$i][2]);
		$data[$i][3] = fread($fp, $len[1]);
		$number0 = unpack("i", $data[$i][0]);
		//$number1 = unpack("H*", $data[$i][1]);
		$number3 = unpack("a*", $data[$i][3]);
		fwrite($fmd5, "$number0[1]\t");
		//fwrite($fmd5, "$number1[1]\t");
		fwrite($fmd5, "$number3[1]\r\n");
	}
		
	
echo "$a of 45 cmpleted<br>";
flush();
fclose($fmd5);
}

//	$nsomeinfo = fread($fp, 10);
	$nblock = fread($fp, 4);
//$ncolumn = fread($fp, 4); //��� ���������
//	$sizeofblock = fread($fp, 4);
	$count = unpack("i", $nblock);
	$fmd5 = fopen($installpath."unpacker\\clientsource\\dungeon.txt","w+");
	for($i=0;$i < $count[1];$i++){
		$data[$i][0] = fread($fp, 4);
		$data[$i][1] = fread($fp, 64);
		$data[$i][2] = fread($fp, 4);
		$len = unpack("i", $data[$i][2]);
		$data[$i][3] = fread($fp, $len[1]);
		$number0 = unpack("i", $data[$i][0]);
		$number1 = unpack("a*", $data[$i][1]);
		$number3 = unpack("a*", $data[$i][3]);
		fwrite($fmd5, "$number0[1]\t");
		fwrite($fmd5, "$number1[1]\t");
		fwrite($fmd5, "$number3[1]\r\n");
	}

fclose($fmd5);
fclose($fp);
}
echo "<br>Script finished";