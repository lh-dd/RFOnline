<?php
include './include.php'; // necessary include

$stop = false;

	$cpfw = fopen($installpath.$skfpatharr[0]['cli'], "w+");
	$cpsfile = file($installpath.$skfpatharr[0]['srv'], FILE_SKIP_EMPTY_LINES);
	$cpndfile = file($installpath.$skfpatharr[0]['nd'], FILE_SKIP_EMPTY_LINES);
	$schet = sizeof($cpsfile);
	fwrite($cpfw, "xeh\tdword\tbyte\tbyte\tbyte\tbyte\tstring[32]\tstring[32]\tstring[32]\tstring[32]\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\t");
	fwrite($cpfw, "float\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\t");
	fwrite($cpfw, "float\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\t");
	fwrite($cpfw, "byte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\t");
	fwrite($cpfw, "word\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\t");
	fwrite($cpfw, "float\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tdword\tdword\t");
	fwrite($cpfw, "dword\tdword\tdword\tdword\tdword\tstb\tbyte\tstb\tbyte\tstb16\tword\tdword\tdword\tdword\tdword\tdword\tbyte\tbyte\tword\tword\tword\tfloat\tfloat\t");
	fwrite($cpfw, "string[512]\tbyte\tbyte\tword\tdword\tdword\tdword\txeh\tstb12\txeh\tbyte\tbyte\tbyte\tbyte\thex\thex\thex\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tEND\r\n");
	fwrite($cpfw, "Code\tIcon\tClass\tIsActive\tMastIndex\tLv\tMastEngName\tMastKorName\tEngName\tName\tUnk1\tUnk2\tUnk3\tUnk4\tUnk5\tUnk6\tUnk7\tUnk8\tUnk9\tnone\tnone\t");
	fwrite($cpfw, "unit1\tunit2\tunit3\tunit4\tunit5\tunit6\tunit7\tHz1\tHz2\tHz3\tHz4\tHz5\tHz6\tHz7\tHz8\tHz9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\t");
	fwrite($cpfw, "Unit7\tHZ1\tHZ2\tHZ3\tHZ4\tHZ5\tHZ6\tHZ7\tHZ8\tHZ9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tHZ1\tHZ2\tHZ3\tHZ4\tHZ5\tHZ6\tHZ7\t");
	fwrite($cpfw, "HZ8\tHZ9\tnone\tnone\tunit1\tunit2\tunit3\tunit4\tunit5\tunit6\tunit7\tHZ1\tHZ2\tHZ3\tHZ4\tHZ5\tHZ6\tHZ7\tHZ8\tHZ9\tnone\tnone\tUnit1\tUnit2\tUnit3\t");
	fwrite($cpfw, "Unit4\tUnit5\tUnit6\tUnit7\tHZ1\tHZ2\tHZ3\tHZ4\tHZ5\tHZ6\tHZ7\tHZ8\tHZ9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tHZ1\tHZ2\tHZ3\t");
	fwrite($cpfw, "HZ4\tHZ5\tHZ6\tHZ7\tHZ8\tHZ9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tContEffSec1\tContEffSec2\tContEffSec3\tContEffSec4\tContEffSec5\t");
	fwrite($cpfw, "ContEffSec6\tContEffSec7\tUsableRace\tClass\tActableDst\tNeedMastIndex\tFixWeapon\tnone\tnone\tnone\tnone\tnone\tIsFixShield\tSpecialType\tNeedSpecialType\t");
	fwrite($cpfw, "NeedHP\tNeedFP\tNeedSP\tActDealy\tActDistance\tDescription\tEffectClass\tnone\tnone\tIsCumulType\tCumulCounter\tNewEffCOunt\tEffectCode\tGradeLimit\t");
	fwrite($cpfw, "RangeEffCode\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tProperty\tnone\tnone\r\n");
	for($i=2; $i < $schet; $i++)
	{
		$skip = 0;
		$row = split("\t", trim($cpsfile[$i]));
		$ndrow = split("\t", trim($cpndfile[$i]));
		fwrite($cpfw, $row[0]."\t".$row[2]."\t".$row[1]."\t".$row[9]."\t".$row[3]."\t".$row[8]."\t".$row[5]."\t".$row[4]."\t".$row[7]."\t".$row[6]."\t");
		if($row[33]!=0)
			fwrite($cpfw, "0\t".$row[35]."\t".$row[35]."\t".$row[35]."\t".$row[35]."\t".$row[35]."\t".$row[35]."\t".$row[35]."\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t");
		else
			$skip++;
		
		if($row[39]!=-1)
			fwrite($cpfw, "1\t".$row[39]."\t".$row[39]."\t".$row[39]."\t".$row[39]."\t".$row[39]."\t".$row[39]."\t".$row[39]."\t".
			$row[40]."\t0\t0\t".$row[41]."\t".$row[42]."\t".$row[43]."\t".$row[44]."\t".$row[45]."\t".$row[46]."\t".$row[47]."\t");
		else
			$skip++;
			
		for($j=0; $j < 5; $j ++)
		{
			if($row[51+$j*9]!=-1 && $row[48] == 1)
				fwrite($cpfw, "3\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".
				$row[50+$j*9]."\t0\t0\t".$row[52+$j*9]."\t".$row[53+$j*9]."\t".$row[54+$j*9]."\t".$row[55+$j*9]."\t".$row[56+$j*9]."\t".$row[57+$j*9]."\t".$row[58+$j*9]."\t");
			elseif($row[51+$j*9]!=-1 && $row[48] == 0)
				fwrite($cpfw, "2\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".$row[51+$j*9]."\t".
				$row[50+$j*9]."\t0\t0\t".$row[52+$j*9]."\t".$row[53+$j*9]."\t".$row[54+$j*9]."\t".$row[55+$j*9]."\t".$row[56+$j*9]."\t".$row[57+$j*9]."\t".$row[58+$j*9]."\t");
			else
				$skip++;
		}	
		for($j=0; $j < $skip; $j++)
		{
			fwrite($cpfw, "-1\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t");
		}
		/*�������� ����� ����������� ��������� ��� ������ �����*/
		$neednum = 0;
		if($row[22] != "-1" && $row[22]!= "0") $neednum++;
		if($row[24] != "-1" && $row[24]!= "0") $neednum++;
		if($row[26] != "-1" && $row[26]!= "0") $neednum++;
				
		$ittype = array(0=>"-1",1=>"-1",2=>"-1");
		$itcode = array(0=>"ffffffff",1=>"ffffffff",2=>"ffffffff");
		$ndnum = array(0=>"-1",1=>"-1",2=>"-1");		

		for($k = 0; $k < $neednum; $k++)
		{
			$a=0;
			$tpearr = str_split($row[22 + $k]);
			$type = $tpearr[0].$tpearr[1];	
			while($array[$a] != $type && $a != 37)
			{
				$a++;
			}
			if($a == 37)
			{
				$stop = true;
				echo "Undefined item found while processing SkillForce Force file. ".$type." <br>";
				flush();
			}
			$unpck = unpack("H*", clcode($row[22 + $k]));
			$itcode[$k] = $unpck[1];			
			$ittype[$k] = $a;
			$ndnum[$k] = $row[23 + $k];
		}
		/*����� �����*/
		fwrite($cpfw, ($row[95]*1000)."\t".($row[96]*1000)."\t".($row[97]*1000)."\t".($row[98]*1000)."\t".($row[99]*1000)."\t".($row[100]*1000)."\t".($row[101]*1000)."\t".
		$row[11]."\t2\t".$row[12]."\t".$row[14]."\t".$row[15]."\t0\t0\t0\t0\t0\t".$row[16]."\t".$row[17]."\t".$row[18]."\t".
		$row[19]."\t".$row[20]."\t".$row[21]."\t".$row[28]."\t".$row[37]."\t".$ndrow[1]."\t".$row[102]."\t0\t0\t".$row[29]."\t".
		$row[30]."\t".$row[31]."\t".$row[32]."\t".$row[13]."\t".$row[38]."\t".$neednum."\t".$ittype[0]."\t".$ittype[1]."\t".$ittype[2]."\t".$itcode[0]."\t".$itcode[1]."\t".$itcode[2]."\t".$ndnum[0]."\t".$ndnum[1]."\t".$ndnum[2]."\t0\t".$row[34]."\t0\t0\r\n");
	}
	fclose($cpfw);
	unset($cpsfile);
	unset($cpndfile);





