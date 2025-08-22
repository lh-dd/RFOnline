<?php
include './include.php'; // necessary include

$load = file($installpath."in\\CashShop.edf\\CashShop.txt", FILE_SKIP_EMPTY_LINES);
$srvopen = fopen($installpath."out\\ServerScript\\CashShop.dat", "w+");
$stropen = fopen($installpath."out\\ServerScript\\CashShop_str.dat", "w+");
if(defined('GU'))
	$cliopen = fopen($installpath."out\\itemcash.dat", "w+");
else
	$cliopen = fopen($installpath."out\\CashShop.edf\\CashShop.dat", "w+");

if(defined('GU'))
	$ndcopen = fopen($installpath."out\\en-gb\\nditemcash.dat", "w+");
	
$loadrows = sizeof($load);
$head = pack("i", ($loadrows-2));
fwrite($srvopen, $head);
fwrite($stropen, $head);
fwrite($cliopen, $head);

if(defined('GU'))
{
	fwrite($ndcopen, $head);
	fwrite($ndcopen, pack("i", 4));
	fwrite($stropen, pack("i", 13));
	fwrite($stropen, pack("i", 112));
}
else
{
	fwrite($stropen, pack("i", 11));
	fwrite($stropen, pack("i", 104));
}
	
fwrite($srvopen, pack("i", 15));
fwrite($srvopen, pack("i", 240));
fwrite($cliopen, pack("i", 64));

for($i = 2; $i < $loadrows; $i++)
{
	$row = split("\t", trim($load[$i]));
	$tosrv = pack("i", ($i-2)).pack("a64", $row[0]).pack("a64", $row[1]).pack("i", $row[2]).pack("i", $row[3]).pack("a64", $row[4]).pack("i", $row[5]).pack("i", $row[6]).pack("i", $row[7]).pack("i", $row[8]).pack("i", $row[9]).pack("i", $row[10]).pack("i", $row[11]).pack("i", $row[12]).pack("i", $row[13]);
	$tostr = pack("i", ($i-2)).pack("a64", $row[0]).pack("H56", "00000000000000000000000000000000000000000000000000000000").pack("i", $row[2]).pack("H8", "00000000");
	if(defined('GU'))
	{
		$tostr = $tostr.pack("H16", "0000000000000000");
		$tondc = pack("i", $row[2]);
		fwrite($ndcopen, $tondc);
	}
	/*$tostr = pack("i", ($i-2)).pack("a64", $row[0]).pack("@24").pack("i", $row[2]).pack("@40");
	if(defined('GU'))
	{
		$tostr = $tostr.pack("@16");
		$tondc = pack("i", $row[2]);
		fwrite($ndcopen, $tondc);
	}*/
	$fixarr = split("/", $row[4]);
	$fix = 0;
	if($fixarr[0] != "0")
		$fix = $fix + 16;
	if($fixarr[1] != "0")
		$fix = $fix + 8;
	if($fixarr[2] != "0")
		$fix = $fix + 4;
	if($fixarr[3] != "0")
		$fix = $fix + 2;
	if($fixarr[4] != "0")
		$fix = $fix + 1;
		
	$tocli = pack("i", ($i-2)).clcode($row[0]).exclcode($row[1]).pack("i", $row[2]).pack("i", $row[3]).pack("i", $fix).pack("i", $row[5]).pack("i", $row[6]).pack("i", $row[7]).pack("i", $row[8]).pack("i", $row[9]).pack("i", $row[10]).pack("i", $row[11]).pack("i", $row[12]).pack("i", $row[13]);
	fwrite($srvopen, $tosrv);
	fwrite($stropen, $tostr);
	fwrite($cliopen, $tocli);	
}
fclose($srvopen);
fclose($stropen);
fclose($cliopen);

if(defined('GU'))
	fclose($ndcopen);
echo "<br>Script finished";