<?php
include './include.php'; // necessary include

$stop = false;

$fo = fopen($installpath."in\\Character.edf\\character.txt", "w+");
$r1 = "byte\tbyte\tword\tdword\tccode\tstring[32]\tccode\tccode\tccode\tccode\tccode\tccode\tccode\tccode\tdword\tstring[32]\tstring[32]\tstring[32]\tdword\txeh\txeh\txeh\txeh\txeh\txeh\txeh\txeh\txeh\txeh\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\tdword\thex\thex\thex\thex\thex\thex\thex\thex\thex\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tclcode\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tbyte\tword\tdword\tstring[1024]\tEND\r\n";
$r2 = "Class\tGrade\tnone\tCount\tCode\tCode\tCh_Class1\tCh_Class2\tCh_Class3\tCh_Class4\tCh_Class5\tCh_Class6\tCh_Class7\tCh_Class8\tIcon\tsome name\tsomename\tEngName\tRace\tLinkSkill1\tLinkSkill2\tLinkSkill3\tLinkSkill4\tLinkSkill5\tLinkSkill6\tLinkSkill7\tLinkSkill8\tLinkSkill9\tLinkSkill10\tTrapMaxNum\tBnsHP\tBnsFP\tBnsSP\tMeleMastery\tRangeMastery2\tSpecialMastery\tnone\tShieldMastery\tDefMastery\tMakeMastery1\tMakeMastery2\tMakeMastery3\tDarkYch\tDarkExp\tDarkEl\tDarkMag\tHolyYch\tHolyExp\tHolyEl\tHolyMag\tFire1\tFire2\tFire3\tFire4\tAqua1\tAqua2\tAqua3\tAqua4\tSoil1\tSoil2\tSoil3\tSoil4\tWind1\tWind2\tWind3\tWind4\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tnone\tIsSelectReward\ttype1\ttype2\ttype3\ttype4\ttype5\ttype6\ttype7\ttype8\ttype9\tReward1\tReward2\tReward3\tReward4\tReward5\tReward6\tReward7\tReward8\tReward9\tAmount1\tAmount2\tAmount3\tAmount4\tAmount5\tAmount6\tAmount7\tAmount8\tAmount9\tnnone\tnone\tProfFeatures\tdesc";
fwrite($fo, $r1);
fwrite($fo, $r2);
$file1 = $installpath."in\\Character.edf\\Class.txt";
$file_load1 = file($file1, FILE_SKIP_EMPTY_LINES);
$file2 = $installpath."in\\Character.edf\\classcli.txt";
$file_load2 = file($file2, FILE_SKIP_EMPTY_LINES);
$schet1 = sizeof($file_load1);
$fcnt = 0;