for($ii = 1; $ii < 5; $ii ++)
{
	$cpfw = fopen($installpath.$skfpatharr[$ii]['cli'], "w+");
	$cpsfile = file($installpath.$skfpatharr[$ii]['srv'], FILE_SKIP_EMPTY_LINES);
	$cpndfile = file($installpath.$skfpatharr[$ii]['nd'], FILE_SKIP_EMPTY_LINES);
	$schet = sizeof($cpsfile);
	fwrite($cpfw, "xeh\tdword\tbyte\tbyte\tbyte\tbyte\tstring[32]\tstring[32]\tstring[32]\tstring[32]\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\t");
	fwrite($cpfw, "byte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\t");
	fwrite($cpfw, "float\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\t");
	fwrite($cpfw, "byte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\t");
	fwrite($cpfw, "float\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tbyte\t");
	fwrite($cpfw, "byte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tfloat\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tstb\t");
	fwrite($cpfw, "byte\tstb\tbyte\tstb16\tword\tdword\tdword\tdword\tdword\tdword\tbyte\tbyte\tword\tword\tword\tfloat\tfloat\tstring[512]\tbyte\tbyte\tword\tdword\tdword\tdword\t");
	fwrite($cpfw, "xeh\tstb12\txeh\tbyte\tbyte\tbyte\tbyte\thex\thex\thex\tbyte\tbyte\tbyte\tbyte\tdword\tdword\tfloat\tfloat\tdword\tfloat\tfloat\tEND\r\nCode\tIcon\t");
	fwrite($cpfw, "Class\tIsActive\tMastIndex\tLv\tMastEngName\tMastKorName\tEngName\tName\tUnk1\tUnk2\tUnk3\tUnk4\tUnk5\tUnk6\tUnk7\tUnk8\tUnk9\tnone\tnone\tUnit1\tUnit2\tUnit3\t");
	fwrite($cpfw, "Unit4\tUnit5\tUnit6\tUnit7\tUnk1\tUnk2\tUnk3\tUnk4\tUnk5\tUnk6\tUnk7\tUnk8\tUnk9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tUnk1\tUnk2\tUnk3\t");
	fwrite($cpfw, "Unk4\tUnk5\tUnk6\tUnk7\tUnk8\tUnk9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tUnk1\tUnk2\tUnk3\tUnk4\tUnk5\tUnk6\tUnk7\tUnk8\tUnk9\tnone\tnone\t");
	fwrite($cpfw, "Unit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tUnk1\tUnk2\tUnk3\tUnk4\tUnk5\tUnk6\tUnk7\tUnk8\tUnk9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\t");
	fwrite($cpfw, "Unk1\tUnk2\tUnk3\tUnk4\tUnk5\tUnk6\tUnk7\tUnk8\tUnk9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tUnk1\tUnk2\tUnk3\tUnk4\tUnk5\tUnk6\tUnk7\tUnk8\t");
	fwrite($cpfw, "Unk9\tnone\tnone\tUnit1\tUnit2\tUnit3\tUnit4\tUnit5\tUnit6\tUnit7\tContEffSec1\tContEffSec2\tContEffSec3\tContEffSec4\tContEffSec5\tContEffSec6\tContEffSec7\t");
	fwrite($cpfw, "UsableRace\tClass\tActableDst\tNeedMastIndex\tFixWeapon\tnone\tnone\tnone\tnone\tnone\tIsFixShield\tSpecialType\tNeedSpecialType\tNeedHP\tNeedFP\tNeedSP\tActDealy\t");
	fwrite($cpfw, "BonusDistance\tDescription\tEffectClass\tnone\tnone\tIsCumulType\tCumulCounter\tNewEffCOunt\tEffectCode\tGradeLimit\tRangeEffCode\tnone\tnone\tnone\tnone\tnone\t");
	fwrite($cpfw, "none\tnone\tnone\tnone\tnone\tnone\tAttNeedBt\tnone\t1_2speed\t2_3speed\tnone\t1_2distance\t2_3distance\r\n");
	for($i=2; $i < $schet; $i++)
	{
		$skip = 0;
		$row = split("\t", trim($cpsfile[$i]));
		$ndrow = split("\t", trim($cpndfile[$i]));
		switch($ii)
		{
		case 3:
		case 4:	
			fwrite($cpfw, $row[0]."\t".$row[2]."\t0\t".$row[9]."\t0\t".$row[8]."\t".$row[5]."\t".$row[4]."\t".$row[7]."\t".$row[6]."\t");
			break;
		case 0:
		case 1:
			fwrite($cpfw, $row[0]."\t".$row[2]."\t".$row[1]."\t".$row[9]."\t".$row[3]."\t".$row[8]."\t".$row[5]."\t".$row[4]."\t".$row[7]."\t".$row[6]."\t");
			break;
		case 2:
			fwrite($cpfw, $row[0]."\t".$row[2]."\t0\t".$row[9]."\t".$row[3]."\t".$row[8]."\t".$row[5]."\t".$row[4]."\t".$row[7]."\t".$row[6]."\t");
			break;
		}
		
		if($row[33] == 1)
			fwrite($cpfw, "0\t".$row[34]."\t".$row[35]."\t".$row[36]."\t".$row[37]."\t".$row[38]."\t".$row[39]."\t".$row[40]."\t0\t0\t0\t".$row[41]."\t".$row[42]."\t".$row[43]."\t".$row[44]."\t".$row[45]."\t".$row[46]."\t".$row[47]."\t");
		elseif($row[33] == 2)
			fwrite($cpfw, "4\t".$row[34]."\t".$row[35]."\t".$row[36]."\t".$row[37]."\t".$row[38]."\t".$row[39]."\t".$row[40]."\t0\t0\t0\t".$row[41]."\t".$row[42]."\t".$row[43]."\t".$row[44]."\t".$row[45]."\t".$row[46]."\t".$row[47]."\t");
		else
			$skip++;
		
		if($row[52]!=-1)
			fwrite($cpfw, "1\t".$row[52]."\t".$row[52]."\t".$row[52]."\t".$row[52]."\t".$row[52]."\t".$row[52]."\t".$row[52]."\t".
			$row[53]."\t0\t0\t".$row[54]."\t".$row[55]."\t".$row[56]."\t".$row[57]."\t".$row[58]."\t".$row[59]."\t".$row[60]."\t");
		else
			$skip++;
		for($j=0; $j < 5; $j ++)
		{
			if($row[66+$j*9]!=-1 && $row[61] == 1)
				fwrite($cpfw, "3\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".
				$row[65+$j*9]."\t0\t0\t".$row[67+$j*9]."\t".$row[68+$j*9]."\t".$row[69+$j*9]."\t".$row[70+$j*9]."\t".$row[71+$j*9]."\t".$row[72+$j*9]."\t".$row[73+$j*9]."\t");
			elseif($row[66+$j*9]!=-1 && $row[61] == 0)
				fwrite($cpfw, "2\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".$row[66+$j*9]."\t".
				$row[65+$j*9]."\t0\t0\t".$row[67+$j*9]."\t".$row[68+$j*9]."\t".$row[69+$j*9]."\t".$row[70+$j*9]."\t".$row[71+$j*9]."\t".$row[72+$j*9]."\t".$row[73+$j*9]."\t");
			else
				$skip++;
		}	
		for($j=0; $j < $skip; $j++)
		{
				fwrite($cpfw, "-1\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t");			
		}
		fwrite($cpfw, ($row[110]*1000)."\t".($row[111]*1000)."\t".($row[112]*1000)."\t".($row[113]*1000)."\t".($row[114]*1000)."\t".($row[115]*1000)."\t".($row[116]*1000)."\t".
		$row[11]."\t".$row[1]."\t".$row[12]."\t".$row[14]."\t".$row[15]."\t0\t0\t0\t0\t0\t".$row[16]."\t".$row[17]."\t".$row[18]."\t".
		$row[19]."\t".$row[20]."\t".$row[21]."\t".$row[28]."\t".$row[50]."\t".$ndrow[1]."\t".$row[122]."\t0\t0\t".$row[29]."\t".
		$row[30]."\t".$row[31]."\t".$row[32]."\t".$row[13]."\t".$row[51]);
		/*�������� ����� ����������� ��������� ��� ������ �����*/
		$neednum = 0;
		if($row[22] != "-1" && $row[22]!= "0") $neednum++;
		if($row[24] != "-1" && $row[24]!= "0") $neednum++;
		if($row[26] != "-1" && $row[26]!= "0") $neednum++;
				
		$ittype = array(0=>"-1",1=>"-1",2=>"-1");
		$itcode = array(0=>"ffffffff",1=>"ffffffff",2=>"ffffffff");
		$ndnum = array(0=>"-1",1=>"-1",2=>"-1");		

		for($k = 0; $k < $neednum; $k++)
		{
			$a=0;
			$tpearr = str_split($row[22 + $k]);
			$type = $tpearr[0].$tpearr[1];	
			while($array[$a] != $type && $a != 37)
			{
				$a++;
			}
			if($a == 37)
			{
				$stop = true;
				echo "Undefined item found while processing SkillForce Force file. ".$type." <br>";
				flush();
			}
			$unpck = unpack("H*", clcode($row[22 + $k]));
			$itcode[$k] = $unpck[1];			
			$ittype[$k] = $a;
			$ndnum[$k] = $row[23 + $k];
		}
		/*����� �����*/
		if($ii < 3)
			fwrite($cpfw, "\t".$neednum."\t".$ittype[0]."\t".$ittype[1]."\t".$ittype[2]."\t".$itcode[0]."\t".$itcode[1]."\t".$itcode[2]."\t".$ndnum[0]."\t".$ndnum[1]."\t".$ndnum[2]."\t0\t");
		else
			fwrite($cpfw, "\t0\t0\t0\t0\t00000000\t00000000\t00000000\t0\t0\t0\t0\t");
		fwrite($cpfw, $row[49]."\t0\t".$row[118]."\t".$row[120]."\t0\t".$row[119]."\t".$row[121]."\r\n");
	}
	fclose($cpfw);
	unset($cpsfile);
	unset($cpndfile);
}

