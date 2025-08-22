<?php
include './include.php'; // necessary include


$smthhex = pack("C", 241);
$stop = false;

echo str_repeat(" ", 1024)."<br>";
echo str_repeat(" ", 1024)."<br>";

if(!file_exists("./".VERSION."itemmd5.md5"))
{
	touch("./".VERSION."itemmd5.md5");
}

$smd5 = fopen("./".VERSION."itemmd5.md5", "r+b");
$noffset = 0;
$fmd5 = md5_file($installpath."in\\Item.edf\\".$patharr[19]."\\UnitFrame.txt");
$noffset = ftell($smd5);
$unp = unpack("H*", fread($smd5, 16));

if($fmd5 == $unp[1])
{
		echo "MD5 hash is same. Skipped: ".$patharr[19]."\\19".$incname."<br>";
		flush();
}
else
{
	echo "Proceed: ".$patharr[19]."\\19".$incname."<br>";
	flush();
	$fo = fopen($installpath."in\\Item.edf\\".$patharr[19]."\\19".$incname, "w+");
	if(defined('GU'))
	{
		$r1 = "clcode\tstring[64]\txeh\tdword\tstb\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tlong\tdword\tfloat\tfloat\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tEND\r\n";
		$r2 = "Code\tName\tModel\tIcon\tCivil\tListID\tMoney\tnone\tStdPrice\tStdPoint\tGoldPoint\tProcPoint\tKillPoint\tStorePrice\tIsExchange\tIsSell\tIsGround\tIsStore\tDescript\tIsExist\tIsCash\tIsTime\tUpLvLim\tFRAType\tMoveRateSpeed\tMoveRateSpeed\tHeight\tWidth\tnone\tUnit_HP\tRepPrice\tHead\tUpper\tLower\tArms\tShoulders\tBack\tBulletArms\tBulletSho\tIsDestroy\tIsRepair\thz";
	
	}
	else
	{
		$r1 = "clcode\tstring[64]\txeh\tdword\tstb\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tlong\tdword\tfloat\tfloat\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tEND\r\n";
		$r2 = "Code\tName\tModel\tIcon\tCivil\tListID\tMoney\tnone\tStdPrice\tStdPoint\tProcPoint\tKillPoint\tStorePrice\tIsExchange\tIsSell\tIsGround\tIsStore\tDescript\tIsExist\tIsCash\tIsTime\tUpLvLim\tFRAType\tMoveRateSpeed\tMoveRateSpeed\tHeight\tWidth\tnone\tUnit_HP\tRepPrice\tHead\tUpper\tLower\tArms\tShoulders\tBack\tBulletArms\tBulletSho\tIsDestroy\tIsRepair\thz";
	}
	fwrite($fo, $r1);
	fwrite($fo, $r2);	
	$file = array(
	0 => $installpath."in\\Item.edf\\".$patharr[37]."\\37".$incname,
	1 => $installpath."in\\Item.edf\\".$patharr[38]."\\38".$incname,
	2 => $installpath."in\\Item.edf\\".$patharr[39]."\\39".$incname,
	3 => $installpath."in\\Item.edf\\".$patharr[40]."\\40".$incname,
	4 => $installpath."in\\Item.edf\\".$patharr[41]."\\41".$incname,
	5 => $installpath."in\\Item.edf\\".$patharr[42]."\\42".$incname,
	6 => $installpath."in\\Item.edf\\".$patharr[43]."\\43".$incname,
	7 => $installpath."in\\Item.edf\\".$patharr[43]."\\43".$incname);
	$ffram = $installpath."in\\Item.edf\\".$patharr[19]."\\UnitFrame.txt";
	$fkeyi = $installpath."in\\Item.edf\\".$patharr[19]."\\UnitKeyItem.txt";
	$file_frame = file($ffram, FILE_SKIP_EMPTY_LINES);
	$file_keyit = file($fkeyi, FILE_SKIP_EMPTY_LINES);
	$scfram = sizeof($file_frame);
	$sckeyi = sizeof($file_keyit);
	$fcnt = 0;
    $key = array();
    $fra = array();
	for($i = 2; $i < $scfram; $i++)
	{
		$fra[$i]=explode("\t", trim($file_frame[$i]));
	}
	for($i = 2; $i < $sckeyi; $i++)
	{	
		$key[$i]=explode("\t", trim($file_keyit[$i]));
	}	
	for($i = 2; $i < $sckeyi; $i++)
	{	
		if(defined('GU'))
		{
			fwrite($fo, "\r\n".$key[$i][0]."\t".$key[$i][4]."\t".$key[$i][2]."\t".$key[$i][3]."\t".$key[$i][5]."\t19\t".$fra[$i][8]."\t0\t".$fra[$i][9]."\t".$fra[$i][10]."\t".$fra[$i][11]."\t".$fra[$i][13]."\t".$fra[$i][12]."\t".$fra[$i][14]."\t".$key[$i][8]."\t".$key[$i][7]."\t".$key[$i][9]."\t".$key[$i][10]."\t".$fcnt."\t0\t0\t0\t0\t".$key[$i][6]."\t".$fra[$i][5]."\t".$fra[$i][5]."\t".$fra[$i][6]."\t".$fra[$i][7]."\t0\t".$fra[$i][2]."\t".$fra[$i][15]."\t");
			$z = 18;
		}
		else
		{		
			fwrite($fo, "\r\n".$key[$i][0]."\t".$key[$i][4]."\t".$key[$i][2]."\t".$key[$i][3]."\t".$key[$i][5]."\t19\t".$fra[$i][8]."\t0\t".$fra[$i][9]."\t".$fra[$i][10]."\t0\t0\t".$fra[$i][11]."\t".$key[$i][8]."\t".$key[$i][7]."\t".$key[$i][9]."\t".$key[$i][10]."\t".$fcnt."\t0\t0\t0\t0\t".$key[$i][6]."\t".$fra[$i][5]."\t".$fra[$i][5]."\t".$fra[$i][6]."\t".$fra[$i][7]."\t0\t".$fra[$i][2]."\t".$fra[$i][12]."\t");	
			$z = 15;
		}
		for($j = 0; $j < 8; $j++)
		{
			$file_load = file($file[$j], FILE_SKIP_EMPTY_LINES);
			$schet = sizeof($file_load);
			$itemserial = 0;
			for($k = 2; $k < $schet; $k++)
			{
				$frow = explode("\t", trim($file_load[$k]));							
				if($fra[$i][$z + $j] == $frow[0])
				{
					fwrite($fo, $itemserial."\t");
					break;
				}			
				$itemserial++;
			}
		}
		if(defined('GU'))
			fwrite($fo, $fra[$i][16]."\t".$fra[$i][17]."\t0");
		else		
			fwrite($fo, $fra[$i][13]."\t".$fra[$i][14]."\t0");
		$fcnt++;
	}	
	fclose($fo);
	fseek($smd5, $noffset, SEEK_SET);
	fwrite($smd5, pack("H32", $fmd5));
}
$fmd5 = md5_file($installpath."in\\Item.edf\\".$patharr[25]."\\GuardTowerItem.txt");
$noffset = ftell($smd5);
$unp = unpack("H*", fread($smd5, 16));
if($fmd5 == $unp[1])
{
		echo "MD5 has is same. Skipped: ".$patharr[25]."\\25".$incname."<br>";
		flush();
}
else
{
	echo "Proceed: ".$patharr[25]."\\25".$incname."<br>";
	flush();
	$fo = fopen($installpath."in\\Item.edf\\".$patharr[25]."\\25".$incname, "w+");
	if(defined('GU'))
	{
		$r1 = "clcode\tstring[64]\txeh\tdword\tstb\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tlong\tdword\txeh\tdword\tdword\tfloat\tdword\tdword\tdword\tdword\tbyte\tbyte\tword\tdword\tdword\txeh\tdword\tbyte\tbyte\tbyte\tbyte\tdword\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\thex\thex\thex\txeh\txeh\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tEND\r\n";
		$r2 = "Code\tName\tModel\tIcon\tCivil\tListID\tMoney\tnone\tStdPrice\tStdPoint\tGoldPoint\tProcPoint\tKillPoint\tStoreprice\tIsExchage\tIsSell\tIsGround\tIsStore\tDescript\tIsExist\tIsCash\tIsTime\tUpLvLim\tLevel\tMeshID\tHitPoint\tLvLim\tRadius\tStartTime\thz\thz\thz\tHeight\tWidth\tnone\tAttMin\tAttMax\thz\tDeFc\tfire\twater\tsoil\twind\tSpeed\tNumItem\tItemType1\tItemType2\tItemType3\tItemType4\tItemType5\tnone\tItemIndex1\tItemIndex2\tItemIndex3\tItemIndex4\tItemIndex5\tItemCode1\tItemCode2\tItemCode3\tItemCode4\tItemCode5\tNeedItem1\tNeedItem2\tNeedItem3\tNeedItem4\tNeedItem5\tAttEff\tDefEff\thz";	
		$z = 45;
	}
	else
	{	
		$r1 = "clcode\tstring[64]\txeh\tdword\tstb\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tlong\tdword\txeh\tdword\tdword\tfloat\tdword\tdword\tdword\tdword\tbyte\tbyte\tword\tdword\tdword\txeh\tdword\tbyte\tbyte\tbyte\tbyte\tdword\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\thex\thex\thex\txeh\txeh\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tEND\r\n";
		$r2 = "Code\tName\tModel\tIcon\tCivil\tListID\tMoney\tnone\tStdPrice\tStdPoint\tProcPoint\tKillPoint\tStoreprice\tIsExchage\tIsSell\tIsGround\tIsStore\tDescript\tIsExist\tIsCash\tIsTime\tUpLvLim\tLevel\tMeshID\tHitPoint\tLvLim\tRadius\tStartTime\thz\thz\thz\tHeight\tWidth\tnone\tAttMin\tAttMax\thz\tDeFc\tfire\twater\tsoil\twind\tSpeed\tNumItem\tItemType1\tItemType2\tItemType3\tItemType4\tItemType5\tnone\tItemIndex1\tItemIndex2\tItemIndex3\tItemIndex4\tItemIndex5\tItemCode1\tItemCode2\tItemCode3\tItemCode4\tItemCode5\tNeedItem1\tNeedItem2\tNeedItem3\tNeedItem4\tNeedItem5\tAttEff\tDefEff\thz";
		$z = 42;
	}
	fwrite($fo, $r1);
	fwrite($fo, $r2);
	$file1 = $installpath."in\\Item.edf\\".$patharr[25]."\\GuardTowerItem.txt";
	$file_load1 = file($file1, FILE_SKIP_EMPTY_LINES);
	$schet1 = sizeof($file_load1);
	$fcnt = 0;	
	for($i = 2; $i < $schet1; $i++)
	{
		$neednum = 0;
		$ittype = array(0=>"-1",1=>"-1",2=>"-1");
		$itindex = array(0=>"0",1=>"0",2=>"0");
		$ndnum = array(0=>"0",1=>"0",2=>"0");
		$itcode = array(0=>"ffffffff",1=>"ffffffff",2=>"ffffffff");
        $needitem = array();
		$gti = explode("\t", trim($file_load1[$i]));
		if($gti[$z] != "0" && $gti[$z] != "-1")
		{
			$needitem[$neednum] = $gti[$z];
			$ndnum[$neednum] = $gti[$z+1];
			$neednum++;
		}
		if($gti[$z+2] != "0" && $gti[$z+2] != "-1")
		{
			$needitem[$neednum] = $gti[$z+2];
			$ndnum[$neednum] = $gti[$z+3];
			$neednum++;
		}
		if($gti[$z+4] != "0" && $gti[$z+4] != "-1")
		{
			$needitem[$neednum] = $gti[$z+4];
			$ndnum[$neednum] = $gti[$z+5];
			$neednum++;
		}		
		for($c = 0; $c < $neednum; $c++)
		{
			$a=0;
			$typearr[$c] = str_split($needitem[$c]);
			$type = $typearr[$c][0].$typearr[$c][1];	
			while($array[$a]!=$type && $a!=37)
			{
				$a++;
			}
			if($a == 37)
			{
				$stop = true;
				echo "Undefined item found while processing Guardtowers file. ".$type." <br>";
				flush();
			}
			$opentmp = file($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname, FILE_SKIP_EMPTY_LINES);
			$gtfsz = sizeof($opentmp);
			$itemserial = 0;			
			for($d = 2; $d < $gtfsz; $d++)
			{
				$gttcl = explode("\t", trim($opentmp[$d]));				
				if($needitem[$c] == $gttcl[0])
				{
					$itindex[$c] = $itemserial;
					break;
				}				
				$itemserial++;
			}		
			$unpck = unpack("H*", clcode($needitem[$c]));
			$itcode[$c] = $unpck[1];			
			$ittype[$c] = $a;
			//$it1 = $it1 + 2;
		}
		if(defined('GU'))
			fwrite($fo, "\r\n".$gti[0]."\t".$gti[3]."\t".$gti[1]."\t".$gti[10]."\t".$gti[4]."\t25\t".$gti[38]."\t0\t".$gti[39]."\t".$gti[40]."\t".$gti[41]."\t".$gti[43]."\t".$gti[42]."\t".$gti[44]."\t".$gti[52]."\t".$gti[51]."\t".$gti[53]."\t".$gti[54]."\t".$fcnt."\t1\t0\t".$gti[60]."\t".$gti[6]."\t".$gti[11]."\t".$gti[2]."\t".$gti[37]."\t".$gti[5]."\t".$gti[16]."\t".$gti[8]."\t0\t0\t0\t".$gti[12]."\t".$gti[13]."\t0\t".$gti[19]."\t".$gti[20]."\tff00\t".$gti[24]."\t".$gti[28]."\t".$gti[29]."\t".$gti[30]."\t".$gti[31]."\t".$gti[17]."\t".$neednum."\t".$ittype[0]."\t".$ittype[1]."\t".$ittype[2]."\t-1\t-1\t0\t".$itindex[0]."\t".$itindex[1]."\t".$itindex[2]."\t0\t0\t".$itcode[0]."\t".$itcode[1]."\t".$itcode[2]."\t0\t0\t".$ndnum[0]."\t".$ndnum[1]."\t".$ndnum[2]."\t0\t0\t".$gti[58]."\t".$gti[59]."\t2490563");
		else		
			fwrite($fo, "\r\n".$gti[0]."\t".$gti[3]."\t".$gti[1]."\t".$gti[10]."\t".$gti[4]."\t25\t".$gti[38]."\t0\t".$gti[39]."\t".$gti[40]."\t0\t0\t".$gti[41]."\t".$gti[49]."\t".$gti[48]."\t".$gti[50]."\t".$gti[51]."\t".$fcnt."\t1\t0\t".$gti[57]."\t".$gti[6]."\t".$gti[11]."\t".$gti[2]."\t".$gti[37]."\t".$gti[5]."\t".$gti[16]."\t".$gti[8]."\t0\t0\t0\t".$gti[12]."\t".$gti[13]."\t0\t".$gti[19]."\t".$gti[20]."\tff00\t".$gti[24]."\t".$gti[28]."\t".$gti[29]."\t".$gti[30]."\t".$gti[31]."\t".$gti[17]."\t".$neednum."\t".$ittype[0]."\t".$ittype[1]."\t".$ittype[2]."\t-1\t-1\t0\t".$itindex[0]."\t".$itindex[1]."\t".$itindex[2]."\t0\t0\t".$itcode[0]."\t".$itcode[1]."\t".$itcode[2]."\t0\t0\t".$ndnum[0]."\t".$ndnum[1]."\t".$ndnum[2]."\t0\t0\t".$gti[55]."\t".$gti[56]."\t0");
		$fcnt++;
	}
	fclose($fo);
	fseek($smd5, $noffset, SEEK_SET);
	fwrite($smd5, pack("H32", $fmd5));
}
$fmd5 = md5_file($installpath."in\\Item.edf\\".$patharr[44]."\\ItemMakeData.txt");
$noffset = ftell($smd5);
$unp = unpack("H*", fread($smd5, 16));
if($fmd5 == $unp[1])
{
		echo "MD5 has is same. Skipped: ".$patharr[44]."\\44".$incname."<br>";
		flush();
}
else
{
	echo "Proceed: ".$patharr[44]."\\44".$incname."<br>";
	flush();
	$fo = fopen($installpath."in\\Item.edf\\".$patharr[44]."\\44".$incname, "w+");
	$r1 = "dword\tdword\tclcode\txeh\tdword\tbyte\tstb\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tdword\tdword\tdword\tdword\tdword\thex\thex\thex\thex\thex\tdword\tdword\tdword\tdword\tdword\tdword\tEND\r\n";
	$r2 = "newType\tbewIndex\tCode\tNewModel\tExp\tMakeMastery\tCivil\tNeedNum\tNeedType1\tNeedType2\tNeedType3\tNeedType4\tNeedType5\tnone\tNeedIndex1\tNeedIndex2\tNeedIndex3\tNeedIndex4\tNeedIndex5\tNeedCode1\tNeedCode2\tNeedCode3\tNeedCode4\tNeedCode5\tNeedNum1\tNeedNum2\tNeedNum3\tNeedNum4\tNeedNum5\thz";
	fwrite($fo, $r1);
	fwrite($fo, $r2);
	$file1 = $installpath."in\\Item.edf\\".$patharr[44]."\\ItemMakeData.txt";
	$file_load1 = file($file1, FILE_SKIP_EMPTY_LINES);
	$schet1 = sizeof($file_load1);
	$fcnt = 0;	
	for($i = 2; $i < $schet1; $i++)
	{
		$neednum = 0;
		$imd = explode("\t", trim($file_load1[$i]));
		$ittype = array(0=>"0",1=>"0",2=>"0",3=>"0",4=>"0");
		$itindex = array(0=>"0",1=>"0",2=>"0",3=>"0",4=>"0");
		$ndnum = array(0=>"0",1=>"0",2=>"0",3=>"0",4=>"0");
		$itcode = array(0=>"00000000",1=>"00000000",2=>"00000000",3=>"00000000",4=>"00000000");		
		if($imd[3]!="0")
		{
			$needitem[$neednum]=$imd[3];
			$ndnum[$neednum] = $imd[4];
			$neednum ++;
		}		
		if($imd[5]!="0")
		{
			$needitem[$neednum]=$imd[5];
			$ndnum[$neednum] = $imd[6];
			$neednum ++;
		}		
		if($imd[7]!="0")
		{
			$needitem[$neednum]=$imd[7];
			$ndnum[$neednum] = $imd[8];
			$neednum ++;
		}	
		if($imd[9]!="0")
		{
			$needitem[$neednum]=$imd[9];
			$ndnum[$neednum] = $imd[10];
			$neednum ++;
		}		
		if($imd[11]!="0")
		{
			$needitem[$neednum]=$imd[11];
			$ndnum[$neednum] = $imd[12];
			$neednum ++;
		}	
		$a=0;
		$rtype = str_split($imd[0]);
		$type = $rtype[0].$rtype[1];		
		while($array[$a]!=$type && $a!=37)
		{
			$a++;
		}		
		$rmtype = $a;		
		if($a == 37)
		{
			$stop = true;
			echo "1.Undefined item type found while processing makeitem file. ".$type." <br>";
			flush();
		}		
		$opentmp = file($installpath."in\\Item.edf\\".$patharr[$rmtype]."\\".$rmtype.$incname, FILE_SKIP_EMPTY_LINES);
		$imdfsz = sizeof($opentmp);
		$itemserial = 0;
        $rmodel = 0;
		for($d = 2; $d < $imdfsz; $d++)
		{
			$gttcl = explode("\t", trim($opentmp[$d]));					
			if($imd[0] == $gttcl[0])
			{
				$rindex = $itemserial;
				$rmodel = $gttcl[2];
				break;	
			}			
			$itemserial++;
		}		
		for($c = 0; $c < $neednum; $c++)
		{
			$a=0;
			$typearr[$c] = str_split($needitem[$c]);
			$type = $typearr[$c][0].$typearr[$c][1];			
			while($array[$a]!=$type && $a!=37)
			{
				$a++;
			}		
			if($a == 37)
			{
				$stop = true;
				echo "2.Undefined item type found while processing makeitem file. ".$type." <br>";
				flush();
			}	
			$opentmp = file($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname, FILE_SKIP_EMPTY_LINES);
			$imdfsz = sizeof($opentmp);
			$itemserial = 0;		
			for($d = 2; $d < $imdfsz; $d++)
			{
				$gttcl = explode("\t", trim($opentmp[$d]));				
				if($needitem[$c] == $gttcl[0])
				{
					$itindex[$c] = $itemserial;
					break;
				}				
				$itemserial++;
			}		
			$unpck = unpack("H*", clcode($needitem[$c]));
			$itcode[$c] = $unpck[1];
			$ittype[$c] = $a;
		}				
		fwrite($fo, "\r\n".$rmtype."\t".$rindex."\t".$imd[0]."\t".$rmodel."\t".$fcnt."\t".$imd[1]."\t".$imd[2]."\t".$neednum."\t".$ittype[0]."\t".$ittype[1]."\t".$ittype[2]."\t".$ittype[3]."\t".$ittype[4]."\t0\t".$itindex[0]."\t".$itindex[1]."\t".$itindex[2]."\t".$itindex[3]."\t".$itindex[4]."\t".$itcode[0]."\t".$itcode[1]."\t".$itcode[2]."\t".$itcode[3]."\t".$itcode[4]."\t".$ndnum[0]."\t".$ndnum[1]."\t".$ndnum[2]."\t".$ndnum[3]."\t".$ndnum[4]."\t0");
		$fcnt++;
	}	
	fclose($fo);
	fseek($smd5, $noffset, SEEK_SET);
	fwrite($smd5, pack("H32", $fmd5));
}
$fmd5 = md5_file($installpath."in\\Item.edf\\".$patharr[45]."\\ItemCombine.txt");
$noffset = ftell($smd5);
$unp = unpack("H*", fread($smd5, 16));
if($fmd5 == $unp[1])
{
		echo "MD5 hash is same. Skipped: ".$patharr[45]."\\45".$incname."<br>";
		flush();
}
else
{
	echo "Proceed: ".$patharr[45]."\\45".$incname."<br>";
	flush();
	$fo = fopen($installpath."in\\Item.edf\\".$patharr[45]."\\45".$incname, "w+");
	$r1 = "dword\tdword\tdword\tclcode\tdword\tstb\tbyte\tbyte\tword\tdword\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tdword\tdword\tdword\tdword\tdword\thex\thex\thex\thex\thex\tdword\tdword\tdword\tdword\tdword";
	if(!defined('GU'))
	    $r1 .="\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword";
    $r1 .="\tEND\r\n";
	$r2 = "CombineIdx\trtype\trindex\tCode\tdwFee\tCivil\tTradeValue\tnone\tnone\tdwTradeMoney\tNum\tID1\tID2\tID3\tID4\tID5\tnone\tIndex1\tIndex2\tIndex3\tIndex4\tIndex5\tCode1\tCode2\tCode3\tCode4\tCode5\tNeed1\tNeed2\tNeed3\tNeed4\tNeed5";
    if(!defined('GU'))
        $r2 .="\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz\thz";
	fwrite($fo, $r1);
	fwrite($fo, $r2);
	$file1 = $installpath."in\\Item.edf\\".$patharr[45]."\\ItemCombine.txt";
	$file_load1 = file($file1, FILE_SKIP_EMPTY_LINES);
	$schet1 = sizeof($file_load1);		
	for($i = 2; $i < $schet1; $i++)
	{
		$cmb = explode("\t", trim($file_load1[$i]));
		$neednum = 0;
		$ittype = array(0=>"-1",1=>"-1",2=>"-1",3=>"-1",4=>"-1");
		$itindex = array(0=>"0",1=>"0",2=>"0",3=>"0",4=>"0");
		$itcode = array(0=>"ffffffff",1=>"ffffffff",2=>"ffffffff",3=>"ffffffff",4=>"ffffffff");
		$ndnum = array(0=>"-1",1=>"-1",2=>"-1",3=>"-1",4=>"-1");
        $needitem = array();
		if($cmb[6] != "-1")
		{
			$needitem[$neednum] = $cmb[6];
			$ndnum[$neednum]=$cmb[7];
			$neednum ++;
		}
		if($cmb[8] != "-1")
		{
			$needitem[$neednum] = $cmb[8];		
			$ndnum[$neednum]=$cmb[9];
			$neednum ++;
		}
		if($cmb[10] != "-1")
		{
			$needitem[$neednum] = $cmb[10];
			$ndnum[$neednum]=$cmb[11];
			$neednum ++;
		}
		if($cmb[12] != "-1")
		{
			$needitem[$neednum] = $cmb[12];
			$ndnum[$neednum]=$cmb[13];
			$neednum ++;
		}
		if($cmb[14] != "-1")
		{
			$needitem[$neednum] = $cmb[14];
			$ndnum[$neednum]=$cmb[15];
			$neednum ++;
		}			
		$a=0;
		$rtype = str_split($cmb[0]);
		$type = $rtype[0].$rtype[1];	
		while($array[$a]!=$type && $a!=37)
		{
			$a++;
		}				
		if($a == 37)
		{
			$stop = true;
			echo "1.Undefined item type found while processing combine file. ".$type." <br>";
			flush();
		}
		$opentmp = file($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname, FILE_SKIP_EMPTY_LINES);
		$imdfsz = sizeof($opentmp);
		$rtype = $a;
		$itemserial = 0;
        $rindex = 0;
		for($d = 2; $d < $imdfsz; $d++)
		{
			$gttcl = explode("\t", trim($opentmp[$d]));		
			if($cmb[0]==$gttcl[0]){
				$rindex = $itemserial;
				break;	
			}
			$itemserial++;
		}		
		for($c = 0; $c < $neednum; $c++)
		{
			$a=0;
			$typearr[$c] = str_split($needitem[$c]);
			$type = $typearr[$c][0].$typearr[$c][1];			
			while($array[$a] != $type && $a != 37)
			{
				$a++;
			}
			if($a == 37)
			{
				$stop = true;
				echo "2.Undefined item type found while processing combine file. ".$type." <br>";
				flush();
			}
			$opentmp = file($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname, FILE_SKIP_EMPTY_LINES);
			$imdfsz = sizeof($opentmp);
			$itemserial = 0;		
			for($d = 2; $d < $imdfsz; $d++)
			{
				$gttcl = explode("\t", trim($opentmp[$d]));			
				if($needitem[$c] == $gttcl[0])
				{
					$itindex[$c] = $itemserial;;
					break;
				}				
				$itemserial++;
			}
			$unpck = unpack("H*", clcode($needitem[$c]));
			$itcode[$c] = $unpck[1];			
			$ittype[$c] = $a;
		}				
		fwrite($fo, "\r\n".$cmb[1]."\t".$rtype."\t".$rindex."\t".$cmb[0]."\t".$cmb[2]."\t".$cmb[3]."\t".$cmb[4]."\t0\t0\t".$cmb[5]."\t".$neednum."\t".$ittype[0]."\t".$ittype[1]."\t".$ittype[2]."\t".$ittype[3]."\t".$ittype[4]."\t0\t".$itindex[0]."\t".$itindex[1]."\t".$itindex[2]."\t".$itindex[3]."\t".$itindex[4]."\t".$itcode[0]."\t".$itcode[1]."\t".$itcode[2]."\t".$itcode[3]."\t".$itcode[4]."\t".$ndnum[0]."\t".$ndnum[1]."\t".$ndnum[2]."\t".$ndnum[3]."\t".$ndnum[4]);
		if(!defined('GU'))
			fwrite($fo, "\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0");
		$fcnt++;
	}
	fclose($fo);
	fseek($smd5, $noffset, SEEK_SET);
	fwrite($smd5, pack("H32", $fmd5));
}
fclose($smd5);
$fp = fopen($installpath."out\\item.dat", "w+");
if(!$stop)
{
	$offset = 0;	
	for($a=0; $a < 46; $a++)
	{
		if(defined('GU'))
			$index = pack("c", $a);
		else
			$index = pack("c", $indexarr[$a] ?? 0);
		fwrite($fp, "$index");
		fwrite($fp, "$smthhex");		
		if(!file_exists($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname))
		{
			$stop = true;
			fclose($fp);
			die("Aborted cause of file missing: ".$a.$incname."<br>");
		}		
		$decrypt = $installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname;
		$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($struct_load);
		$str_row = explode("\t", trim($struct_load[0]));	

		echo ($a + 1)." / 46 (".$a.$incname.") started...";
		flush();	
		$block = strsize($str_row) + 4;
		$listsz = ($schet-2)*$block+8;
		$listszhex = pack("i", $listsz);
		fwrite($fp, "$listszhex");
		$offsethex = pack("i", $offset);
		fwrite($fp, "$offsethex");
		$schethex = pack("i", ($schet-2));
		fwrite($fp, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fp, "$blockhex");
		$offset = $offset + $listsz +10;	
		if(parser($fp, $decrypt, 1, 0))
            echo "Done!<br>";
        else
        {
            echo "Failed!<br>";
            die($stop_error_msg);
        }
	}	
	if($stop)
	{
			echo "File not found.<br>";
			fclose($fp);			
	}
	else
	{
		if(!defined('GU'))
			$listunk = pack("c", 44);
		else
			$listunk = pack("c", 47);
		fwrite($fp, "$listunk");
		fwrite($fp, "$smthhex");
		$listunksz = pack("i", 368);
		fwrite($fp, "$listunksz");
		$offsethex = pack("i", $offset);
		fwrite($fp, "$offsethex");
		$offset = $offset + 368 + 10;
		//$fp2 = fopen($installpath."in\\Item.edf\\".$patharr[46]."\\Unk.dat", "r");
		//$unkdata = fread($fp2, 368);
		$fload = file($installpath."in\\Item.edf\\".$patharr[44]."\\ItemMakeData.txt", FILE_SKIP_EMPTY_LINES);
		$fschet = sizeof($fload);
		$i=2;
		$offshield = 0;
		$offhead = 0;
		$offupper = 0;
		$offlower = 0;
		$offgloves = 0;
		$offshoes = 0;
		$offbullets = 0;
		$countshield = 0;
		$counthead = 0;
		$countupper = 0;
		$countlower = 0;
		$countgloves = 0;
		$countshoes = 0;
		$countbullets = 0;
		$countweapon = 0;
		$frow = explode("\t", trim($fload[$i]));
		$masv = str_split($frow[0], 2);
		while($masv[0] == "iw" && $i != $fschet)
		{
			$i++;
			$countweapon++;
			$offshield++;
			$offhead++;
			$offupper++;
			$offlower++;
			$offgloves++;
			$offshoes++;
			$offbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		while($masv[0] == "id" && $i != $fschet)
		{
			$i++;
			$countshield++;
			$offhead++;
			$offupper++;
			$offlower++;
			$offgloves++;
			$offshoes++;
			$offbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		while($masv[0] == "ih" && $i != $fschet)
		{
			$i++;
			$counthead++;
			$offupper++;
			$offlower++;
			$offgloves++;
			$offshoes++;
			$offbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		while($masv[0] == "iu" && $i != $fschet)
		{
			$i++;
			$countupper++;
			$offlower++;
			$offgloves++;
			$offshoes++;
			$offbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		while($masv[0] == "il" && $i != $fschet)
		{
			$i++;
			$countlower++;
			$offgloves++;
			$offshoes++;
			$offbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		while($masv[0] == "ig" && $i != $fschet)
		{
			$i++;
			$countgloves++;
			$offshoes++;
			$offbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		while($masv[0] == "is" && $i != $fschet)
		{
			$i++;
			$countshoes++;
			$offbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		while($masv[0] == "ib" && $i != $fschet)
		{
			$i++;
			$countbullets++;
			$frow = explode("\t", trim($fload[$i]));
			$masv = str_split($frow[0], 2);
		}
		fwrite($fp, pack("i", 0).pack("i", $offupper).pack("i", $offlower).pack("i", $offgloves).pack("i", $offshoes).pack("i", $offhead).pack("i", 0).pack("i", $offshield).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", $offbullets).pack("@136"));
		fwrite($fp, pack("i", 0).pack("i", $countupper).pack("i", $countlower).pack("i", $countgloves).pack("i", $countshoes).pack("i", $counthead).pack("i", $countweapon).pack("i", $countshield).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", $countbullets).pack("@136"));
	}
}
if(!defined('GU'))
{
	$listunk = pack("c", 41);
	fwrite($fp, "$listunk");
	fwrite($fp, "$smthhex");
	$listunksz = pack("i", 0);
	fwrite($fp, "$listunksz");
	$offsethex = pack("i", $offset);
	fwrite($fp, "$offsethex");
	$descsize = 0;	
	for($a=0; $a < 46; $a++)
	{
		if(!file_exists($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$desc))
		{
			$stop = true;
			fclose($fp);
			die("Aborted cause of file missing: ".$a.$desc."<br>");
		}
		$decrypt = $installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$desc;
		$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($struct_load);
		$proceed = $a+1;
        echo ($a + 1)." / 46 (".$a.$desc.") started...";
		flush();
		$schethex = pack("i", ($schet-2));
		fwrite($fp, "$schethex");
		$descsize += 4;		
		for($j=2; $j < $schet; $j++)
		{			
			$temporary = split("\t", trim($struct_load[$j],"\t\r\n\x22"));
			$len = strlen(trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[1]), "\x22"));
            if($len > 255)
                echo "<br>Warning! Exceeded max length of 255 symbols at item description. Tail of string wont be shown in game: ROW:".($j+1)."' SIZE:".$len.".";
			$len += 1;
			$resulthex = pack("i", $temporary[0]).pack("i", 0).pack("i", $len).pack("a".$len, trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[1]), "\x22"));
			fwrite($fp, $resulthex);
			$descsize += 12 + $len;
		}
        echo " Done!<br>";
	}	
	fseek($fp, $offset + 2, SEEK_SET);
	$listszhex = pack("i", $descsize);
	fwrite($fp, "$listszhex");
	fseek($fp, 0, SEEK_END);
	$offset += $descsize + 10;


	$listunk = pack("c", 42);
	fwrite($fp, "$listunk");
	fwrite($fp, "$smthhex");
	$listunksz = pack("i", 0);
	fwrite($fp, "$listunksz");
	$offsethex = pack("i", $offset);
	fwrite($fp, "$offsethex");
	//$offset = $offset + 368 + 10;
	$descsize = 0;	
	if(!file_exists($installpath."in\\Item.edf\\dungeon.txt"))
	{
		$stop = true;
		fclose($fp);
		die("Aborted cause of file missing: dungeon.txt<br>");
	}
	$decrypt = $installpath."in\\Item.edf\\dungeon.txt";
	$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
	$schet = sizeof($struct_load);
	echo "Processing dungeon.txt file<br>";
	flush();
	$schethex = pack("i", ($schet-2));
	fwrite($fp, "$schethex");
	$descsize += 4;				
	for($j=2; $j < $schet; $j++)
	{			
		$temporary = split("\t", trim($struct_load[$j],"\t\r\n\x22"));
		$len = strlen($temporary[0]);
		$len += 1;
		$resulthex = pack("i", ($j-2)).pack("i", 0).pack("i", $len).pack("a".$len, trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[0]), "\x22"));
		fwrite($fp, $resulthex);
		$descsize += 12 + $len;
	}	
	fseek($fp, $offset + 2, SEEK_SET);
	$listszhex = pack("i", $descsize);
	fwrite($fp, "$listszhex");
	fseek($fp, 0, SEEK_END);
	$offset += $descsize + 10;
}
fclose($fp);
if(defined('GU'))
{
	$fp = fopen($installpath."out\\en-gb\\nditem.dat", "w+");
	for($a=0; $a < 44; $a++)
	{
		if(!file_exists($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname))
		{
			echo "Aborted cause of file missing: ".$a.$incname."<br>";
			break;
		}

		$decrypt = $installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$incname;
		$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($struct_load);
		$proceed = $a+1;
        echo ($a + 1)." / 44 (".$a.$incname.") started...";
		flush();
		$schethex = pack("i", ($schet-2));
		fwrite($fp, "$schethex");
		for($j=2; $j < $schet; $j++)
		{			
			$temporary = explode("\t", trim($struct_load[$j],"\t\r\n\x22"));
			$resulthex=pack("a64", $temporary[1]);
			fwrite($fp, $resulthex);
		}
        echo "Done!<br>";
	}

	for($a=0; $a < 46; $a++)
	{
		if(!file_exists($installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$desc))
		{
			echo "Aborted cause of file missing: ".$a.$desc."<br>";
			break;
		}
		$decrypt = $installpath."in\\Item.edf\\".$patharr[$a]."\\".$a.$desc;
		$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($struct_load);
		$proceed = $a+1;
        echo ($a + 1)." / 46 (".$a.$desc.") started...";
		flush();
		$schethex = pack("i", ($schet-2));
		fwrite($fp, "$schethex");
		for($j=2; $j < $schet; $j++)
		{			
			$temporary = explode("\t", trim($struct_load[$j],"\t\r\n\x22"));
			$len = strlen(trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[1]), "\x22"));
            if($len > 255)
                echo "<br>Warning! Exceeded max length of 255 symbols at item description. Tail of string wont be shown in game: ROW:".($j+1)."' SIZE:". $len.".";
			$len += 1;
			$resulthex = pack("i", $temporary[0]).pack("i", 0).pack("i", $len).pack("a".$len, trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[1]), "\x22"));
			fwrite($fp, $resulthex);
		}
        echo " Done<br>";
	}

	if(!file_exists($installpath."in\\Item.edf\\dungeon.txt"))
	{
		die("Aborted cause of file missing: dungeon.txt<br>");
	}
	$decrypt = $installpath."in\\Item.edf\\dungeon.txt";
	$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
	$schet = sizeof($struct_load);
	echo "Processing dungeon.txt file<br>";
	flush();
	$schethex = pack("i", ($schet-2));
	fwrite($fp, "$schethex");
	for($j=2; $j < $schet; $j++)
	{		
		$temporary = explode("\t", trim($struct_load[$j],"\t\r\n\x22"));
		$len = strlen(trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[1]), "\x22"));
		$len += 1;
		$resulthex = pack("i", ($j-2)).pack("a64", $temporary[0]).pack("i", $len).pack("a".$len, trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[1]), "\x22"));
		fwrite($fp, $resulthex);
	}
	fclose($fp);
}
echo "<br>Script finished";