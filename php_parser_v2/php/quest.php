<?php
include './include.php'; // necessary include

$stop = false;

$fw = fopen($installpath."out\\quest.dat", "w+");

if(!$stop)
{ // Quest Event Building
	//$schet = 2;
	//$bsize = 336;
	//fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));
	for($i = 0; $i < 7; $i++)
	{
		if(!file_exists($installpath."in\\Quest.edf\\".$qpatharr[$i])) 
			$stop = true;
		else
		{
			$fo = file($installpath."in\\Quest.edf\\".$qpatharr[$i], FILE_SKIP_EMPTY_LINES);
			$schet = sizeof($fo);
			$bsize = 336;
			fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));
			for($j = 2; $j < $schet; $j++)
			{
				$row = explode("\t", trim($fo[$j]));
				fwrite($fw, pack("i", ($j-2)));
				if(strlen($row[0]) == 7)
				{
					fwrite($fw, lqitem($row[0]));
				}
				elseif(strlen($row[0]) == 4)
				{
					fwrite($fw, ccode($row[0]));
				}
				else
				{
					fwrite($fw, xeh($row[0]));
				}
				fwrite($fw, pack("c", $row[1]).pack("H6", "000000"));
				$movef = 0;
				for($k = 0; $k < 3; $k++)
				{
					fwrite($fw, pack("i", $row[2+$movef]).pack("i", $row[4+$movef]));
					$moves = 0;
					for($l = 0; $l < 5; $l++)
					{
						fwrite($fw, pack("c", $row[8+$movef+$moves]).pack("c", $row[9+$movef+$moves]).pack("s", 0).dval($row[10+$movef+$moves], $i));
						$moves = $moves + 3;
					}
					fwrite($fw, qcode($row[23+$movef]).qcode($row[23+$movef]).qcode($row[24+$movef]).qcode($row[24+$movef]).qcode($row[25+$movef]).qcode($row[25+$movef]).qcode($row[26+$movef]).qcode($row[26+$movef]).qcode($row[27+$movef]).qcode($row[27+$movef]));
					$movef = $movef + 26;
				}
				if($stop)
				{
					break;
				}
			}
			if($stop)
			{
				break;
			}
		}
	}
	//$schet = 2;
	//$bsize = 336;
	//fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));
	//fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));
	//fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));
	//fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));
	//fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));
}
if(!$stop)
{ // Main Quest Building
	if(!file_exists($installpath."in\\Quest.edf\\cliquest0.txt"))
		$stop = true;
	else
	{
		$decrypt = $installpath."in\\Quest.edf\\cliquest0.txt";
		$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($struct_load) + 10;
		$str_row = explode("\t", trim($struct_load[0]));
		$block = strsize($str_row);
		$schethex = pack("i", $schet);
		fwrite($fw, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fw, "$blockhex");
        if(!parser($fw, $decrypt, 0, 0))
        {
            die($stop_error_msg);
        }
	}
}
if(!$stop)
{ // Holy War Quest Building
	if(!file_exists($installpath."in\\Quest.edf\\cliquest1.txt"))
		$stop = true;
	else
	{
		$decrypt = $installpath."in\\Quest.edf\\cliquest1.txt";
        if(!parser($fw, $decrypt, 0, 0))
        {
            die($stop_error_msg);
        }
	}
}
if(!$stop && !defined('GU'))
{ // Quest Desc Length Building
	if(!file_exists($installpath."in\\Quest.edf\\QDescCli.txt")){
		$stop = true;
	}
	else{
		$fo = file($installpath."in\\Quest.edf\\QDescCli.txt", FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($fo);
		$bsize =16;
		fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));	
		for($j = 2; $j < $schet; $j++){
			$temporary = split("\t", trim($fo[$j]));
			fwrite($fw, pack("i", $temporary[0]).pack("i", 0).pack("i", (strlen($temporary[1])+1)).pack("i", 0));			
		}
		for($j = 2; $j < $schet; $j++){
			$temporary = split("\t", trim($fo[$j]));
			fwrite($fw, pack("a".(strlen($temporary[1])+1), $temporary[1]));			
		}
	}
}
if(!$stop)
{ // QuestItem Building
	if(!file_exists($installpath."in\\Quest.edf\\QuestItemCli.txt"))
		$stop = true;
	else
	{
		$decrypt = $installpath."in\\Quest.edf\\QuestItemCli.txt";
		$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($struct_load) - 2;
		$str_row = explode("\t", trim($struct_load[0]));
		$block = strsize($str_row) + 4;
		$schethex = pack("i", $schet);
		fwrite($fw, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fw, "$blockhex");
        if(!parser($fw, $decrypt, 1, 0))
        {
            die($stop_error_msg);
        }
	}
}
if(!$stop)
{ // Quest order Building
	if(!file_exists($installpath."in\\Quest.edf\\QuestOrder0.txt"))
		$stop = true;
	elseif(!file_exists($installpath."in\\Quest.edf\\QuestOrder1.txt"))
		$stop = true;
	elseif(!file_exists($installpath."in\\Quest.edf\\QuestOrder2.txt"))
		$stop = true;
	else
	{
		for($i = 0; $i < 3; $i++)
		{
			$decrypt = $installpath."in\\Quest.edf\\QuestOrder".$i.".txt";
			$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
			$schet = sizeof($struct_load) - 2;
			$str_row = explode("\t", trim($struct_load[0]));
			$block = strsize($str_row);
			$schethex = pack("i", $schet);
			fwrite($fw, "$schethex");
			$blockhex = pack("i", $block);
			fwrite($fw, "$blockhex");
            if(!parser($fw, $decrypt, 0, 0))
            {
                die($stop_error_msg);
            }
		}
	}
}
fclose($fw);
if(defined('GU'))
{
	$fw = fopen($installpath."out\\en-gb\\ndquest.dat", "w+");
	if(!file_exists($installpath."in\\Quest.edf\\QuestItemCli.txt"))
		$stop = true;
	else
	{
		$decrypt = $installpath."in\\Quest.edf\\QuestItemCli.txt";
		$struct_load = file($decrypt, FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($struct_load);
		$block = 32;
		$schethex = pack("i", ($schet-2));
		fwrite($fw, "$schethex");
		$blockhex = pack("i", $block);
		fwrite($fw, "$blockhex");
		for($j=2; $j < $schet; $j++)
		{			
			$temporary = explode("\t", trim($struct_load[$j],"\t\r\n"));
			$resulthex=pack("a32", $temporary[2]);
			fwrite($fw, $resulthex);
		}
	}
	if(!file_exists($installpath."in\\Quest.edf\\QDescCli.txt"))
		$stop = true;
	else
	{
		$fo = file($installpath."in\\Quest.edf\\QDescCli.txt", FILE_SKIP_EMPTY_LINES);
		$schet = sizeof($fo);
		$bsize =16;
		fwrite($fw, pack("i", ($schet-2)).pack("i", $bsize));	
		for($j = 2; $j < $schet; $j++){
			$temporary = explode("\t", trim($fo[$j]));
			fwrite($fw, pack("i", $temporary[0]).pack("i", 0).pack("i", (strlen($temporary[1] ?? '')+1)).pack("i", 0));
		}
		for($j = 2; $j < $schet; $j++){
			$temporary = explode("\t", trim($fo[$j]));
			fwrite($fw, pack("a".(strlen($temporary[1] ?? '')+1), $temporary[1] ?? ''));			
		}
	}
	fclose($fw);
}
echo "<br>Script finished";