for($i = 2; $i < $schet1; $i++)
{
	$class = split("\t", trim($file_load1[$i]));
	$class2 = split("\t", trim($file_load2[$i]));
	$ittype = array(0=>"ff000000",1=>"ff000000",2=>"ff000000",3=>"ff000000",4=>"ff000000",5=>"ff000000",6=>"ff000000",7=>"ff000000",8=>"ff000000");
	$itnum = array(0=>"-1",1=>"-1",2=>"-1",3=>"-1",4=>"-1",5=>"-1",6=>"-1",7=>"-1",8=>"-1",9=>"-1");
	fwrite($fo, "\r\n".$class[2]."\t".$class[4]."\t0\t".$fcnt."\t".$class[0]."\t".$class[0]);
	for($a=6; $a < 14; $a++){fwrite($fo, "\t".$class[$a]);}
	fwrite($fo, "\t".$class[3]."\t".$class[14]."\t".$class[15]."\t".$class[16]."\t".$class[1]);
	for($a=18; $a < 28; $a++){fwrite($fo, "\t".$class[$a]);}
	for($a=34; $a < 38; $a++){fwrite($fo, "\t".$class[$a]);}
	for($a=39; $a < 42; $a++){fwrite($fo, "\t".$class[$a]);}
	fwrite($fo, "\t0");
	fwrite($fo, "\t".$class[43]);
	fwrite($fo, "\t".$class[42]);
	for($a=44; $a < 47; $a++){fwrite($fo, "\t".$class[$a]);}
	for($a=55; $a < 79; $a++){fwrite($fo, "\t".$class[$a]);}
	fwrite($fo, "\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t0\t".$class[79]);
	$t=0;
	$s=0;
	for($cln = 80; $cln < 98; $cln = $cln+2)
	{
		$clm = $cln+1;
		if($class[$cln] != "-1")
		{
			$a = 0;
			$tmptype = str_split($class[$cln]);
			$type = $tmptype[0].$tmptype[1];
			while($array[$a]!=$type && $a!=37)
			{
				$a++;
			}
			if($a == 37)
			{
				echo "Undefined item type: column $cln row $i type.".$type.".<br>";
				flush();
				$stop = true;
			}
			$ittypetemp = unpack("H*", pack("i", $a));
			$ittype[$t] =$ittypetemp[1];
			if($class[$clm] > 254)
			{
				$itnum[$s] = 254;
			}
			else
			{
				$itnum[$s] = $class[$clm];
			}
			$t++;
			$s++;
		}
		else
		{
			break;
		}
	}
	for($a = 0; $a < 9; $a++)
	{
		fwrite($fo, "\t".$ittype[$a]);
	}
	for($a = 80; $a < 98; $a= $a+2){
		fwrite($fo, "\t".$class[$a]);
	}
	for($a = 0; $a < 9; $a++){
		fwrite($fo, "\t".$itnum[$a]);
	}
	fwrite($fo, "\t0\t0");
	$last = 0;
	for($a = 28; $a < 34; $a++){
		$x= $a-28;
		if($class[$a]==1){
			$last= $last + 1*pow(2,$x);
		}
	}
	fwrite($fo, "\t".$last."\t".$class2[0]);
	$fcnt++;
}
fclose($fo);
echo "Character.txt file is prepared. Begin to proceed file...<br>";
flush();

if(defined('GU'))
{
	$ai = file($installpath."in\\Character.edf\\MonsterCharacterAI.txt", FILE_SKIP_EMPTY_LINES);
	for($i = 2; $i < sizeof($ai); $i++)
	{
		$tempai = split("\t", trim($ai[$i]));
		$monai[$tempai[0]][0]=$tempai[1];
		$monai[$tempai[0]][1]=$tempai[2];
	}
}


