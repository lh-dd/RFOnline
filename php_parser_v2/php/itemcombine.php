<?php
include './include.php'; // necessary include

$stop = false;

echo str_repeat(" ", 1024)."<br>";
echo str_repeat(" ", 1024)."<br>";

if(!file_exists($installpath."in\\ItemCombine.edf\\CombineTable.txt") || !file_exists($installpath."in\\ItemCombine.edf\\CombineTable2.txt") || !file_exists($installpath."in\\ItemCombine.edf\\LinkedStuff.txt")) {
	echo "Required files doesnt exists.<br>";
	flush();
	$stop = true;
}
else{
	$table1 = file($installpath."in\\ItemCombine.edf\\CombineTable.txt", FILE_SKIP_EMPTY_LINES);
	$table2 = file($installpath."in\\ItemCombine.edf\\CombineTable2.txt", FILE_SKIP_EMPTY_LINES);
	$lstuff = file($installpath."in\\ItemCombine.edf\\LinkedStuff.txt", FILE_SKIP_EMPTY_LINES);
}
if(!$stop){
	$linkarr = array();
	$linksiz = array();
	$linknum = sizeof($lstuff);
	$tabnum1 = sizeof($table1);
	$tabnum2 = sizeof($table2);
	$fo = fopen($installpath."out\\itemcombine.dat", "w+");
	$resnum = $tabnum1 + $tabnum2 - 4;
	fwrite($fo, pack("i", $resnum));
	fwrite($fo, pack("i", 124));
	$j = 0;
	for($i = 2; $i < $linknum; $i++){
		$trow = explode("\t", trim($lstuff[$i]));
		$linkarr[$trow[0]]= $j;
		$count = 0;
		for ($k = 1; $k < 101; $k++) {
			if (!isset($trow[$k]) || $trow[$k] === "-1") {
				break;
			}
			$count++;
		}
		$linksiz[$j] = $count;
		$j++;
	}
	$a=0;
    $nextpercent = 10;
	for($i = 2; $i < $tabnum1; $i++){
		$trow = explode("\t", trim($table1[$i]));
		fwrite($fo, pack("i", $a).pack("i", $trow[3]).pack("i", $trow[1]).stb($trow[2]));
		$matn = 0;
		for($b = 6; $b < 19; $b = $b + 3){
			if($trow[$b] == "-1"){
				fwrite($fo, pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0));
			}
			elseif(!check($trow[$b])){
				fwrite($fo, lcode($trow[$b]).pack("i", $trow[$b+2]).xeh($trow[$b+1]));
				$matn++;
			}
			else{
				fwrite($fo, linst($trow[$b]).pack("i", $trow[$b+2]).xeh($trow[$b+1]));
				$matn++;
			}			
		}
		$a++;
		fwrite($fo, pack("i", $matn));
		$percent = ($i /($tabnum1-1)) * 100;
        if($percent >= $nextpercent)
        {
            echo $nextpercent."%<br>";
            flush();
            $nextpercent += 10;
        }

        if($percent == 100)
        {
            echo "Table part 1 complete!!!<br>";
            flush();
        }
	}
	$a=0;
    $nextpercent = 10;
	for($i = 2; $i < $tabnum2; $i++){
		$trow = explode("\t", trim($table2[$i]));
		fwrite($fo, pack("i", $a).pack("i", $trow[3]).pack("i", $trow[1]).stb($trow[2]));
		$matn = 0;
		for($b = 6; $b < 19; $b = $b + 3){
			if($trow[$b] == "-1"){
				fwrite($fo, pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0).pack("i", 0));
			}
			elseif(!check($trow[$b])){
				fwrite($fo, lcode($trow[$b]).pack("i", $trow[$b+2]).xeh($trow[$b+1]));
				$matn++;
			}
			else{
				fwrite($fo, linst($trow[$b]).pack("i", $trow[$b+2]).xeh($trow[$b+1]));
				$matn++;
			}
		}
		$a++;
		fwrite($fo, pack("i", $matn));
		$percent = ($i /($tabnum2-1)) * 100;
        if($percent >= $nextpercent)
        {
            echo $nextpercent."%<br>";
            flush();
            $nextpercent += 10;
        }

		if($percent == 100)
        {
			echo "Table part 2 complete!!!<br>";
			flush();
		}
	}
	fwrite($fo, pack("i", ($linknum-2)));
	fwrite($fo, pack("i", 1208));
	$a = 0;
	for($i = 2; $i < $linknum; $i++){
		$trow = explode("\t", trim($lstuff[$i]));
		fwrite($fo, pack("i", $a).pack("i", $linksiz[$a]));
		for($j = 1; $j < 101; $j++){
			fwrite($fo, lcode($trow[$j]));
		}
		$a++;
	}
	fclose($fo);
}
echo "<br>Script finished";