$fp = fopen($installpath."out\\skillforce.dat", "w+");

for($i = 0; $i < 5; $i++)
{
	if(!file_exists($installpath.$skfpatharr[$i]['cli']))
	{
		$stop = true;
		fclose($fp);
		echo "Aborted cause of file missing: ".$skfpatharr[$i]['cli']."<br>";
	}
	else
	{
		$decrypt = $installpath.$skfpatharr[$i]['cli'];
        if(!parser($fp, $decrypt, 1, 1))
        {
            die($stop_error_msg);
        }
	}
}
fclose($fp);
if(defined('GU'))
{
	$fp = fopen($installpath."out\\en-gb\\ndskillforce.dat", "w+");
	for($i = 0; $i < 5; $i++)
	{
		if(!file_exists($installpath.$skfpatharr[$i]['cli']))
		{
			$stop = true;
			fclose($fp);
			echo "Aborted cause of file missing: ".$skfpatharr[$i]['cli']."<br>";
		}
		else
		{
			$decrypt = $installpath.$skfpatharr[$i]['cli'];
			$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
			$schet = sizeof($struct_load);
			$schethex = pack("i", ($schet-2));
			fwrite($fp, "$schethex");
			$blockhex = pack("i", 544);
			fwrite($fp, "$blockhex");
			for($j=2; $j < $schet; $j++)
			{			
				$temporary = split("\t", trim($struct_load[$j],"\t\r\n"));
				$resulthex=pack("a32", $temporary[9]).pack("a512", $temporary[161]);
				fwrite($fp, $resulthex);
			}
			unset($struct_load);
		}
	}
	fclose($fp);
}
echo "<br>Script finished";