if(!$stop)
{
	$fp = fopen($installpath."out\\character.dat", "w+");
	if(!file_exists($installpath."in\\Character.edf\\character.txt"))
	{
		$stop = true;
		fclose($fp);
		echo "Aborted cause of file missing: character.txt<br>";
	}
	else
	{
		$decrypt = $installpath."in\\Character.edf\\character.txt";
        if(!parser($fp, $decrypt, 0, 1))
        {
            die($stop_error_msg);
        }
	}
	if(!file_exists($installpath."in\\Character.edf\\gradecli.dat"))
		echo "File not found! gradecli.dat.<br>";
	else
	{
		$fp2 = fopen($installpath."in\\Character.edf\\gradecli.dat", "r");
		$unkdata = fread($fp2, 904);
		fwrite($fp, $unkdata);
		fclose($fp2);
	}
	if(!defined('GU'))
	{
		$ptfilearr = array(0=>"war.txt", 1=>"ran.txt", 2=>"spr.txt", 3=>"spc.txt");
		$filear = file($installpath."in\\Character.edf\\".$ptfilearr[0], FILE_SKIP_EMPTY_LINES);
		$filesi = sizeof($filear);
		$stru = split("\t", trim($filear[0]));
		$block = strsize($stru);
		$schethex = pack("i", (($filesi-2)*4));
		fwrite($fp, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fp, "$blockhex");
		for($a = 0; $a < 4; $a++)
		{
			if(!file_exists($installpath."in\\Character.edf\\".$ptfilearr[$a]))
			{
				$stop = true;
				fclose($fp);
				echo "Aborted cause of file missing: ".$ptfilearr[$a]."<br>";
				break;
			}
			else
			{
				$decrypt = $installpath."in\\Character.edf\\".$ptfilearr[$a];
                if(!parser($fp, $decrypt, 0, 0))
                {
                    die($stop_error_msg);
                }
			}
		}
		if(!file_exists($installpath."in\\Character.edf\\expcli.txt"))
		{
			$stop = true;
			fclose($fp);
			echo "Aborted cause of file missing: expcli.txt<br>";
		}
		else
		{
			$decrypt = $installpath."in\\Character.edf\\expcli.txt";
            if(!parser($fp, $decrypt, 0, 1))
            {
                die($stop_error_msg);
            }
		}
	}
	if(!file_exists($installpath."in\\Character.edf\\moncli.txt"))
	{
		$stop = true;
		fclose($fp);
		echo "Aborted cause of file missing: moncli.txt<br>";
	}
	else
	{
		$decrypt = $installpath."in\\Character.edf\\moncli.txt";
        if(!parser($fp, $decrypt, 1, 1))
        {
            die($stop_error_msg);
        }
	}
	if(!defined('GU'))
	{
		$ptfilearr = array(0=>"CPai.txt", 1=>"CHec.txt", 2=>"CIna.txt", 3=>"CIsi.txt", 4=>"CSPai.txt", 5=>"CSHec.txt", 6=>"CSIna.txt", 7=>"CSIsi.txt");
		$filear = file($installpath."in\\Character.edf\\".$ptfilearr[0], FILE_SKIP_EMPTY_LINES);
		$filesi = sizeof($filear);
		$stru = split("\t", trim($filear[0]));
		$block = strsize($stru);
		$schethex = pack("i", (($filesi-2)*8));
		fwrite($fp, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fp, "$blockhex");
		for($a = 0; $a < 8; $a++)
		{
			if(!file_exists($installpath."in\\Character.edf\\".$ptfilearr[$a]))
			{
				$stop = true;
				fclose($fp);
				echo "Aborted cause of file missing: ".$ptfilearr[$a]."<br>";
				break;
			}
			else
			{
				$decrypt = $installpath."in\\Character.edf\\".$ptfilearr[$a];
                if(!parser($fp, $decrypt, 0, 0))
                {
                    die($stop_error_msg);
                }
			}
		}
	}
	if(!file_exists($installpath."in\\Character.edf\\actioncli.dat"))
		echo "File not found gactionecli.dat.<br>";
	else
	{
		$fp2 = fopen($installpath."in\\Character.edf\\actioncli.dat", "r");
		$unkdata = fread($fp2, 1736);
		fwrite($fp, $unkdata);
		fclose($fp2);
	}
	if(defined('GU'))
	{
		$ptfilearr = array(0=>"war.txt", 1=>"ran.txt", 2=>"spr.txt", 3=>"spc.txt");
		$filear = file($installpath."in\\Character.edf\\".$ptfilearr[0], FILE_SKIP_EMPTY_LINES);
		$filesi = sizeof($filear);
		$stru = split("\t", trim($filear[0]));
		$block = strsize($stru);
		$schethex = pack("i", (($filesi-2)*4));
		fwrite($fp, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fp, "$blockhex");
		for($a = 0; $a < 4; $a++)
		{
			if(!file_exists($installpath."in\\Character.edf\\".$ptfilearr[$a]))
			{
				$stop = true;
				fclose($fp);
				echo "Aborted cause of file missing: ".$ptfilearr[$a]."<br>";
				break;
			}
			else
			{
				$decrypt = $installpath."in\\Character.edf\\".$ptfilearr[$a];
                if(!parser($fp, $decrypt, 0, 0))
                {
                    die($stop_error_msg);
                }
			}
		}
		if(!file_exists($installpath."in\\Character.edf\\expcli.txt"))
		{
			$stop = true;
			fclose($fp);
			echo "Aborted cause of file missing: expcli.txt<br>";
		}
		else
		{
			$decrypt = $installpath."in\\Character.edf\\expcli.txt";
            if(!parser($fp, $decrypt, 0, 1))
            {
                die($stop_error_msg);
            }
		}
		$ptfilearr = array(0=>"CPai.txt", 1=>"CHec.txt", 2=>"CIna.txt", 3=>"CIsi.txt", 4=>"CSPai.txt", 5=>"CSHec.txt", 6=>"CSIna.txt", 7=>"CSIsi.txt");
		$filear = file($installpath."in\\Character.edf\\".$ptfilearr[0], FILE_SKIP_EMPTY_LINES);
		$filesi = sizeof($filear);
		$stru = split("\t", trim($filear[0]));
		$block = strsize($stru);
		$schethex = pack("i", (($filesi-2)*8));
		fwrite($fp, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fp, "$blockhex");
		for($a = 0; $a < 8; $a++)
		{
			if(!file_exists($installpath."in\\Character.edf\\".$ptfilearr[$a]))
			{
				$stop = true;
				fclose($fp);
				echo "Aborted cause of file missing: ".$ptfilearr[$a]."<br>";
				break;
			}
			else
			{
				$decrypt = $installpath."in\\Character.edf\\".$ptfilearr[$a];
                if(!parser($fp, $decrypt, 0, 0))
                {
                    die($stop_error_msg);
                }
			}
		}
		fclose($fp);
		$fp = fopen($installpath."out\\en-gb\\ndcharacter.dat", "w+");
		if(!file_exists($installpath."in\\Character.edf\\character.txt"))
			echo "Aborted cause of file missing: character.txt<br>";
		else
		{
			$decrypt = $installpath."in\\Character.edf\\character.txt";
			$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
			$schet = sizeof($struct_load);
			$schethex = pack("i", ($schet-2));
			fwrite($fp, "$schethex");
			$blockhex = pack("i", 1056);
			fwrite($fp, "$blockhex");
			for($j=2; $j < $schet; $j++)
			{			
				$temporary = split("\t", trim($struct_load[$j],"\t\r\n"));
				$resulthex=pack("a32", $temporary[16]).pack("a1024", $temporary[109]);
				fwrite($fp, $resulthex);
			}
		}
		if(!file_exists($installpath."in\\Character.edf\\ndgrade.txt"))
			echo "Aborted cause of file missing: ndgrade.txt<br>";
		else
		{
			$decrypt = $installpath."in\\Character.edf\\ndgrade.txt";
            if(!parser($fp, $decrypt, 0, 1))
            {
                die($stop_error_msg);
            }
		}
		if(!file_exists($installpath."in\\Character.edf\\MonsterCharacter.txt"))
			echo "Aborted cause of file missing: MonsterCharacter.txt<br>";
		else
		{
			$decrypt = $installpath."in\\Character.edf\moncli.txt";
			$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
			$schet = sizeof($struct_load);
			$schethex = pack("i", ($schet-2));
			fwrite($fp, "$schethex");
			$blockhex = pack("i", 32);
			fwrite($fp, "$blockhex");
			for($j=2; $j < $schet; $j++)
			{			
				$temporary = split("\t", trim($struct_load[$j],"\t\r\n"));
				if(strlen($temporary[1]) >= 32)
				{
    			$temporary[1] = substr($temporary[1], 0, 31);
				}
				$resulthex = pack("a32", trim(str_replace("\x22\x22\x22\x22", "\x22\x22", $temporary[1]), "\x22"));
				fwrite($fp, $resulthex);
			}
		}
		if(!file_exists($installpath."in\\Character.edf\\ndaction.txt"))
			echo "Aborted cause of file missing: ndaction.txt<br>";
		else
		{
			$decrypt = $installpath."in\\Character.edf\\ndaction.txt";
            if(!parser($fp, $decrypt, 0, 1))
            {
                die($stop_error_msg);
            }
		}
	}
	fclose($fp);
}
echo "<br>Script finished";
