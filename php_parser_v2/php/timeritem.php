<?php
include './include.php'; // necessary include

if(defined('GU'))
{
	$filef = $installpath."in\\ItemTimer.edf\\ItemTimer.txt";
	$files = $installpath."out\\ItemTimer.dat";
}
else
{
	$filef = $installpath."in\\TimerItem.edf\\ItemTimer.txt";
	$files = $installpath."out\\TimerItem.dat";
}

$fw = fopen($files, "w+");

if(!file_exists($filef))
	echo "Aborted cause of file missing: ItemTimer.txt.<br>";
else
	if(!parser($fw, $filef, 1, 1))
    {
        print_r(error_get_last());
        die($stop_error_msg);
    }

fclose($fw);
echo "<br>Script finished";