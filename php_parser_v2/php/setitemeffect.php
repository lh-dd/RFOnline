<?php
include './include.php'; // necessary include

if(!$stop)
{
	if(defined('GU'))
		$itseteff = fopen($installpath."out\\ItemSetEffect.dat", "w+");
	else
		$itseteff = fopen($installpath."out\\SetItemEffect.edf\\SetItemEffect.dat", "w+");
	$load = file($installpath."in\\SetItemEffect.edf\\SetItemEff.txt", FILE_SKIP_EMPTY_LINES);
	$count = sizeof($load);
	$size = 216;
	fwrite($itseteff, pack("i", ($count-2)));
	fwrite($itseteff, pack("i", $size));
	$nindex = 0;
	for($i = 2; $i < $count; $i ++){
		$row = split("\t", trim($load[$i]));
		$nui = 0;
		for($j = 2 ; $j < 14; $j++){
			if($row[$j] == "-1")
				continue;
			else{
				$nui ++;
			}
		}
		$string = (pack("i", $nindex).clcode($row[0]).stb($row[1]).pack("i", $nui).exclcode($row[2]).exclcode($row[3]).exclcode($row[4]).exclcode($row[5]).exclcode($row[6]).exclcode($row[7]).exclcode($row[8]).exclcode($row[9]).exclcode($row[10]).exclcode($row[11]).exclcode($row[12]).exclcode($row[13]).rule($row[14]));
		$k = 0;
		$pos = 15;
		while($k != 8){
			$posn = $pos + 1;
			$string = $string.pack("i", $row[$pos]);
			$trans = array("," => ".");
			$string = $string.pack("f", strtr($row[$posn], $trans));
			$pos = $posn + 1;
			$k++;
		}
		fwrite($itseteff, $string);
		$nindex++;
	}
	fclose($itseteff);
}
echo "<br>Script finished";